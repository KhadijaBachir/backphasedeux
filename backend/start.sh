#!/usr/bin/env sh

# S'assurer que l'exécutable PHP est dans le PATH pour les commandes artisan
export PATH="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin"

# NOUVEAU: Vider le cache de configuration pour s'assurer que les variables d'environnement de Render sont lues
echo "--- Starting service in production mode ---" # AJOUT POUR DEBUG
php artisan config:clear
php artisan route:clear

# Exécuter les migrations Laravel (et forcer si déjà fait)
echo "Running database migrations..."
php artisan migrate --force

# Vérifier si la migration a réussi avant de lancer le serveur
if [ $? -ne 0 ]; then
  echo "Database migration failed! Exiting."
  exit 1
fi

# Lancer le serveur Apache au premier plan
echo "Starting Apache server..."
apache2-foreground
