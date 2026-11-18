#!/usr/bin/env bash
set -e

# Configure Apache to listen on Render's assigned $PORT (defaults to 80)
PORT="${PORT:-80}"
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/000-default.conf

# Clear stale caches and run any pending database migrations
php artisan config:clear
php artisan view:clear
php artisan route:clear
php artisan migrate --force

# Start Apache in the foreground
exec apache2-foreground
