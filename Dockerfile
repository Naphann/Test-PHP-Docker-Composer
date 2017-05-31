FROM php:5.6-apache
RUN apt-get update && \
    apt-get install -y --no-install-recommends git zip unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng12-dev
RUN a2enmod rewrite
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install -j$(nproc) iconv mcrypt \
	&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
	&& docker-php-ext-install -j$(nproc) gd
# ADD ./src /var/www/html/
# ADD ./config /var/www/html/config
# RUN curl --silent --show-error https://getcomposer.org/installer | php
# ADD ./composer.json /var/www/html/
# WORKDIR /var/www/html
# RUN php composer.phar install
