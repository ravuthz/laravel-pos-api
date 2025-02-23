#!/bin/bash

# ls -lah

export APP_URL=https://laravel-pos-api.onrender.com

export APP_ENV=dev
export APP_NAME=API
export APP_DEBUG=true
export APP_TIMEZONE=Asia/Phnom_Penh

export LOG_LEVEL=debug
export LOG_STACK=daily
export LOG_CHANNEL=syslog

#export CACHE_STORE=file
#export SESSION_DRIVER=file
#export DB_CONNECTION=sqlite

# printenv

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

composer install --no-dev --quiet --no-progress --no-suggest --no-interaction --optimize-autoloader

cp .env.example .env

php artisan key:generate

php artisan migrate --force --seed

php artisan optimize:clear

php artisan storage:link


