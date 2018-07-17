<?php
/**
 * Created by PhpStorm.
 * User: it050193pav
 * Date: 17.07.18
 * Time: 13:23
 */
require '../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

use example\notifications\ProcessingSubscriber;
use example\extensions\EventBus;
use example\extensions\ProcessingEventsDictionary;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');

$eventBus = new EventBus($connection);

$eventBus->subscribe(new ProcessingSubscriber(), ProcessingEventsDictionary::EVENT_PAYMENT_SUCCESS);