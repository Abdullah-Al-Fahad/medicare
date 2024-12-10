# Step 1: Use a PHP image with Apache
FROM php:8.2-apache

# Install system dependencies for both PHP and Node.js (including Node.js itself)
RUN apt update && apt install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    npm \
    && apt clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions (pdo_mysql, mbstring, etc.)
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

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

# Start Laravel's PHP server in the background
# Then, run `npm run dev` in the foreground, after the server starts
CMD php artisan serve --host=0.0.0.0 & npm run dev
