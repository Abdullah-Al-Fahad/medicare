# Use PHP with Apache as the base image
FROM php:8.1-apache

# Update and install required dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql zip mbstring bcmath tokenizer ctype xml \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

    
# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy all Laravel files into the container
COPY . /var/www/html

# Copy the .env file
COPY .env /var/www/html/.env

# Set permissions for Laravel storage and cache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Install Laravel dependencies using Composer
RUN composer install --no-dev --optimize-autoloader

# Expose port 80
EXPOSE 80

# Set up Apache to serve the Laravel app
CMD ["apache2-foreground"]
