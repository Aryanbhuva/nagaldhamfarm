#!/bin/sh
set -e

echo "==> Nagaldham Farm Container Entrypoint starting..."

# Create public storage symlink if missing
if [ ! -L /var/www/html/public/storage ] && [ ! -d /var/www/html/public/storage ]; then
    echo "==> Creating storage symlink..."
    php artisan storage:link --no-interaction || true
fi

# Cache configuration, routes, and views for production performance
echo "==> Optimization: Caching config, routes, and views..."
php artisan config:cache --no-interaction
php artisan route:cache --no-interaction
php artisan view:cache --no-interaction

echo "==> Nagaldham Farm application initialization complete. Executing command..."
exec "$@"
