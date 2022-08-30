FROM php:7.4-fpm

WORKDIR /app

COPY . /app

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
&& docker-php-ext-install sqlite3

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
