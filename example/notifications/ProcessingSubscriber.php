<?php

/**
 * Created by PhpStorm.
 * User: it050193pav
 * Date: 17.07.18
 * Time: 13:24
 */
namespace example\notifications;

use example\extensions\EventBusSubscriberInterface;
use example\extensions\EventBusEvent;

/**
 * Class ProcessingSubscriber -
 * @package example\notifications
 */
class ProcessingSubscriber implements EventBusSubscriberInterface
{
    /**
     * @inheritdoc
     */
    public function handleEvent(EventBusEvent $event)
    {
        $eventData = $event->getData();

        echo "Платеж на сумму {$eventData['amount']} {$eventData['currency']} проведен!";
    }
}