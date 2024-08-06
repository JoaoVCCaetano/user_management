FROM php:8.0-fpm

# Instala a extensão PDO para MySQL
RUN apt-get update && apt-get install -y \
    libzip-dev \
    && docker-php-ext-install pdo_mysql

# Instala e configura o Xdebug para PHP
RUN pecl install xdebug-3.0.4 \
    && docker-php-ext-enable xdebug

# Configuração do Xdebug diretamente no Dockerfile
RUN echo 'zend_extension=xdebug.so' > $PHP_INI_DIR/conf.d/xdebug.ini \
    && echo "xdebug.mode=debug" >> $PHP_INI_DIR/conf.d/xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> $PHP_INI_DIR/conf.d/xdebug.ini \
    && echo "xdebug.client_port=9030" >> $PHP_INI_DIR/conf.d/xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> $PHP_INI_DIR/conf.d/xdebug.ini \
    && echo "xdebug.idekey=VSCODE" >> $PHP_INI_DIR/conf.d/xdebug.ini \
    && echo "xdebug.log=/var/log/xdebug.log" >> $PHP_INI_DIR/conf.d/xdebug.ini \
    && echo "xdebug.log_level=10" >> $PHP_INI_DIR/conf.d/xdebug.ini

WORKDIR /var/www/html

EXPOSE 9030
