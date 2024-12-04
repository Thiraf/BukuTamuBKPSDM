#!/bin/bash

# Cek apakah migrasi sudah dijalankan sebelumnya dengan melihat apakah file penanda ada
if [ ! -f /var/www/storage/.migrations_ran ]; then
    echo "Menjalankan migrasi dan seeder..."
    php artisan migrate --force
    php artisan db:seed --force
    # Tandai bahwa migrasi sudah dijalankan dengan membuat file penanda
    touch /var/www/storage/.migrations_ran
else
    echo "Migrasi dan seeder sudah dijalankan sebelumnya."
fi

# Setelah migrasi, jalankan PHP-FPM
exec php-fpm
