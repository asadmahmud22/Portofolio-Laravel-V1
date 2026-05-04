FROM php:8.2-cli

# Build: v2
RUN apt-get update && apt-get install -y \
    unzip git curl libsqlite3-dev

RUN docker-php-ext-install pdo pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader && \
    mkdir -p database && \
    touch database/database.sqlite && \
    mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache && \
    chmod -R 777 storage bootstrap/cache

EXPOSE 10000

CMD php artisan migrate:fresh --force && \
    php artisan config:clear && \
    php artisan view:clear && \
    php -S 0.0.0.0:10000 -t public