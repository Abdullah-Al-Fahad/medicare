# Use PHP with Apache as the base image
FROM php:8.1-apache

# Install necessary PHP extensions for a basic Laravel app with PostgreSQL
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql mbstring tokenizer xml \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy Laravel files into the container
COPY . .

# Ensure permissions for Laravel storage and cache directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Install Laravel dependencies using Composer
RUN composer install --no-dev --optimize-autoloader

# Copy the .env file into the container
COPY .env /var/www/html/.env

# Expose port 80 for Render to map
EXPOSE 80

# Start Apache to serve the Laravel app
CMD ["apache2-foreground"]
