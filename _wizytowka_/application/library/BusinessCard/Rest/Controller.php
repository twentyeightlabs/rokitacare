<?php
/**
 * Class BusinessCard_Rest_Controller
 */
abstract class BusinessCard_Rest_Controller extends BusinessCard_Controller_Action
{
    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
    }

    protected function auth()
    {
        Api_Factory_AuthService :: create($this->getRequest(), $this->getResponse(),$this->getBusinessCardOption('authFile'))->auth();
    }

    /**
     * The index action handles index/list requests; it should respond with a
     * list of the requested resources.
     */
    abstract public function indexAction();

    /**
     * The get action handles GET requests and receives an 'id' parameter; it
     * should respond with the server resource state of the resource identified
     * by the 'id' value.
     */
    abstract public function getAction();

    /**
     * The head action handles HEAD requests and receives an 'id' parameter; it
     * should respond with the server resource state of the resource identified
     * by the 'id' value.
     */
    abstract public function headAction();

    /**
     * The post action handles POST requests; it should accept and digest a
     * POSTed resource representation and persist the resource state.
     */
    abstract public function postAction();

    /**
     * The put action handles PUT requests and receives an 'id' parameter; it
     * should update the server resource state of the resource identified by
     * the 'id' value.
     */
    abstract public function putAction();

    /**
     * The delete action handles DELETE requests and receives an 'id'
     * parameter; it should update the server resource state of the resource
     * identified by the 'id' value.
     */
    abstract public function deleteAction();
}