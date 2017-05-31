<?php
/**
 * Class BusinessCard_View_Helper_TplVarsDebug
 */
class BusinessCard_View_Helper_TplVarsDebug extends Zend_View_Helper_Abstract
{
    private $viewVarsToEscape = array(
        'contactForm',
        'showContactForm',
        'expireDate'
    );

    public function __construct()
    {}

    public function tplVarsDebug()
    {
        echo '<pre>';
        echo '<h2>Temaplate Vars:<br /></h2>';
        foreach($this->getView()->getVars() as $varName=>$varValue){
            if($this->canShow($varName) && $varName && $varValue)
                echo "$varName : <b>$varValue</b><br />";
        }
        echo '</pre>';
    }

    private function getView()
    {
        require_once 'Zend/Controller/Front.php';
        return Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('view');
    }

    private function canShow($varName)
    {
        if(!in_array($varName, $this->viewVarsToEscape)){
            return true;
        }
        return false;
    }
}