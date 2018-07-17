<?php

/**
 * Created by PhpStorm.
 * User: it050193pav
 * Date: 17.07.18
 * Time: 11:24
 */

namespace example\extensions;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class EventBus - шина событий
 * @package example\extensions
 */
class EventBus
{
    /** @var AMQPStreamConnection */
    private $_connection;

    /** @var \AMQPChannel */
    private $_chanel;

    /**
     * EventBus constructor.
     * @param AMQPStreamConnection $connection
     */
    public function __construct(AMQPStreamConnection $connection)
    {
        $this->_connection = $connection;
        $this->_chanel = $connection->channel();
    }

    /**
     * EventBus destructor.
     */
    public function __destruct()
    {
        $this->_chanel->close();
        $this->_connection->close();
    }

    /**
     * Отправка события в шину
     *
     * @param EventBusEvent $event
     */
    public function dispatchEvent(EventBusEvent $event)
    {
        $this->_chanel->exchange_declare($event->getType(), 'fanout', false, false, false);

        $message = new AMQPMessage(serialize($event));

        $this->_chanel->basic_publish($message, $event->getType());
    }

    /**
     * Подписка на события в шине
     *
     * @param EventBusSubscriberInterface $eventBusSubscriber
     * @param string $eventType
     */
    public function subscribe(EventBusSubscriberInterface $eventBusSubscriber, $eventType)
    {
        $this->_chanel->exchange_declare($eventType, 'fanout', false, false, false);

        list($queueName, ,) = $this->_chanel->queue_declare('', false, false, true, false);

        $this->_chanel->queue_bind($queueName, $eventType);

        $callback = function ($msg) use ($eventBusSubscriber) {
            $eventBusEvent = (unserialize($msg->body));
            $eventBusSubscriber->handleEvent($eventBusEvent);
        };

        $this->_chanel->basic_consume(
            $queueName,
            '',
            false,
            true,
            false,
            false,
            $callback
        );

        while (count($this->_chanel->callbacks)) {
            $this->_chanel->wait();
        }
    }
}