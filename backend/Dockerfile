# Dockerfile pour Laravel
FROM php:8.2-apache

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git \
    && docker-php-ext-install pdo pdo_mysql zip

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copier les fichiers Laravel
COPY . /var/www/html

WORKDIR /var/www/html

# Installer les dépendances PHP
RUN composer install --optimize-autoloader --no-dev

# Permissions pour le stockage
RUN chown -R www-data:www-data storage bootstrap/cache

# Exposer le port 80
EXPOSE 80

# Commande de démarrage
CMD ["apache2-foreground"]
