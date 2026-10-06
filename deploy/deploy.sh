#!/usr/bin/env bash
# ==============================================================================
# Nagaldham Farm — Production Deploy Script
# Usage: deploy.sh <IMAGE_TAG>
# Called by GitHub Actions SSH step via appleboy/ssh-action.
# Environment variables required (injected by workflow, never in shell history):
#   IMAGE_TAG   — git short SHA of the new image
#   GHCR_USER   — GitHub username for registry login
#   GHCR_TOKEN  — GitHub PAT with read:packages scope
# ==============================================================================
set -euo pipefail

# ---------------------------------------------------------------------------
# Config
# ---------------------------------------------------------------------------
PROJECT_DIR="${PROJECT_DIR:-/opt/nagaldhamfarm}"
COMPOSE_CMD="${COMPOSE_CMD:-docker-compose}"
REGISTRY="ghcr.io"
APP_IMAGE="ghcr.io/aryanbhuva/nagaldhamfarm"
HEALTH_URL_ROOT="http://127.0.0.1"
HEALTH_TIMEOUT=90
HEALTH_INTERVAL=3
TAG_FILE="${PROJECT_DIR}/.deployed_tag"
ENV_FILE="${PROJECT_DIR}/.env"
MAX_IMAGES_KEPT=3

# ---------------------------------------------------------------------------
# Validate arguments
# ---------------------------------------------------------------------------
if [[ $# -lt 1 || -z "$1" ]]; then
  echo "ERROR: Usage: $0 <IMAGE_TAG>" >&2
  exit 1
fi

NEW_TAG="$1"

# Require injected environment variables (secrets — never print their values)
for var in GHCR_USER GHCR_TOKEN; do
  if [[ -z "${!var:-}" ]]; then
    echo "ERROR: Required environment variable $var is not set." >&2
    exit 1
  fi
done

# ---------------------------------------------------------------------------
# Helpers
# ---------------------------------------------------------------------------
log() { echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*"; }

die() {
  echo "[$(date '+%Y-%m-%d %H:%M:%S')] ERROR: $*" >&2
  exit 1
}

get_http_port() {
  # Read HTTP_PORT from .env, fall back to 8085
  if [[ -f "$ENV_FILE" ]]; then
    grep -E '^HTTP_PORT=' "$ENV_FILE" | cut -d= -f2 | tr -d '"' || true
  fi
}

update_env_tag() {
  local tag="$1"
  if [[ ! -f "$ENV_FILE" ]]; then
    if [[ -f "${PROJECT_DIR}/.env.production.example" ]]; then
      cp "${PROJECT_DIR}/.env.production.example" "$ENV_FILE"
      log "Created initial .env from .env.production.example"
    else
      touch "$ENV_FILE"
    fi
  fi

  if ! grep -qE '^APP_KEY=base64:' "$ENV_FILE" 2>/dev/null; then
    local new_key
    new_key="base64:$(openssl rand -base64 32)"
    if grep -qE '^APP_KEY=' "$ENV_FILE" 2>/dev/null; then
      sed -i "s|^APP_KEY=.*|APP_KEY=${new_key}|" "$ENV_FILE"
    else
      echo "APP_KEY=${new_key}" >> "$ENV_FILE"
    fi
    log "Generated production APP_KEY in .env"
  fi

  if grep -qE '^IMAGE_TAG=' "$ENV_FILE" 2>/dev/null; then
    sed -i "s|^IMAGE_TAG=.*|IMAGE_TAG=${tag}|" "$ENV_FILE"
  else
    echo "IMAGE_TAG=${tag}" >> "$ENV_FILE"
  fi
}


health_check() {
  local tag="$1"
  local port
  port="$(get_http_port)"
  port="${port:-8085}"
  local base_url="${HEALTH_URL_ROOT}:${port}"
  local elapsed=0

  log "Health check: polling ${base_url}/ and /products (timeout: ${HEALTH_TIMEOUT}s)"

  while [[ $elapsed -lt $HEALTH_TIMEOUT ]]; do
    if curl -fsS -o /dev/null "${base_url}/" && \
       curl -fsS -o /dev/null "${base_url}/products"; then
      log "Health check PASSED (image tag: ${tag})"
      return 0
    fi
    sleep "$HEALTH_INTERVAL"
    elapsed=$(( elapsed + HEALTH_INTERVAL ))
  done

  log "Health check FAILED after ${HEALTH_TIMEOUT}s (image tag: ${tag})"
  return 1
}

start_stack() {
  local tag="$1"
  log "Starting stack with IMAGE_TAG=${tag}..."
  cd "$PROJECT_DIR"
  update_env_tag "$tag"
  "$COMPOSE_CMD" pull
  "$COMPOSE_CMD" rm -f web
  "$COMPOSE_CMD" up -d --remove-orphans
}

rollback_to() {
  local tag="$1"
  log "Rolling back to IMAGE_TAG=${tag}..."
  cd "$PROJECT_DIR"
  start_stack "$tag"
}

prune_old_images() {
  log "Pruning dangling images..."
  docker image prune -f

  log "Keeping last ${MAX_IMAGES_KEPT} tagged images for rollback..."
  # List all app image tags sorted by creation date (newest first), remove oldest beyond limit
  mapfile -t old_images < <(
    docker images --format '{{.Repository}}:{{.Tag}}' \
      | grep "^${APP_IMAGE}:" \
      | grep -v ':latest' \
      | tail -n "+$(( MAX_IMAGES_KEPT + 1 ))"
  )
  for img in "${old_images[@]}"; do
    log "Removing old image: ${img}"
    docker rmi "$img" || true
  done
}

# ---------------------------------------------------------------------------
# Main deployment flow
# ---------------------------------------------------------------------------
log "=== Nagaldham Farm Deployment ==="
log "Project dir : ${PROJECT_DIR}"
log "New tag     : ${NEW_TAG}"

cd "$PROJECT_DIR"

# Step 1: Read previous tag for rollback
PREVIOUS_TAG="latest"
if [[ -f "$TAG_FILE" ]]; then
  PREVIOUS_TAG="$(cat "$TAG_FILE")"
fi
log "Previous tag: ${PREVIOUS_TAG}"

# Step 2: Login to GHCR (secret value never echoed)
log "Authenticating with ${REGISTRY}..."
echo "$GHCR_TOKEN" | docker login "$REGISTRY" -u "$GHCR_USER" --password-stdin

# Step 3: Deploy new image
if start_stack "$NEW_TAG"; then
  log "Stack started. Running health check..."
else
  die "Failed to start stack with tag ${NEW_TAG}."
fi

# Step 4: Health check
if health_check "$NEW_TAG"; then
  # Success path
  echo "$NEW_TAG" > "$TAG_FILE"
  prune_old_images
  docker logout "$REGISTRY"
  log "=== Deployment SUCCEEDED: ${NEW_TAG} ==="
  exit 0
fi

# Step 5: Health check failed — auto rollback
log "=== Health check FAILED. Initiating automatic rollback to ${PREVIOUS_TAG} ==="
log "--- Recent container logs ---"
"$COMPOSE_CMD" logs --tail=100 || true
log "--- End logs ---"

rollback_to "$PREVIOUS_TAG"

if health_check "$PREVIOUS_TAG"; then
  echo "$PREVIOUS_TAG" > "$TAG_FILE"
  docker logout "$REGISTRY"
  log "=== Rollback SUCCEEDED: running ${PREVIOUS_TAG} ==="
else
  log "=== CRITICAL: Rollback to ${PREVIOUS_TAG} also failed! Manual intervention required. ==="
  docker logout "$REGISTRY"
fi

exit 1
