<?php

/**
 * Class BusinessCard_Controller_Action
 */
abstract class BusinessCard_Controller_Action extends Zend_Controller_Action
{
    /**
     * @var Application_Service_BusinessCard
     */
    protected $businessCardService;

    /**
     * @var Api_Service_BusinesscardForm
     */
    protected  $businessCardFormService;

    /**
     * @return Bootstrap
     */
    protected  function getBootstrap()
    {
        return $this->getInvokeArg('bootstrap');
    }

    protected function getBootstrapOption($name)
    {
        if(!$this->getBootstrap()->hasOption($name)){
            throw new ErrorException("Option $name do not exists");
        }
        return $this->getBootstrap()->getOption($name);
    }

    protected function getBusinessCardOption($name)
    {
        $businessCardOptions =  $this->getBootstrapOption('businesscard');
        if(!isset($businessCardOptions[$name])){
            throw new ErrorException("Option $name do not exists");
        }
        return $businessCardOptions[$name];
    }

    /**
     * @return Application_Service_BusinessCard
     */
    protected function getBusinessCardService()
    {
        if(is_null($this->businessCardService)){
            $this->businessCardService = Api_Factory_BusinessCardService :: create($this->getBusinessCardOption('dataFile'));
        }
        return $this->businessCardService;
    }

    /**
     * @return Api_Service_BusinesscardForm
     */
    protected function getBusinessCardFormService()
    {
        if(is_null($this->businessCardFormService)){
            $this->businessCardFormService = new Api_Service_BusinesscardForm();
        }
        return $this->businessCardFormService;
    }

    protected function log($message, $extras = null)
    {
        $log = Zend_Registry::get('log');
        $log->log($message, Zend_Log :: INFO, $extras);
    }

}