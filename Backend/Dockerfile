FROM php:8.2-apache

# Cài PHP extensions cần thiết
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Cài thêm các công cụ hệ thống và Node.js, npm
RUN apt-get update && apt-get install -y \
    libpq-dev \
    nodejs \
    npm \
    git \
    unzip \
    && docker-php-ext-install pdo_pgsql

# Bật các module Apache cần thiết
RUN a2enmod rewrite ssl

# Cài composer (phiên bản mới nhất từ image composer)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Đặt thư mục làm việc
WORKDIR /var/www/html

# Copy mã nguồn Laravel vào container
COPY . .

# Cài PHP packages bằng Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Build frontend assets nếu dùng Laravel Mix/Vite
RUN npm install && npm run build

# Set quyền cho Laravel (nếu chưa set trong entrypoint.sh)
RUN chown -R www-data:www-data storage bootstrap/cache

# Copy entrypoint và cấp quyền thực thi
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Copy cấu hình Apache để Laravel chạy từ public/
COPY apache.conf /etc/apache2/sites-available/000-default.conf
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf


# Chạy Apache khi container khởi động
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
