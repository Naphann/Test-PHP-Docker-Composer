FROM php:5.6-apache
RUN apt-get update && \
    apt-get install -y --no-install-recommends git zip
RUN curl --silent --show-error https://getcomposer.org/installer | php
ADD ./composer.json /var/www/html
WORKDIR /var/www/html
RUN php composer.phar install
