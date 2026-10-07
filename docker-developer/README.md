# 💻 Nagaldham Farm — Local Developer Docker Setup

This directory contains the isolated **local development Docker configuration** for developer PCs. It allows developers to start, stop, rebuild, and work locally on the application with live code reloading.

---

## 🚀 Quick Start (For Developers)

### 1. Configure Environment
```bash
# Create local .env if missing
cp .env.example .env
```

### 2. Build & Start Local Containers
```bash
# Build dev images
make -f docker-developer/Makefile build

# Start dev containers in background
make -f docker-developer/Makefile up
```

### 3. Access App
Open your browser at: **[http://localhost:8080](http://localhost:8080)**

*(Change port by setting `DEV_PORT=8090` in your `.env` file)*

---

## 🛠️ Developer Commands

Use the dedicated Makefile inside `docker-developer/`:

| Command | Description |
|---|---|
| `make -f docker-developer/Makefile build` | Build/rebuild developer Docker images |
| `make -f docker-developer/Makefile up` | Start local dev containers |
| `make -f docker-developer/Makefile down` | Stop and remove dev containers |
| `make -f docker-developer/Makefile restart` | Restart dev containers |
| `make -f docker-developer/Makefile recreate` | Force recreate dev containers |
| `make -f docker-developer/Makefile logs` | View container logs in real time |
| `make -f docker-developer/Makefile shell` | Access interactive bash shell in dev container |
| `make -f docker-developer/Makefile artisan CMD="migrate"` | Run Laravel Artisan command |
| `make -f docker-developer/Makefile composer CMD="install"` | Run Composer command |
| `make -f docker-developer/Makefile key` | Generate application key in `.env` |
| `make -f docker-developer/Makefile clean-cache` | Clear Laravel caches |

---

## ⚡ Direct Docker Compose Commands

Alternatively, you can run `docker-compose` directly:

```bash
# Start dev environment
docker-compose -f docker-developer/docker-compose.dev.yml up -d

# Rebuild dev environment
docker-compose -f docker-developer/docker-compose.dev.yml build

# Stop dev environment
docker-compose -f docker-developer/docker-compose.dev.yml down

# Force recreate dev containers
docker-compose -f docker-developer/docker-compose.dev.yml up -d --force-recreate
```
