<?php

/**
 * Class Application_Dao_BusinessCard
 */
class Application_Dao_JsonBusinessCard implements Application_Dao_BusinessCard
{
    private $dataSource;

    public function __construct(Application_Datasource_File $businessCardDataSource)
    {
        $this->dataSource = $businessCardDataSource;
    }

    public function save(Application_Model_BusinessCard $businessCard)
    {
        $this->dataSource->save($businessCard->toJson());
    }

    public function get()
    {
        $businessCardData = Zend_Json::decode($this->dataSource->get());
        return  new Application_Model_BusinessCard($businessCardData);
    }
}