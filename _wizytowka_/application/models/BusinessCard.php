<?php

/**
 * Class Application_Model_BusinessCard
 */
class Application_Model_BusinessCard
{
    private $properties = array();

    public function __construct($properties = null)
    {
        $properties != null && $this->loadProperties($properties);
    }

    public function loadProperties($data)
    {
        $this->properties = $data;
    }

    public function setProperty($propertyName, $propertyValue)
    {
        $this->properties[$propertyName] = $propertyValue;
    }

    /**
     * @param $propertyName
     * @param null $propertyValueIfOrderNotExist
     * @return null
     * @throws Exception
     */
    public function getProperty($propertyName, $propertyValueIfOrderNotExist = null)
    {
        if (!isset($this->properties[$propertyName]) && $propertyValueIfOrderNotExist == null) {
            throw new Exception($propertyName . ' do not exists');
        }

        if (!isset($this->properties[$propertyName]) && $propertyValueIfOrderNotExist != null) {
            return $propertyValueIfOrderNotExist;
        }
        return $this->properties[$propertyName];
    }

    public function getProperties()
    {
        return $this->properties;
    }

    public function toJson()
    {
        return Zend_Json:: encode($this->properties);
    }

    public function __call($name, $arguments)
    {
        $modulator = substr($name, 0, 3);
        $propertyName = substr($name,3, strlen($name));
        $propertyName = lcfirst($propertyName);

        if(in_array(substr($name, 0, 3), array('get', 'set', 'has'))) {
            if($modulator == 'set' && count($arguments) == 1){
                $this->setProperty($propertyName, $arguments[0]);
                return;
            }elseif($modulator == 'get' && count($arguments) == 0){
                return $this->getProperty($propertyName);
            }elseif($modulator == 'has' && count($arguments) == 0){
                return isset($this->properties[$propertyName]);
            }
        }
        throw new Exception('Not supported method: ' . $name);
    }
}
