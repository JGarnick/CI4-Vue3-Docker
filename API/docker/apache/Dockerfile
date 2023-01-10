FROM php:8-apache

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

COPY API/docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update
RUN apt-get install -y \
    git \
    zip \
    curl \
    sudo \
    unzip \
    libicu-dev \
    libbz2-dev \
    libpng-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libreadline-dev \
    libfreetype6-dev \
    g++ \
    nano

RUN docker-php-ext-install \
    bz2 \
    intl \
    bcmath \
    opcache \
    calendar \
    pdo_mysql \
    mysqli

RUN a2enmod rewrite headers

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer
RUN composer self-update

RUN composer require --dev phpunit/phpunit

#XDebug Setup
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

RUN mkdir -p /home/xdebug

COPY API/docker/php/xdebug-debug.ini /home/xdebug/xdebug-debug.ini
COPY API/docker/php/xdebug-default.ini /home/xdebug/xdebug-default.ini
COPY API/docker/php/xdebug-off.ini /home/xdebug/xdebug-off.ini
COPY API/docker/php/xdebug-profile.ini /home/xdebug/xdebug-profile.ini
COPY API/docker/php/xdebug-trace.ini /home/xdebug/xdebug-trace.ini

ARG XDEBUG_MODES
ARG REMOTE_HOST="host.docker.internal"
ARG REMOTE_PORT=9003
ARG IDE_KEY="docker"

ENV MODES=$XDEBUG_MODES
ENV CLIENT_HOST=$REMOTE_HOST
ENV CLIENT_PORT=$REMOTE_PORT
ENV IDEKEY=$IDE_KEY

COPY API/docker/php/apache-entrypoint.sh /home/apache-entrypoint
RUN chmod +x /home/apache-entrypoint

WORKDIR /var/www/html

# ENTRYPOINT ["/home/apache-entrypoint"]

EXPOSE 80