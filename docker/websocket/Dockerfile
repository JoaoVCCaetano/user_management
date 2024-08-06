# Dockerfile para o WebSocket Server

FROM php:8.0-cli

# Instala as dependências do sistema
RUN apt-get update && apt-get install -y \
    libzip-dev \
    && docker-php-ext-install pdo_mysql


# Copia os arquivos do projeto para o container
WORKDIR /var/www/html

# Exponha a porta do WebSocket
EXPOSE 9090

# Comando para iniciar o servidor WebSocket
CMD ["php", "/var/www/html/initWebSocketServer.php"]