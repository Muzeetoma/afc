# Use the official PHP image as base
FROM php:8.2-fpm

FROM node:18.18-alpine3.17

# Set working directory
WORKDIR /app

# Install dependencies
RUN apt-get update && \
    apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy Laravel files
COPY . .

# Install dependencies
RUN composer install

RUN npm install

# Expose port
EXPOSE 9007

# Start PHP-FPM server
CMD ["php-fpm"]