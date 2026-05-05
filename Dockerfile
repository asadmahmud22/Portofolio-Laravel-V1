FROM php:8.2-cli

# Build: v5
RUN apt-get update && apt-get install -y \
    unzip git curl libsqlite3-dev libpq-dev

RUN docker-php-ext-install pdo pdo_sqlite pdo_pgsql pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader && \
    mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache && \
    chmod -R 777 storage bootstrap/cache

EXPOSE 10000

CMD php artisan migrate --force && \
    php artisan db:seed --force && \
    php artisan storage:link && \
    php artisan config:clear && \
    php artisan view:clear && \
    php -S 0.0.0.0:10000 -t public