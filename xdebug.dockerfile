FROM php:7.2

RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

# Install xdebug
# Referring to: https://jasonmccreary.me/articles/install-pear-pecl-mac-os-x/
# RUN curl -O http://pear.php.net/go-pear.phar
# RUN php -d detect_unicode=0 go-pear.phar
# RUN pecl install xdebug-2.7.0
# RUN docker-php-ext-enable xdebug

