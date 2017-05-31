<?php
/**
 * Class Application_Service_BusinessCard
 */
class Application_Service_BusinessCard
{
    private $businessCardDao;

    /**
     * @param Application_Dao_BusinessCard $businessCardDao
     */
    public function __construct(Application_Dao_BusinessCard $businessCardDao)
    {
        $this->businessCardDao = $businessCardDao;
    }
    /**
     * @param Application_Model_BusinessCard $businessCard
     * @throws Exception
     */
    public function save(Application_Model_BusinessCard $businessCard)
    {
        $this->businessCardDao->save($businessCard);
    }

    /**
     * @return Application_Model_BusinessCard
     */
    public function get()
    {
        return $this->businessCardDao->get();
    }
}