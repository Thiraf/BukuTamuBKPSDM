#!/bin/bash


if [ ! -f /var/www/storage/.migrations_ran ]; then
    echo "Menjalankan migrasi dan seeder..."
    php artisan migrate --force
    php artisan db:seed --force

    touch /var/www/storage/.migrations_ran
else
    echo "Migrasi dan seeder sudah dijalankan sebelumnya."
fi

exec php-fpm
