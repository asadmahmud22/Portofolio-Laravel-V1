FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    unzip git curl libsqlite3-dev

RUN docker-php-ext-install pdo pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

# SET ENV
RUN cp .env.example .env || true

# BUAT DATABASE DULU (WAJIB SEBELUM ARTISAN)
RUN mkdir -p database
RUN touch database/database.sqlite

# BARU JALANKAN LARAVEL
RUN php artisan config:clear
RUN php artisan cache:clear
RUN php artisan key:generate --force
RUN php artisan migrate --force

# PERMISSION
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 10000

CMD php -S 0.0.0.0:10000 -t public