#!/usr/bin/env bash
# ==============================================================================
# Nagaldham Farm — Production Server Bootstrap Script
# Usage: sudo ./scripts/bootstrap_server.sh
# Purpose: Idempotent one-time server setup script for AWS EC2 (Ubuntu 22.04 LTS)
# ==============================================================================
set -euo pipefail

# ------------------------------------------------------------------------------
# Configuration
# ------------------------------------------------------------------------------
DEPLOY_USER="${DEPLOY_USER:-deploy}"
PROJECT_DIR="${PROJECT_DIR:-/opt/nagaldhamfarm}"
SWAP_SIZE="${SWAP_SIZE:-2G}"
DOCKER_COMPOSE_VERSION="${DOCKER_COMPOSE_VERSION:-v2.27.0}"

log() { echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*"; }

# Require root permissions
if [[ $EUID -ne 0 ]]; then
   echo "ERROR: This script must be run as root (use sudo)." >&2
   exit 1
fi

log "=== Starting Nagaldham Farm Server Bootstrap ==="

# ------------------------------------------------------------------------------
# Step 1: System Update & Essential Tools
# ------------------------------------------------------------------------------
log "Step 1: Updating system packages and installing essential tools..."
apt-get update -y
apt-get install -y \
    ca-certificates \
    curl \
    gnupg \
    lsb-release \
    git \
    ufw \
    fail2ban \
    htop

# ------------------------------------------------------------------------------
# Step 2: Configure 2 GB Swap File (Critical for Low-RAM EC2)
# ------------------------------------------------------------------------------
if [[ ! -f /swapfile ]]; then
    log "Step 2: Creating ${SWAP_SIZE} swap file..."
    fallocate -l "$SWAP_SIZE" /swapfile
    chmod 600 /swapfile
    mkswap /swapfile
    swapon /swapfile
    echo '/swapfile none swap sw 0 0' >> /etc/fstab
    log "Swap file created successfully."
else
    log "Step 2: Swap file already exists. Skipping."
fi

# ------------------------------------------------------------------------------
# Step 3: Install Docker Engine & Docker Compose v2
# ------------------------------------------------------------------------------
if ! command -v docker >/dev/null 2>&1; then
    log "Step 3: Installing Docker Engine..."
    curl -fsSL https://get.docker.com -o /tmp/get-docker.sh
    sh /tmp/get-docker.sh
    rm -f /tmp/get-docker.sh
else
    log "Step 3: Docker Engine is already installed."
fi

if [[ ! -f /usr/local/bin/docker-compose ]]; then
    log "Step 3: Installing Docker Compose ${DOCKER_COMPOSE_VERSION}..."
    curl -SL "https://github.com/docker/compose/releases/download/${DOCKER_COMPOSE_VERSION}/docker-compose-linux-x86_64" -o /usr/local/bin/docker-compose
    chmod +x /usr/local/bin/docker-compose
else
    log "Step 3: Docker Compose binary already exists at /usr/local/bin/docker-compose."
fi

# ------------------------------------------------------------------------------
# Step 4: Create Deploy User & SSH Setup
# ------------------------------------------------------------------------------
if ! id "$DEPLOY_USER" >/dev/null 2>&1; then
    log "Step 4: Creating user '${DEPLOY_USER}'..."
    useradd -m -s /bin/bash "$DEPLOY_USER"
fi

log "Adding user '${DEPLOY_USER}' to docker group..."
usermod -aG docker "$DEPLOY_USER"

SSH_DIR="/home/${DEPLOY_USER}/.ssh"
mkdir -p "$SSH_DIR"
chmod 700 "$SSH_DIR"
touch "${SSH_DIR}/authorized_keys"
chmod 600 "${SSH_DIR}/authorized_keys"
chown -R "${DEPLOY_USER}:${DEPLOY_USER}" "$SSH_DIR"

if [[ ! -f "${SSH_DIR}/id_ed25519" ]]; then
    log "Generating SSH ed25519 key pair for '${DEPLOY_USER}'..."
    su - "$DEPLOY_USER" -c "ssh-keygen -t ed25519 -N '' -f ${SSH_DIR}/id_ed25519"
    cat "${SSH_DIR}/id_ed25519.pub" >> "${SSH_DIR}/authorized_keys"
    chown "${DEPLOY_USER}:${DEPLOY_USER}" "${SSH_DIR}/authorized_keys"
fi

# ------------------------------------------------------------------------------
# Step 5: Setup Project Working Directory
# ------------------------------------------------------------------------------
log "Step 5: Setting up project directory at ${PROJECT_DIR}..."
mkdir -p "$PROJECT_DIR"
chown -R "${DEPLOY_USER}:${DEPLOY_USER}" "$PROJECT_DIR"

# ------------------------------------------------------------------------------
# Step 6: Configure SSL Certificate Permissions
# ------------------------------------------------------------------------------
log "Step 6: Setting SSL directory permissions..."
mkdir -p /etc/letsencrypt/live /etc/letsencrypt/archive
chmod +rx /etc/letsencrypt /etc/letsencrypt/live /etc/letsencrypt/archive

log "=== Bootstrap Complete ==="
log "Public SSH Key for GitHub Deploy Keys:"
cat "${SSH_DIR}/id_ed25519.pub"
echo ""
log "Private SSH Key for GitHub Actions Secret (EC2_SSH_KEY):"
cat "${SSH_DIR}/id_ed25519"
