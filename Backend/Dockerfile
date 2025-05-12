# Sử dụng PHP chính thức (FPM)
FROM php:8.2-fpm

# Cài các tiện ích và thư viện cần thiết
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libjpeg-dev libonig-dev libxml2-dev libzip-dev \
    libpq-dev libsqlite3-dev sqlite3

# Cài đặt các extension PHP
RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Đặt thư mục làm việc
WORKDIR /var/www

# Copy toàn bộ code vào container
COPY . .

# Cài đặt thư viện Laravel (composer)
RUN composer install --no-dev --optimize-autoloader

# Phân quyền
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

# Mở cổng 8000 (Laravel serve) - Vẫn giữ để có thể chạy web nếu cần
EXPOSE 8000

# Lệnh chạy ứng dụng (sẽ được override bởi Railway Procfile)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]