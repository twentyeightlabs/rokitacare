<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected  function _initFrontResource()
    {
        $this->bootstrap('frontcontroller');
    }

    protected function _initAutoloaderModuleLibrary()
    {
        $loader = new Zend_Application_Module_Autoloader(array(
            'namespace' => '',
            'basePath'  => APPLICATION_PATH,
        ));
        $loader->addResourceType('BusinessCard', 'library/BusinessCard', 'BusinessCard');

        $loader->addResourceType('dao', 'dao', 'Application_Dao_');
        $loader->addResourceType('datasource', 'datasource', 'Application_Datasource_');
    }

    protected function _initAutoloaderModuleApi()
    {
        $loader = new Zend_Application_Module_Autoloader(array(
            'namespace' => '',
            'basePath'  => APPLICATION_PATH . '/modules/api',
        ));
        $loader->addResourceType('apiloader', 'library/Api', 'Api');
        $loader->addResourceType('apiloaderforms', 'forms', 'Api_Form');
        $loader->addResourceType('apilloaderservice', 'services', 'Api_Service');
        $loader->addResourceType('apilloaderfactory', 'factories', 'Api_Factory');
    }

    protected function _initViewResource()
    {
        $this->bootstrap('view');
        $this->getResource('view')->addHelperPath(APPLICATION_PATH.'/views/helpers/', 'BusinessCard_View_Helper');
    }

    protected function _initRouterResource()
    {
        $router = $this->getResource('frontcontroller')->getRouter();
        /**
         * Hack for tests
         * @link http://framework.zend.com/issues/browse/ZF-11619
         */
        $router->addDefaultRoutes();
    }

    protected function _initRestRouteResource()
    {
        $front = $this->getResource('frontcontroller');
        $restRoute = new Zend_Rest_Route($front, array(), array(
            'api' => array('businesscard', 'businesscardform')
        ));
        $front->getRouter()->addRoute('rest', $restRoute);
    }
}
