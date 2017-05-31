<?php

/**
 * Class Application_Service_IndexController
 */
class Application_Service_IndexController
{
    public function contactFormHandle(Zend_Controller_Request_Abstract $request, Zend_View_Interface $view, Application_Form_Contact $contactForm,  Application_Service_ContactMail $contactMailService, Application_Model_BusinessCard $businessCard , Zend_Controller_Action_Helper_FlashMessenger $flashMessenger, Zend_Controller_Action_Helper_Redirector $redirector)
    {
        $view->contactForm = $contactForm;

        $view->showContactForm = false;
        $view->showSuccessConfirmation = false;
        $view->contactFormErrors = false;

        if ($flashMessenger->hasMessages('sendEmailSuccess')) {
            $messages = $flashMessenger->getMessages('sendEmailSuccess');
            $flashMessenger->clearMessages('sendEmailSuccess');

            $message = current($messages);
            $view->showSuccessConfirmation = $message['showSuccessConfirmation'];
            $view->showContactForm = $message['showContactForm'];

            return;
        }

        if (!$request->isPost()) {
            $view->showContactForm = true;
            $view->contactFormErrors = false;
            return;
        }

        if ($contactForm->isValid($request->getParams())) {
            $contactMailModel = new Application_Model_ContactMail();
            $contactMailModel->setMessage($request->getParam('message'), $request->getParam('phone'));
            $contactMailModel->setFromAddress($request->getParam('email'));
            $contactMailModel->setSubject($request->getParam('subject'));
            $contactMailModel->setToAddress($businessCard->getProperty('clientEmail'));

            try{
                $contactMailService->sendContactEmail($contactMailModel);
            }catch(Exception $e){
                $view->showContactForm = true;
                $view->contactFormErrors = true;
                return;
            }
            $flashMessenger->addMessage(array(
                'showSuccessConfirmation' => true,
                'showContactForm' => false
            ), 'sendEmailSuccess');

            //nadmiarowe bo i tak robimy redirect przydatne dla testow
            $view->showSuccessConfirmation = true;
            $view->showContactForm = false;

            $redirector->gotoUrl('/index/index');
  
        } else {
            $view->showContactForm = true;
            $view->contactFormErrors = true;
            return;
        }
    }

    public function assignEscapedBusinessCardDataToView(Zend_View $view, Application_Model_BusinessCard $businessCard)
    {
        foreach($businessCard->getProperties() as $varName=>$varValue){
            $templateAttr = $varValue;
            if(is_string($varValue)){
                $templateAttr = $view->escape($varValue);
            }
            $view->assign($varName, $templateAttr);
        }
    }

    public function renderBusinessCard(Application_Model_BusinessCard $businessCard,  Zend_View $view, Zend_Controller_Request_Http $request, Zend_Controller_Response_Http $response)
    {
        $template = trim($request->getParam('template', $businessCard->getTemplateName()));
        $response->appendBody($view->render('/'.$template.'/index.phtml'));
    }

    public function renderBusinessCardMap(Application_Model_BusinessCard $businessCard,  Zend_View $view, Zend_Controller_Request_Http $request, Zend_Controller_Response_Http $response)
    {
        $template = trim($request->getParam('template', $businessCard->getTemplateName()));
        $response->appendBody($view->render('/'.$template.'/map.phtml'));
    }

}