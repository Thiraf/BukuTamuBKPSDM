FROM php:8.2-fpm-bullseye

# Instal dependensi yang diperlukan
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# Konfigurasi dan instal ekstensi PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd
RUN docker-php-ext-install pdo_mysql

# Salin Composer dari image resmi
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Pastikan izin direktori tepat untuk server
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

# Jalankan migrate saat container dijalankan
CMD php artisan migrate --force && php-fpm

# Ekspos port PHP-FPM
EXPOSE 9000

# Atur direktori kerja ke /var/www
WORKDIR /var/www
