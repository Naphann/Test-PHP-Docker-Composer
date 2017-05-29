FROM php:5.6-apache
RUN apt-get update && \
    apt-get install -y --no-install-recommends git zip unzip
RUN a2enmod rewrite
RUN docker-php-ext-install pdo_mysql
# ADD ./src /var/www/html/
# ADD ./config /var/www/html/config
# RUN curl --silent --show-error https://getcomposer.org/installer | php
# ADD ./composer.json /var/www/html/
# WORKDIR /var/www/html
# RUN php composer.phar install
