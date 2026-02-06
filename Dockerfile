# Stage 1: Build React Assets
FROM node:14 AS node-build
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run production

# Stage 2: PHP Application & Nginx
FROM php:7.4-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    nginx \
    iputils-ping

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . /var/www

# Copy built assets from node-build stage
COPY --from=node-build /app/public /var/www/public

# Copy Nginx configuration
COPY docker/nginx/conf.d/default.conf /etc/nginx/sites-available/default
RUN ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default
RUN rm -f /etc/nginx/conf.d/default.conf

# Install PHP dependencies
RUN composer install --no-interaction --no-dev --optimize-autoloader

# Ensure all Laravel storage directories exist
RUN mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/testing storage/framework/views storage/logs && \
    chown -R www-data:www-data storage bootstrap/cache

# Configure PHP-FPM to handle logs and environment correctly
RUN sed -i 's/;catch_workers_output = yes/catch_workers_output = yes/g' /usr/local/etc/php-fpm.d/www.conf && \
    sed -i 's/;clear_env = no/clear_env = no/g' /usr/local/etc/php-fpm.d/www.conf && \
    echo "php_admin_value[error_log] = /proc/self/fd/2" >> /usr/local/etc/php-fpm.d/www.conf && \
    echo "php_admin_flag[log_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf

# Create startup script
RUN echo "#!/bin/sh\n\
# Fix permissions at runtime for mounted volumes\n\
mkdir -p /var/www/storage/framework/cache/data /var/www/storage/framework/sessions /var/www/storage/framework/views /var/www/storage/logs\n\
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache\n\
chmod -R 775 /var/www/storage /var/www/bootstrap/cache\n\
\n\
# Diagnostics: Check if we can see the database\n\
echo \"--- DNS Diagnostic ---\"\n\
ping -c 1 db || echo \"CANNOT RESOLVE db\"\n\
echo \"----------------------\"\n\
\n\
# Clear Laravel Cache (Crucial for Laravel 5.7 when changing ENV)\n\
php artisan config:clear\n\
\n\
php-fpm -D\n\
nginx -g 'daemon off;'" > /usr/local/bin/start-app.sh
RUN chmod +x /usr/local/bin/start-app.sh

EXPOSE 80 3006 9000

CMD ["/usr/local/bin/start-app.sh"]
