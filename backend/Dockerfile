# Utiliser PHP 8.2 avec Apache
FROM php:8.2-apache

# Installer les dépendances système et extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git libonig-dev libxml2-dev \
    # AJOUT POSTGRESQL: libpq-dev est la dépendance système
    libpq-dev \
    # Installation de pdo_pgsql EN PLUS de pdo_mysql (pour la compatibilité)
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip mbstring bcmath xml \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier tous les fichiers Laravel
COPY . .

# Installer les dépendances PHP du projet
RUN composer install --optimize-autoloader --no-dev

# Définir les permissions pour Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Activer le module rewrite d'Apache
RUN a2enmod rewrite

# Configurer Apache pour pointer vers le dossier public
RUN sed -i 's#/var/www/html#/var/www/html/public#g' /etc/apache2/sites-available/000-default.conf

# Mettre en cache Laravel pour de meilleures performances
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# NOUVEAU: Copier le script de démarrage et le rendre exécutable
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

# Exposer le port 80
EXPOSE 80

# NOUVEAU: Utiliser le script de démarrage comme CMD principal
CMD ["start.sh"]
