# Pré-requis

## PHP 7.4

```shell
sudo apt update
sudo apt install php-cli php-dom
```

## Composer

```shell
cd /tmp
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
sudo mv composer.phar /usr/local/bin/composer
```

(source https://getcomposer.org/download/)

# Installation

```shell
composer install
```

# Lancer en mode dev

```shell
php -S localhost:8000 -t ./public/
```

# Ressources

- https://symfony.com/doc/current/index.html
- https://symfonycasts.com/tracks/symfony
- https://www.php.net/manual/fr/
- https://getcomposer.org/doc/
