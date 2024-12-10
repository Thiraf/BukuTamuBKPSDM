#!/bin/bash

echo "Mengatur ulang izin untuk storage dan cache..."
chmod -R 775 /var/www/storage /var/www/bootstrap/cache
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

if [ ! -f /var/www/storage/logs/laravel.log ]; then
    echo "Membuat file log Laravel..."
    touch /var/www/storage/logs/laravel.log
fi

chmod 775 /var/www/storage/logs/laravel.log
chown www-data:www-data /var/www/storage/logs/laravel.log

check_seeder_data() {
    echo "Memeriksa keberadaan data seeder di database..."
    php -r "
    require 'vendor/autoload.php';
    try {
        \$app = require_once 'bootstrap/app.php';
        \$kernel = \$app->make(Illuminate\Contracts\Console\Kernel::class);
        \$kernel->bootstrap();
        \$exists = Illuminate\Support\Facades\DB::table('users')->exists();
        exit(\$exists ? 0 : 1);
    } catch (\Exception \$e) {
        echo 'Error memeriksa data seeder: ' . \$e->getMessage();
        exit(1);
    }
    "
}
check_seeder_data
if [ $? -ne 0 ]; then
    echo "Menjalankan migrasi dan seeder..."
    php artisan migrate --force
    php artisan db:seed --force
else
    echo "Data seeder sudah ada. Tidak perlu menjalankan lagi."
fi

exec php-fpm
