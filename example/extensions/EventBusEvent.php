<?php

/**
 * Created by PhpStorm.
 * User: it050193pav
 * Date: 17.07.18
 * Time: 11:30
 */
namespace example\extensions;

/**
 * Class EventBusEvent - событие шины событий
 * @package example\extensions
 */
class EventBusEvent implements \Serializable
{
    /** @var string - тип событий */
    private $_type;

    /** @var array  - данные */
    private $_data;

    /**
     * EventBusEvent constructor.
     *
     * @param $type
     * @param array $data
     */
    public function __construct($type, array $data = [])
    {
        $this->_type = $type;
        $this->_data = $data;
    }

    /**
     * @inheritdoc
     */
    public function serialize()
    {
        return serialize([$this->_type, $this->_data]);
    }

    /**
     * @inheritdoc
     */
    public function unserialize($serialized)
    {
        list($this->_type, $this->_data) = unserialize($serialized);
    }

    /**
     * Получение данных события
     *
     * @return array
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * Получение типа события
     *
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }
}