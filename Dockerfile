FROM php:8.2-fpm-bullseye


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

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd
RUN docker-php-ext-install pdo_mysql

# Unduh installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Jalankan installer untuk memasang Composer
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Hapus file installer setelah selesai
RUN rm composer-setup.php

# Pastikan izin direktori tepat untuk server
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

# Menjalankan migrate
CMD php artisan migrate --force && php-fpm

EXPOSE 9000

WORKDIR /var/www
