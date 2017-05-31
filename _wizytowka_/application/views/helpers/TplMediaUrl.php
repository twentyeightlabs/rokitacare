<?php
/**
 * Class BusinessCard_View_Helper_TplMediaUrl
 */
class BusinessCard_View_Helper_TplMediaUrl extends Zend_View_Helper_Abstract
{
    public function __construct()
    {}

    public function tplMediaUrl($templateName, $mediaResource)
    {
        $front = $this->getFrontController();
        $view = $this->getView($front);
        $tplRepositoryDir = $this->getTemplatesRepositoryDir($front);
        return $view->getHelper('baseUrl')->baseUrl('/'.$tplRepositoryDir.'/scripts/'.$templateName.$mediaResource);
    }

    private function getFrontController()
    {
        require_once 'Zend/Controller/Front.php';
        return  Zend_Controller_Front::getInstance();
    }

    private function getView(Zend_Controller_Front $front)
    {
        return $front->getParam('bootstrap')->getResource('view');
    }

    private function getTemplatesRepositoryDir(Zend_Controller_Front $front)
    {
        $options = $front->getParam('bootstrap')->getOptions();
        if(isset($options['template']['templatesRepositoryDirName']))
            return $options['template']['templatesRepositoryDirName'];
    }
} 