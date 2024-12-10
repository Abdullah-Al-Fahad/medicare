# Start with a PHP image with Apache
FROM php:8.2-apache

# Install system dependencies for PHP extensions and Node.js (including npm)
RUN apt update && apt install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libjpeg-dev \
    libfreetype6-dev \
    unzip \
    npm \
    libpq-dev \ 
    && apt clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions (pdo_mysql, mbstring, exif, pcntl, bcmath, gd, zip, pdo_pgsql)
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip pdo_pgsql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer (PHP dependency manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory to the Laravel project root
WORKDIR /var/www/html

# Copy the Laravel application code into the container
COPY . .

# Set permissions for Laravel storage and cache directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Install PHP dependencies using Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node.js dependencies
RUN npm install

# Expose Apache port
EXPOSE 80

# Start the server, run migrations, and then start npm in sequence
CMD php artisan serve --host=0.0.0.0 & \
    sleep 5 && php artisan migrate --force && \
    npm run dev && \
    tail -f /dev/null
