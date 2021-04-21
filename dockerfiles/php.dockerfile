FROM php:8-fpm-alpine

WORKDIR /var/www/html

COPY --chown=www-data:www-data src .

RUN docker-php-ext-install pdo pdo_mysql calendar

RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

USER laravel
