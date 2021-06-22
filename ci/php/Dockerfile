FROM php:7.1-apache

#install curl
RUN apt-get update && apt-get install -y curl git vim wget

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
RUN apt-get update && apt-get install -y zlib1g-dev libicu-dev libpng-dev libjpeg-dev libfreetype6-dev g++ && \
docker-php-ext-configure intl && \
docker-php-ext-install -j$(nproc) intl 

# Install gd
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        jq \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

COPY php.ini /usr/local/etc/php/php.ini

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer 

# Install node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_11.x | bash -
RUN apt-get -y install nodejs
RUN apt-get install -y build-essential

COPY setup.sh /tmp/setup.sh
COPY wait_for_service.sh /tmp/wait_for_service.sh