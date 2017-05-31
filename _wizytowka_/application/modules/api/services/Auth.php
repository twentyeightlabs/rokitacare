<?php

/**
 * Class Api_Service_Auth
 */
class Api_Service_Auth
{
    private $request, $response;
    private $authAdapter;

    function __construct(Zend_Controller_Request_Http $request, Zend_Controller_Response_Http $response, Zend_Auth_Adapter_Http $authAdapter)
    {
        $this->request = $request;
        $this->response = $response;
        $this->authAdapter = $authAdapter;
    }

    /**
     * @return mixed
     */
    private function getResponse()
    {
        return $this->response;
    }

    /**
     * @return mixed
     */
    private function getRequest()
    {
        return $this->request;
    }

    public function auth()
    {
        $this->authAdapter->setRequest($this->getRequest());
        $this->authAdapter->setResponse($this->getResponse());
        $result = $this->authAdapter->authenticate();

        if(!$result->isValid()){
            throw new Api_Service_Exception_Auth();
        }
    }
}