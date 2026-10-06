# 🚀 Nagaldham Farm — Standalone EC2 Server & CI/CD Setup Guide

This guide details the one-time AWS EC2 server configuration and GitHub Repository Secrets setup for automated deployment via GitHub Actions.

---

## 📋 Prerequisites & Architecture Overview

* **Server:** Standalone AWS EC2 instance running Ubuntu 22.04 LTS (or Debian/Amazon Linux 2023).
* **RAM:** Low-RAM instance (1 GB / t2.micro or t3.micro). Images are built on GitHub Actions runners, **never on the server**.
* **Registry:** GitHub Container Registry (`ghcr.io/aryanbhuva/nagaldhamfarm`).
* **SSH User:** Non-root `deploy` user with passwordless `docker` access.
* **Working Directory on EC2:** `/opt/nagaldhamfarm`

---

## 🛠️ Step 1: One-Time EC2 Server Setup

Run the following commands on your EC2 instance as `root` (or using `sudo`).

### 1. Create 2 GB Swap File (Critical for Low-RAM EC2)
```bash
sudo fallocate -l 2G /swapfile
sudo chmod 600 /swapfile
sudo mkswap /swapfile
sudo swapon /swapfile

# Make swap persistent across reboots
echo '/swapfile none swap sw 0 0' | sudo tee -a /etc/fstab
```

### 2. Install Docker & docker-compose
```bash
# Install Docker
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh

# Install legacy docker-compose (v1.29.2) or compose plugin
sudo curl -L "https://github.com/docker/compose/releases/download/1.29.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
```

### 3. Create Deployment User & SSH Access
```bash
# Create dedicated deploy user
sudo useradd -m -s /bin/bash deploy
sudo usermod -aG docker deploy

# Configure SSH key authentication for deploy user
sudo mkdir -p /home/deploy/.ssh
sudo chmod 700 /home/deploy/.ssh

# Paste your public SSH key into authorized_keys
sudo touch /home/deploy/.ssh/authorized_keys
sudo chmod 600 /home/deploy/.ssh/authorized_keys
sudo chown -R deploy:deploy /home/deploy/.ssh

# Add public key (replace with your actual SSH public key)
echo "ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQ..." | sudo tee -a /home/deploy/.ssh/authorized_keys
```

### 4. Setup Working Directory & Repository Files
```bash
# Create project directory
sudo mkdir -p /opt/nagaldhamfarm
sudo chown -R deploy:deploy /opt/nagaldhamfarm

# Switch to deploy user
su - deploy
cd /opt/nagaldhamfarm

# Clone repository or copy setup files
git clone https://github.com/Aryanbhuva/nagaldhamfarm.git .
```

### 5. Configure Production Environment File
Create `/opt/nagaldhamfarm/.env` on the server:
```bash
cp .env.production.example .env

# Edit .env and set your secrets, database credentials, and APP_KEY
nano .env
```

Make sure your `.env` includes:
```ini
APP_NAME="Nagaldham Farm"
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_GENERATED_APP_KEY_HERE
APP_URL=http://YOUR_EC2_PUBLIC_IP:8085
HTTP_PORT=8085
IMAGE_TAG=latest
```

---

## 🔑 Step 2: GitHub Repository Secrets Configuration

Navigate to your GitHub repository:
**Settings** → **Secrets and variables** → **Actions** → **Repository secrets** → **New repository secret**

Add the following 5 secrets:

| Secret Name | Description | Example / How to Obtain |
|---|---|---|
| `EC2_HOST` | Public IP or DNS of your EC2 instance | `54.210.45.12` or `ec2-xx.compute.amazonaws.com` |
| `EC2_USER` | SSH username configured on server | `deploy` (or `ubuntu`) |
| `EC2_SSH_KEY` | Private SSH key matching the public key in `authorized_keys` | Full contents of `~/.ssh/id_rsa` (including `-----BEGIN OPENSSH PRIVATE KEY-----`) |
| `EC2_SSH_PORT` | SSH Port (default `22`) | `22` |
| `GHCR_PAT` | GitHub Personal Access Token with `read:packages` scope | Generated via GitHub Settings → Developer Settings → Personal Access Tokens (Classic) → check `read:packages` |

---

## 🔄 Step 3: Trigger First Deployment

1. Merge your development/staging branch into `main`:
   ```bash
   git checkout main
   git merge staging
   git push origin main
   ```
2. Monitor the workflow execution under the **Actions** tab in GitHub.
3. Once completed, verify site status:
   ```bash
   curl -I http://<EC2_PUBLIC_IP>:8085/
   ```
