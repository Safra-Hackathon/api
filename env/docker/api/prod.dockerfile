FROM php:7.2-apache

RUN echo 'memory_limit = 1536M' > /usr/local/etc/php/conf.d/memory_limit.ini

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
RUN mv env/conf/apache/api.conf /etc/apache2/sites-enabled
RUN rm /etc/apache2/sites-enabled/000-default.conf
RUN composer install
RUN a2enmod rewrite

# Configura as permissões das pastas
RUN chown -R www-data:www-data /var/www/api
RUN find /var/www/api -type f -exec chmod 644 {} \;
RUN find /var/www/api -type d -exec chmod 755 {} \;
RUN chgrp -R www-data storage
RUN chmod -R ug+rwx storage

#TODO: Adicionar o microscanner abaixo e gerar um artefato do circle ou github que fique disponível para análise. (exite parametro para gerar em formato html ao invés de JSON)

# Security Scanner: Aqua Microscanner - Faz uma análise de falhas de segurança nessa imagem do Docker
#ADD https://get.aquasec.com/microscanner .
#RUN chmod +x microscanner
# As linhas abaixo servem para desativar o cache dos comandos depois do ARG CACHEBURST=1
# O cache é desativado quando rodamos o comando passando o parâmetro CACHEBURST na hora de rodar o comando docker build, sobrescrevendo essa variável por um valor único.
# Exemplo: docker build . --tag expo-api --build-arg CACHEBURST=$(date +%s) -f .docker/web-server/prod.dockerfile
#ARG CACHEBUST=1
# O comando abaixo roda o microscanner e também pega o max_score retornado pelo scanner e coloca numa variável MAX_SCORE
#RUN MAX_SCORE=$(./microscanner NmFlYjhlMzE0YmVl --continue-on-failure | grep -A 9 '"vulnerability_summary"' | grep -Po '"max_score": *\K(.+)')
#RUN echo $(( MAX_SCORE < 7 ))
# Se o max_score for menor do que 7, quer dizer que algo mudou e mais vulnerabilidades foram encontradas, portanto a build para
#RUN if [ $(( MAX_SCORE < 7 )) ]; then exit 1; fi
#RUN rm ./microscanner

# Por segurança é bom alterar o usuário do container / imagem do docker para nobody no final da build, assim não corremos tanto perigo com pessoas tentando usar o usuário root para rodar coisas indesejáveis
#USER nobody
