FROM php:7.2-apache

RUN echo 'memory_limit = 1536M' > /usr/local/etc/php/conf.d/memory_limit.ini

RUN mkdir -p ~/.gnupg/private-keys-v1.d
RUN chmod 700 ~/.gnupg/private-keys-v1.d

RUN apt update && apt install -y libpq-dev libpng-dev libxml2-dev git
RUN docker-php-ext-install gd xml zip mbstring

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
     && docker-php-ext-install pdo pdo_pgsql pgsql

WORKDIR /var/www/api

# Instalando o Composer
RUN php -r "copy('http://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

# Copiando os arquivos do diretório para dentro do container
COPY . .

# Configurando o apache e instalando dependências do projeto com o composer
RUN composer run post-root-package-install
COPY env/conf/apache/api.conf /etc/apache2/sites-enabled
RUN rm /etc/apache2/sites-enabled/000-default.conf
RUN composer install
RUN a2enmod rewrite

# Configura as permissões das pastas
RUN chown -R www-data:www-data /var/www/api
RUN find /var/www/api -type f -exec chmod 644 {} \;
RUN find /var/www/api -type d -exec chmod 755 {} \;
RUN chgrp -R www-data storage
RUN chmod -R ug+rwx storage
