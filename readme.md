<h1>Requisitos</h1>

PHP 7.4
MySQL <br>
Docker <br>
Apache || servidor que rode o php


<h1>Instruções</h1>
Execute esse comando logo abaixo para executar o mysql no docker.<br>
<strong>docker run -it --name mysql -e MYSQL_ROOT_PASSWORD=mysql -p 3306:3306 -d mysql</strong><br>

O arquivo banco.txt conterá todos os comandos necessários para criar o banco e suas tabelas.<br>

<strong>Para rodar a aplicação com o apache, execute:</strong><br>

- php -S localhost:8080<br>

Obs: Esse comando é válido caso o apache e o php estejam instalados!<br>
Obs²: Caso o Sistema Operacional seja o linux, será necessário ter instalado mysqli<br>

<strong>Comando para instalar a dependência mysqli:</strong><br>
- sudo apt-get install -y php-mysqli

