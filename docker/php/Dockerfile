# ./docker/php/Dockerfile
FROM php:7.2-fpm

RUN docker-php-ext-install pdo_mysql

WORKDIR /usr/src/symfony

COPY . /usr/src/symfony