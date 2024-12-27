# Dockerfile for PHP-FPM with Composer, SQLite, PostgreSQL, and Redis
FROM php:8.2-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libsqlite3-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pdo_sqlite

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www/html

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis


# Copy application files (adjust according to your project structure)
COPY ./src /var/www/html

# Permissions
RUN chown -R www-data:www-data /var/www/html

# Expose the port
EXPOSE 9000

CMD ["php-fpm"]
