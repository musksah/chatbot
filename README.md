<!--
*** Thanks for checking out the Best-README-Template. If you have a suggestion
*** that would make this better, please fork the repo and create a pull request
*** or simply open an issue with the tag "enhancement".
*** Thanks again! Now go create something AMAZING! :D
-->



<!-- PROJECT SHIELDS -->
<!--
*** I'm using markdown "reference style" links for readability.
*** Reference links are enclosed in brackets [ ] instead of parentheses ( ).
*** See the bottom of this document for the declaration of the reference variables
*** for contributors-url, forks-url, etc. This is an optional, concise syntax you may use.
*** https://www.markdownguide.org/basic-syntax/#reference-style-links
-->

<!-- PROJECT LOGO -->
<br />
<p align="center">
  <h3 align="center">Bank Transacion ChatBot</h3>

  <p align="center">
    A chatbot who can help in your bank transactions. He will work as a useful assistant!
    <br />
    <br />
  </p>
</p>



<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project

This project was created for a coding challenge and It would become an interesting project to implement chatbots in e-commerce, service providers, etc. Right here you can check the application deployed: [Demo live](http://www.sebastian-hr.com)

### Built With

* [Botman](https://botman.io)
* [Laravel](https://laravel.com)


<!-- GETTING STARTED -->
## Getting Started

### Prerequisites

You will need some installations to run the project, the following commands work in the Ubuntu system.

* php 7.4
  ```sh
  sudo apt update
  sudo apt install software-properties-common
  export LANG=C.UTF-8
  sudo add-apt-repository ppa:ondrej/php
  sudo apt update
  sudo apt -y install php7.4
  sudo apt install php7.4-common php7.4-mysql php7.4-xml php7.4-xmlrpc php7.4-curl php7.4-gd php7.4-imagick php7.4-cli php7.4-dev php7.4-imap php7.4-mbstring    php7.4-opcache php7.4-soap php7.4-zip php7.4-intl -y
  ```
* composer
  ```sh
  sudo apt-get install curl
  sudo php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');"
  sudo php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer
  ``` 
* git
  ```sh
  sudo apt install git
  ```
* npm
  ```sh
  curl -sL https://deb.nodesource.com/setup_7.x | sudo -E bash -
  sudo apt-get install -y nodejs
  curl -sL https://deb.nodesource.com/setup_14.x | sudo -E bash -
  sudo apt-get install nodejs
  chown www-data: -R * && chown www-data: -R .*
  ```
 * apache
  ```sh
  sudo apt install apache2
  ```
 * mysql   
 ```sh
  sudo apt-get install wget
  wget https://repo.mysql.com//mysql-apt-config_0.8.12-1_all.deb
  sudo dpkg -i mysql-apt-config_0.8.12-1_all.deb
  sudo apt-get update
  sudo apt-get install mysql-server
  sudo systemctl start mysql
  ```
  
### Installation

1. Clone the repo
   ```sh
   git clone https://github.com/musksah/chatbot.git
   ```
2. Install composer packages
   ```sh
   composer install
   ```
3. Install NPM packages
   ```sh
   npm install
   ```
4. Create a database named "chatbot" in mysql
   ```JS
   cp .env.example .env
   ```
4. copy .env and configure database
   ```JS
   cp .env.example .env
   ```
5. generate key laravel
   ```JS
   php artisan key:generate
   ```
6. run migrations
   ```JS
   php artisan migrate
   ```
7. run seeder
   ```JS
   php artisan db:seed --class=TypeTransactionsSeeder
   ```
## Deployment

### local
* php local serve
  ```sh
  php artisan serve
  ```
### production
* apache configuration
  ```sh
  nano /etc/apache2/sites-available/000-default.conf
  
  <VirtualHost *:80>
    ServerName yourdomain.tld
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html/chatbot/public
    <Directory /var/www/html/chatbot>
        AllowOverride All
    </Directory>
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
  </VirtualHost>
  
  sudo a2ensite 000-default.conf
  sudo a2enmod rewrite
  service apache2 restart
<!-- USAGE EXAMPLES -->
## Usage

The bot can understand specific list of words. These are the words to test it:

** sign up **
To create an account
** log in **
To log in with you account
** deposite **
To deposite money in you saving account
** withdraw **
To withdraw money in you saving account
** account balance **
To kwnow your current account balance
** exchange currency **
To exchange currencies
** help **
The list of the functionalities of the bot

<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE` for more information.
