FROM php:7.1-apache
#install curl
RUN apt-get update && apt install -y curl git vim

# Install mcrypt

# Activate apache mod_rewrite
RUN a2enmod rewrite

# Install mysqli php extension
RUN apt-get update && apt-get install -y \
    && docker-php-ext-install -j$(nproc) mysqli \
    && rm -rf /var/lib/apt/lists/*

# Install zip extension
RUN apt-get update && apt-get install -y \
        libzip-dev \
        zip \
    && docker-php-ext-install -j$(nproc) zip

# Install PDO MySQL extension
RUN apt-get update \
        && docker-php-ext-install -j$(nproc) pdo pdo_mysql \
        && docker-php-ext-enable pdo_mysql

# Install Intl extension
RUN apt update && apt install -y zlib1g-dev libicu-dev libpng-dev libjpeg-dev libfreetype6-dev g++ && \
docker-php-ext-configure intl && \
docker-php-ext-install -j$(nproc) intl 

# Install gd
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg
RUN cd /usr/src/php/ext/gd && make
RUN cp /usr/src/php/ext/gd/modules/gd.so /usr/local/lib/php/extensions/no-debug-non-zts-20190902/gd.so
RUN docker-php-ext-install -j$(nproc) gd

COPY php.ini /usr/local/etc/php/php.ini

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer 

# Install node.js and npm
RUN apt update && apt install -y nodejs npm 

COPY setup.sh /tmp/setup.sh
COPY wait_for_service.sh /tmp/wait_for_service.sh
#COPY defines.inc.php /var/www/html/config/defines.inc.php 

