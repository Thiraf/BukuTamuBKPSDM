#!/bin/bash

check_seeder_data() {
    echo "Memeriksa keberadaan data seeder di database..."
    php -r "
    require 'vendor/autoload.php';
    \$app = require_once 'bootstrap/app.php';
    \$kernel = \$app->make(Illuminate\Contracts\Console\Kernel::class);
    \$kernel->bootstrap();
    \$exists = Illuminate\Support\Facades\DB::table('users')->exists();
    exit(\$exists ? 0 : 1);
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
