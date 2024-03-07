# Use an official PHP runtime as a base image
FROM php:8.2-cli

# Set the working directory to /app
WORKDIR /app

# Install Laravel dependencies
RUN apt-get update && \
    apt-get install -y libzip-dev zip && \
    docker-php-ext-install zip

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the current directory contents into the container at /app
COPY . /app

# Run Composer to install dependencies
RUN composer install

# Set up Laravel environment
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
