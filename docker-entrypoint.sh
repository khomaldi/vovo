#!/bin/sh
set -e

echo "Устанавливаем зависимости..."
composer install --no-interaction --prefer-dist --ignore-platform-reqs --optimize-autoloader --no-scripts

echo "Sleep для базы на всякий случай..."
sleep 2

echo "Запускаем миграции..."
php artisan migrate --force

echo "Запускаем Laravel сервер..."
php artisan serve --host=0.0.0.0 --port=8000
