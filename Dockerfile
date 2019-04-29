FROM php:7.2-apache

WORKDIR /var/www/html

# Install required packages and PHP modules
RUN apt-get update 
RUN apt-get upgrade -y
RUN apt-get -y install --fix-missing apt-utils build-essential git curl libcurl3 libcurl3-dev zip vim

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Other PHP7 Extensions
RUN apt-get -y install libmcrypt-dev

RUN apt-get -y install libsqlite3-dev libsqlite3-0 mysql-client
RUN docker-php-ext-install pdo_mysql 
RUN docker-php-ext-install pdo_sqlite
RUN docker-php-ext-install mysqli

RUN docker-php-ext-install curl
RUN docker-php-ext-install tokenizer
RUN docker-php-ext-install json

RUN apt-get -y install zlib1g-dev
RUN docker-php-ext-install zip

RUN apt-get -y install libicu-dev
RUN apt-get -y install sendmail
RUN docker-php-ext-install -j$(nproc) intl

RUN docker-php-ext-install mbstring

RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ 
RUN docker-php-ext-install -j$(nproc) gd

RUN apt-get -y install wget 

# Install phpunit
RUN wget https://phar.phpunit.de/phpunit-6.0.phar && \
    chmod +x phpunit-6.0.phar && \
    mv phpunit-6.0.phar /usr/local/bin/phpunit

# Install codecept
RUN wget http://codeception.com/codecept.phar && \
    chmod +x codecept.phar && \
    mv codecept.phar /usr/local/bin/codecept

RUN a2enmod rewrite

# Fix write permissions with shared folders
RUN usermod -u 1000 www-data

# Copy the working dir to the image's web root
COPY . /var/www/html
RUN mkdir -p /var/www/html/web/assets

# Init composer
RUN composer self-update
RUN composer install --no-plugins --no-scripts

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
