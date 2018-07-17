<?php

/**
 * Created by PhpStorm.
 * User: it050193pav
 * Date: 17.07.18
 * Time: 12:31
 */
namespace example\extensions;

/**
 * Interface EventBusSubscriberInterface - интерфейс подписчика
 * @package example\extensions
 */
interface EventBusSubscriberInterface
{
    /**
     * Метод обработки события
     *
     * @param EventBusEvent $event
     */
    public function handleEvent(EventBusEvent $event);
}