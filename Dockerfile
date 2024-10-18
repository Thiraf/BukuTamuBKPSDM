# Menggunakan image dasar PHP dengan FPM
FROM php:8.1-fpm

# Install dependencies sistem
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set direktori kerja di dalam container
WORKDIR /var/www/html

# Copy seluruh file project ke container
COPY . .

# Jalankan composer install untuk menginstal dependencies Laravel
RUN composer install

# Set permission untuk direktori storage dan bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 9000 untuk FPM
EXPOSE 9000

# Jalankan PHP-FPM sebagai proses utama
CMD ["php-fpm"]
