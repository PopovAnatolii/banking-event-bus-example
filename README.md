# Пример построения event bus для рапспределенной системы средствами rabbitMQ

## Requirements

### PHP 5.3+

You need `PHP 5.3` and `php-amqplib`. To get these
dependencies on Ubuntu type:

    sudo apt-get install git-core php5-cli


### Composer

Then [install Composer](https://getcomposer.org/download/) per instructions on their site.


### Client Library

Then you can install `php-amqplib` using [Composer](http://getcomposer.org).

To do that install Composer and add it to your path, then run the following command
inside this project folder:

    composer.phar install

## Code



    php example/notifications/notifications.php
    php example/processing/processing.php
