FROM php:8.1-fpm-alpine

RUN apk --update --no-cache add git

RUN apk add bash

RUN docker-php-ext-install pdo_mysql

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

CMD composer install;  php-fpm

EXPOSE 9000
