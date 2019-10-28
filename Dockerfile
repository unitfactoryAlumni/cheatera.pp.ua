FROM php:7.2-apache

WORKDIR /var/www/html

# Install essential packages
RUN apt-get update \
    && apt-get upgrade -y \
    && apt-get -y install --fix-missing apt-utils build-essential git curl zip vim wget sendmail

# Install PHP7 Extensions and vital libs
RUN apt-get -y install libmcrypt-dev libsqlite3-dev libsqlite3-0 zlib1g-dev libicu-dev \
    libfreetype6-dev libjpeg62-turbo-dev libpng-dev libcurl4-gnutls-dev \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install pdo_sqlite \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install curl \
    && docker-php-ext-install tokenizer \
    && docker-php-ext-install json \
    && docker-php-ext-install zip \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install -j$(nproc) intl \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# Install phpunit
RUN wget https://phar.phpunit.de/phpunit-6.0.phar \
    && chmod +x phpunit-6.0.phar \
    && mv phpunit-6.0.phar /usr/local/bin/phpunit

# Install codecept
RUN wget http://codeception.com/codecept.phar \
    && chmod +x codecept.phar \
    && mv codecept.phar /usr/local/bin/codecept

RUN a2enmod rewrite

# Fix write permissions with shared folders
RUN usermod -u 1000 www-data

# Copy the working dir to the image's web root
COPY . /var/www/html
RUN mkdir -p /var/www/html/web/assets

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer self-update \
    && composer install --no-plugins --no-scripts

# Setup xdebug
RUN pecl install redis xdebug-2.6.0 \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.default_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_autostart=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_connect_back=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_port=9999" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_host=192.168.99.1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN echo "memory_limit=-1" >> /usr/local/etc/php/php.ini
