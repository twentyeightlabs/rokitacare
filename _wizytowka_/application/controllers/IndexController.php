<?php
class IndexController extends BusinessCard_Controller_Action
{
    private $mainService;

    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function preDispatch()
    {
        try {
            $forceHttps = filter_var($this->getBusinessCard()->getProperty('forceHttps'), FILTER_VALIDATE_BOOLEAN);
        } catch (Exception $e) {
            return;
        }

        $http = new Zend_Controller_Request_Http();

        if ($forceHttps && !$http->isSecure()) {
            $url = 'https://' . $http->getHttpHost() . $http->getRequestUri();

            $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
            $redirector->setCode(301);
            $redirector->gotoUrl($url);
        }
    }

    public function indexAction()
    {
        $this->getIndexControllerService()->assignEscapedBusinessCardDataToView($this->getView(), $this->getBusinessCard());
        $this->getIndexControllerService()->contactFormHandle($this->getRequest(), $this->getView(),  new Application_Form_Contact, new Application_Service_ContactMail(new Zend_Mail('utf-8')),$this->getBusinessCard(),  $this->_helper->getHelper('FlashMessenger'),  $this->_helper->getHelper('Redirector'));
        $this->getIndexControllerService()->renderBusinessCard($this->getBusinessCard(), $this->getView(), $this->getRequest(), $this->getResponse());
    }

    public function mapAction()
    {
        $this->getIndexControllerService()->assignEscapedBusinessCardDataToView($this->getView(), $this->getBusinessCard());
        $this->getIndexControllerService()->contactFormHandle($this->getRequest(), $this->getView(),  new Application_Form_Contact, new Application_Service_ContactMail(new Zend_Mail('utf-8')),$this->getBusinessCard(),  $this->_helper->getHelper('FlashMessenger'),  $this->_helper->getHelper('Redirector'));
        $this->getIndexControllerService()->renderBusinessCardMap($this->getBusinessCard(), $this->getView(), $this->getRequest(), $this->getResponse());
    }

    /**
     * @return Application_Model_BusinessCard
     */
    private function getBusinessCard()
    {
        return $this->getBusinessCardService()->get();
    }

    /**
     * @return Zend_View
     */
    private function getView()
    {
        if ($this->view == null) {
            $this->view = $this->initView();
        }
        return $this->view;
    }

    /**
     * @return Application_Service_Main
     */
    private function getIndexControllerService()
    {
        if ($this->mainService == null) {
            $this->mainService = new Application_Service_IndexController();
        }
        return $this->mainService;
    }
}