COMPOSE ?= $(shell command -v docker-compose 2>/dev/null || echo "docker compose")

.PHONY: build up down restart logs shell artisan key clean-cache help

.DEFAULT_GOAL := help

help: ## Display this help screen
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-15s\033[0m %s\n", $$1, $$2}'

build: ## Build images locally (uses docker-compose.build.yml override)
	$(COMPOSE) -f docker-compose.yml -f docker-compose.build.yml build

up: ## Start production containers (pulls GHCR image if IMAGE_TAG is set)
	$(COMPOSE) up -d

down: ## Stop and remove containers and network
	$(COMPOSE) down

restart: ## Restart all running containers
	$(COMPOSE) restart

logs: ## View container logs
	$(COMPOSE) logs -f

shell: ## Open interactive bash shell inside app container
	$(COMPOSE) exec app bash

artisan: ## Run Laravel artisan command (e.g. make artisan CMD="about")
	$(COMPOSE) exec app php artisan $(CMD)

key: ## Generate APP_KEY and write it to .env
	@test -f .env || cp .env.production.example .env
	@KEY=$$($(COMPOSE) -f docker-compose.yml -f docker-compose.build.yml run --rm --no-deps -e APP_KEY= app php artisan key:generate --show --no-ansi 2>/dev/null | tail -1 | tr -d '\r\n'); \
	sed -i "s|^APP_KEY=.*|APP_KEY=$$KEY|" .env; \
	echo "APP_KEY set: $$KEY"

clean-cache: ## Clear and rebuild Laravel configuration, route, and view caches
	$(COMPOSE) exec app php artisan config:clear
	$(COMPOSE) exec app php artisan route:clear
	$(COMPOSE) exec app php artisan view:clear
	$(COMPOSE) exec app php artisan config:cache
	$(COMPOSE) exec app php artisan route:cache
	$(COMPOSE) exec app php artisan view:cache
