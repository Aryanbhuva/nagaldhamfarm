COMPOSE ?= $(shell command -v docker-compose 2>/dev/null || echo "docker compose")
COMPOSE_FILE = docker-developer/docker-compose.dev.yml

.PHONY: build up down restart recreate logs shell artisan composer key clean-cache help

.DEFAULT_GOAL := help

help: ## Display this help screen
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-15s\033[0m %s\n", $$1, $$2}'

build: ## Build/rebuild local developer Docker images
	$(COMPOSE) -f $(COMPOSE_FILE) build

up: ## Start local developer containers manually
	$(COMPOSE) -f $(COMPOSE_FILE) up -d

down: ## Stop and remove local developer containers
	$(COMPOSE) -f $(COMPOSE_FILE) down

restart: ## Restart local developer containers
	$(COMPOSE) -f $(COMPOSE_FILE) restart

recreate: ## Force recreate local developer containers
	$(COMPOSE) -f $(COMPOSE_FILE) up -d --force-recreate

logs: ## Stream developer container logs
	$(COMPOSE) -f $(COMPOSE_FILE) logs -f

shell: ## Open interactive bash shell inside dev container
	$(COMPOSE) -f $(COMPOSE_FILE) exec app bash

artisan: ## Run Laravel artisan command (usage: make -f docker-developer/Makefile artisan CMD="migrate")
	$(COMPOSE) -f $(COMPOSE_FILE) exec app php artisan $(CMD)

composer: ## Run Composer command (usage: make -f docker-developer/Makefile composer CMD="install")
	$(COMPOSE) -f $(COMPOSE_FILE) exec app composer $(CMD)

key: ## Generate APP_KEY in local .env file
	@test -f .env || cp .env.example .env
	$(COMPOSE) -f $(COMPOSE_FILE) run --rm app php artisan key:generate

clean-cache: ## Clear Laravel caches locally
	$(COMPOSE) -f $(COMPOSE_FILE) exec app php artisan config:clear
	$(COMPOSE) -f $(COMPOSE_FILE) exec app php artisan route:clear
	$(COMPOSE) -f $(COMPOSE_FILE) exec app php artisan view:clear
