Sobre o sistema de Enquete

Sistema consiste em criar enquetes e gerenciar tanto para editar e deletar, podendo vê o número de votação verificar as que estão em andamento e finalizadas.

Copyright © Rodrigo de Freitas Camargo
Requisitos
    docker compose instalado na maquina

    git

Como Usar

Tenha instalados todos os requisitos.

Clone o repositório.

No repositório clonado do projeto, faça uma cópia do arquivo .env.exemple com o nome .env

Modifique a database, username e password do banco de dados no arquivo .env
    DB_HOST= use host do banco que esta no arquivo docker-compose.yml 
    DB_DATABASE= use a database que esta no arquivo docker-compose.yml 
    DB_USERNAME=root
    DB_PASSWORD=abc123
Apoś subir o sistema com o docker e estar na pasta do repositório rode os seguintes comando:

    composer update
    php artisan key:generate
    php artisan migrate 
    php artisan websockets:serve
    npm run build

Acesse localhost:8080
