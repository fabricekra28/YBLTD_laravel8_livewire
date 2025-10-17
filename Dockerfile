FROM php:8.2-fpm

WORKDIR /var/www/html

# Installer les dépendances
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libzip-dev libonig-dev libxml2-dev && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copier le code
COPY . .

# Installer les dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Préparer Laravel pour production
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

EXPOSE 9000
CMD ["php-fpm"]
