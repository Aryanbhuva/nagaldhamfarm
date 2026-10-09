#!/bin/sh
set -e

echo "==> Nagaldham Farm Container Entrypoint starting..."

# Ensure storage & cache subdirectories exist with full write permissions
mkdir -p /var/www/html/storage/app/public \
         /var/www/html/storage/framework/cache/data \
         /var/www/html/storage/framework/sessions \
         /var/www/html/storage/framework/testing \
         /var/www/html/storage/framework/views \
         /var/www/html/storage/logs \
         /var/www/html/bootstrap/cache 2>/dev/null || true

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true


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
