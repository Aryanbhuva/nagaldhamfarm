# ==============================================================================
# Nagaldham Farm — Production Dockerfile
# Stage 1: Vendor Dependencies
# Stage 2: Node.js Asset Build (Vite)
# Stage 3: PHP 8.2-FPM Production Runtime
# ==============================================================================

# --- Stage 1: Composer Vendor Dependencies ---
FROM composer:2 AS vendor
WORKDIR /app

# Copy composer manifest
COPY composer.json ./

# Install production dependencies without scripts or autoloader generation
RUN composer install \
    --no-dev \
    --no-scripts \
    --prefer-dist \
    --no-autoloader \
    --ignore-platform-reqs \
    --no-security-blocking

# Copy application source code for autoloader optimization
COPY app/ app/
COPY bootstrap/ bootstrap/
COPY config/ config/
COPY database/ database/
COPY routes/ routes/

# Generate optimized autoloader without triggering artisan scripts
RUN composer dump-autoload --no-dev --optimize --no-scripts

# --- Stage 2: Vite Frontend Asset Build ---
FROM node:20-alpine AS assets
WORKDIR /app

# Copy package manifests and config
COPY package.json ./
COPY vite.config.js ./
COPY resources/ resources/
COPY public/ public/

# Install dependencies and build static assets
RUN npm install
RUN npm run build

# --- Stage 3: Production PHP 8.4-FPM Runtime ---
FROM php:8.4-fpm-alpine AS app

# Install system runtime dependencies
RUN apk add --no-cache \
    bash \
    fcgi \
    netcat-openbsd \
    freetype \
    libjpeg-turbo \
    libwebp \
    libpng \
    libzip \
    icu-libs \
    oniguruma

# Install build dependencies, build PHP extensions, and clean up
RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    freetype-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    libpng-dev \
    libzip-dev \
    icu-dev \
    oniguruma-dev \
    libxml2-dev \
 && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
 && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    opcache \
    bcmath \
    mbstring \
    exif \
    pcntl \
    intl \
    zip \
    gd \
 && apk del .build-deps

# Copy custom PHP & FPM configurations
COPY docker/php/php.ini /usr/local/etc/php/conf.d/custom.ini
COPY docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf

WORKDIR /var/www/html

# Copy application source code
COPY . /var/www/html

# Copy dependencies from vendor stage
COPY --from=vendor /app/vendor /var/www/html/vendor

# Copy compiled assets from assets stage
COPY --from=assets /app/public/build /var/www/html/public/build

# Copy and set entrypoint script
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Create required directories and set proper ownership and permissions
RUN mkdir -p storage/app/public storage/framework/cache/data storage/framework/sessions storage/framework/testing storage/framework/views storage/logs bootstrap/cache \
 && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public \
 && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Switch to non-root user
USER www-data

# Run package discovery with dummy APP_KEY for build phase
RUN php artisan package:discover --ansi

# Healthcheck targeting PHP-FPM ping endpoint via cgi-fcgi
HEALTHCHECK --interval=10s --timeout=3s --start-period=10s --retries=3 \
  CMD SCRIPT_NAME=/ping SCRIPT_FILENAME=/ping REQUEST_METHOD=GET cgi-fcgi -bind -connect 127.0.0.1:9000 || exit 1

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]
