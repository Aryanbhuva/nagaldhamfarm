#!/usr/bin/env bash
# ==============================================================================
# Nagaldham Farm — Manual Rollback Script
# Usage: ./deploy/rollback.sh <TARGET_IMAGE_TAG>
# ==============================================================================
set -euo pipefail

PROJECT_DIR="${PROJECT_DIR:-/opt/nagaldhamfarm}"
COMPOSE_CMD="${COMPOSE_CMD:-docker-compose}"
HEALTH_URL_ROOT="http://127.0.0.1"
HEALTH_TIMEOUT=90
HEALTH_INTERVAL=3
TAG_FILE="${PROJECT_DIR}/.deployed_tag"
ENV_FILE="${PROJECT_DIR}/.env"

if [[ $# -lt 1 || -z "$1" ]]; then
  echo "ERROR: Usage: $0 <TARGET_IMAGE_TAG>" >&2
  exit 1
fi

TARGET_TAG="$1"

log() { echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*"; }

die() {
  echo "[$(date '+%Y-%m-%d %H:%M:%S')] ERROR: $*" >&2
  exit 1
}

get_http_port() {
  if [[ -f "$ENV_FILE" ]]; then
    grep -E '^HTTP_PORT=' "$ENV_FILE" | cut -d= -f2 | tr -d '"' || true
  fi
}

update_env_tag() {
  local tag="$1"
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

log "=== Nagaldham Farm Manual Rollback ==="
log "Project dir : ${PROJECT_DIR}"
log "Target tag  : ${TARGET_TAG}"

cd "$PROJECT_DIR"

log "Updating IMAGE_TAG=${TARGET_TAG} in .env..."
update_env_tag "$TARGET_TAG"

log "Pulling image tag ${TARGET_TAG}..."
"$COMPOSE_CMD" pull

log "Restarting stack..."
"$COMPOSE_CMD" rm -f web
"$COMPOSE_CMD" up -d --remove-orphans

if health_check "$TARGET_TAG"; then
  echo "$TARGET_TAG" > "$TAG_FILE"
  log "=== Rollback SUCCEEDED: now running ${TARGET_TAG} ==="
  exit 0
else
  log "--- Container logs ---"
  "$COMPOSE_CMD" logs --tail=100 || true
  log "--- End logs ---"
  die "Rollback to ${TARGET_TAG} failed health check!"
fi
