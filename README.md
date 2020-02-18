<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>
# product-monitoring

## Description
This is simple project using laravel to crawling and scrapping website to monitoring product price.

### How To Run This Project

> Make sure you already install mysql in your machine.

> Make sure you already install php in your machine (make sure your php minimum version is 7.0),
for easy to use i recommend you to install xampp through this link https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/7.0.27/ 

> Make sure you already install composer in your machine,
  if you don't have composer in your machine you can install through this link https://getcomposer.org/download/

##### Check php already installed on your machine
```bash
$ php -v
PHP 7.0.18 (cli) (built: Apr 11 2017 16:35:18) ( ZTS )
Copyright (c) 1997-2017 The PHP Group
Zend Engine v3.0.0, Copyright (c) 1998-2017 Zend Technologies
```

##### Check composer already installed on your machine
```bash
$ composer --version
Composer version 1.8.4 2019-02-11 10:52:10
```

Since the project using xampp, I recommend to put the source code inside htdocs folder.
Clone this repository into your htdocs folder

##### clone project inside htdocs folder
```bash
$ cd /your-xampp-path/htdocs
$ git clone https://github.com/oryzel/product-monitoring.git
```

>you must copy env.example to .env (for development or production) and .env.testing (for running unit test) for database value appropriate to your database on machine

##### after that you must run composer to install all dependency
```bash
$  cd /your-xampp-path/htdocs/product-monitoring
$  composer install
```

##### to install create table and default value in database you can run this script
```bash
$  cd /your-xampp-path/htdocs/product-monitoring
$  php artisan migrate:refresh --seed
```

##### When using the scheduler for scrapping price, you only need to add the following Cron entry to your machine
```bash
$  * * * * * cd /your-xampp-path/htdocs/product-monitoring && php artisan schedule:run >> /dev/null 2>&1
```

### How To run unit test
##### Make sure you already all the process before then run this script.
```bash
$  cd /your-xampp-path/htdocs/product-monitoring
$  ./vendor/bin/phpunit
```