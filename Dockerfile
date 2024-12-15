# Use the official PHP image as a base image
FROM php:7.2-apache

# Install the mysqli extension
RUN docker-php-ext-install mysqli

# Enable the mysqli extension
RUN docker-php-ext-enable mysqli

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY ./src /var/www/html

# Install PHPMailer using Composer
RUN composer require phpmailer/phpmailer

# Install TCPDF using Composer
RUN composer require tecnickcom/tcpdf

# Expose port 80
EXPOSE 80
