FROM php:8.3-fpm-alpine

# Dépendances système
RUN apk add --no-cache \
    postgresql-dev \
    libzip-dev \
    icu-dev \
    zip \
    unzip \
    git \
    curl \
    oniguruma-dev \
    autoconf \
    g++ \
    make

# Extensions PHP requises par Laravel + PostgreSQL
RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    pgsql \
    bcmath \
    zip \
    intl \
    opcache

# Extension Redis (via PECL)
RUN pecl install redis && docker-php-ext-enable redis

# Composer v2 depuis l'image officielle
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

EXPOSE 9000

CMD ["php-fpm"]