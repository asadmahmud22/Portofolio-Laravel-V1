FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    unzip git curl libsqlite3-dev

RUN docker-php-ext-install pdo pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader && \
    cp .env.example .env || true && \
    mkdir -p database && \
    touch database/database.sqlite && \
    php artisan key:generate --force && \
    php artisan migrate:fresh --force && \
    php artisan tinker --execute="\App\Models\User::create(['name'=>'Admin','email'=>'admin@gmail.com','password'=>bcrypt('password123')]);" && \
    php artisan config:clear && \
    php artisan cache:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache && \
    chmod -R 777 storage bootstrap/cache

EXPOSE 10000

CMD php -S 0.0.0.0:10000 -t public