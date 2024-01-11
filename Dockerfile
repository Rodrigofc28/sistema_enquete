# Use a imagem oficial do PHP com Apache e PHP 8.1
#Run roda comandos
#from importa imagens
#copy copia a -> a

FROM php:8.1-apache

# Instale dependências necessárias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo_mysql zip

# Configurar Apache
RUN a2enmod rewrite

# Instale o Node.js
RUN apt-get install -y nodejs

# Instale o npm
RUN apt-get install -y npm

COPY php.ini /usr/local/etc/php/
# Copiar os arquivos do projeto Laravel
COPY . /var/www/html

RUN chmod -R 755 /var/www/html

# Copiar o arquivo de configuração do Apache
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Ativar o VirtualHost
RUN a2ensite 000-default

# Defina o diretório de trabalho
WORKDIR /var/www/html

# Instalar as dependências do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-scripts --no-interaction --prefer-dist

# Definir as permissões corretas
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expor a porta 80
EXPOSE 80

# Comando padrão ao iniciar o contêiner
CMD ["apache2-foreground"]

