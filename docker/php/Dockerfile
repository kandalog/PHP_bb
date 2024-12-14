FROM php:8.3.2-fpm-bullseye

WORKDIR /usr/src/myapp

# rootでのcomposer installを許可する環境変数
ENV COMPOSER_ALLOW_SUPERUSER=1

# COPY ./app/composer.json ./app/composer.lock /usr/src/myapp/

# composer use git zip
# apt may change the interface. apt-get would be better now.
# docker-phpext-install pdo_mysql provide driver of mysql
RUN apt-get update && apt-get install -y git zip zlib1g-dev lsof \
    && docker-php-ext-install pdo_mysql

# enable status code page
RUN echo pm.status_path = /status >> /usr/local/etc/php-fpm.d/www.conf

# Composer Install
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# package install
# RUN composer install