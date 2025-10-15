FROM php:8.2-cli

# Installe les extensions nécessaires pour Laravel
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libzip-dev libonig-dev libxml2-dev && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Installe Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copie le code Laravel
WORKDIR /var/www
COPY . .

# Installe les dépendances
RUN composer install

# Commande par défaut : lancer le serveur Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
