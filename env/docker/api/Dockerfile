FROM php:7.2-apache
ARG XDEBUG_VERSION=2.6.0

RUN mkdir -p ~/.gnupg/private-keys-v1.d
RUN chmod 700 ~/.gnupg/private-keys-v1.d

RUN apt update && apt install -y libpq-dev libpng-dev libxml2-dev git
RUN docker-php-ext-install gd xml zip mbstring

RUN pecl install xdebug-2.6.0 && docker-php-ext-enable xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" >> /usr/local/etc/php/php.ini  \
    && echo "xdebug.remote_port=9000" >> /usr/local/etc/php/php.ini \
    && echo "xdebug.remote_enable=1" >> /usr/local/etc/php/php.ini \
    && echo "xdebug.remote_connect_back=1" >> /usr/local/etc/php/php.ini \
    && echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/php.ini \
    && echo "xdebug.remote_autostart=1" >> /usr/local/etc/php/php.ini \
    && echo "xdebug.remote_log=/tmp/xdebug.log" >> /usr/local/etc/php/php.ini

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
     && docker-php-ext-install pdo pdo_pgsql pgsql

WORKDIR /var/www/api

# Instalando o Composer
RUN php -r "copy('http://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
COPY . .
RUN composer run post-root-package-install
COPY env/conf/apache/api.conf /etc/apache2/sites-enabled
RUN composer install
RUN rm /etc/apache2/sites-enabled/000-default.conf
RUN a2enmod rewrite
RUN chown -R www-data:www-data .
RUN find . -type f -exec chmod 644 {} \;
RUN find . -type d -exec chmod 755 {} \;
RUN chgrp -R www-data storage
RUN chmod -R ug+rwx storage
RUN chmod 777 storage/ -R
