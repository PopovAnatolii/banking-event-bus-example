<?php
/**
 * Created by PhpStorm.
 * User: it050193pav
 * Date: 17.07.18
 * Time: 13:10
 */
require '../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

use example\extensions\EventBus;
use example\extensions\EventBusEvent;
use example\extensions\ProcessingEventsDictionary;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');

$eventBus = new EventBus($connection);

$eventBusEvent = new EventBusEvent(ProcessingEventsDictionary::EVENT_PAYMENT_SUCCESS, [
    'amount' => 100,
    'currency' => 'UAH'
]);

$eventBus->dispatchEvent($eventBusEvent);

echo 'Событие отправлено в шину!';