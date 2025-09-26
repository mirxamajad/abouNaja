FROM php:8.3-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    bash \
    git \
    curl \
    libpq \
    icu-dev \
    libxml2-dev \
    oniguruma-dev \
    libzip-dev \
    zip \
    unzip \
    mysql-client \
    $PHPIZE_DEPS

# Install PHP extensions
RUN docker-php-ext-configure zip \
    && docker-php-ext-install pdo pdo_mysql intl xml zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy php.ini if needed (optional)
# COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/php.ini

CMD ["php-fpm"]
