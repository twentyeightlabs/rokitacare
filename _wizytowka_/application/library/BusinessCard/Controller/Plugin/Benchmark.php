<?php
/**
 * Class BusinessCard_Controller_Plugin_Benchmark
 */
class BusinessCard_Controller_Plugin_Benchmark extends Zend_Controller_Plugin_Abstract
{
    private static $starttime;

    public function routeStartup(Zend_Controller_Request_Abstract $request)
    {
        self::$starttime = microtime(true);
        $this->logWhatIsGoingOn($request, __FUNCTION__);
    }

    public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {
        $this->logWhatIsGoingOn($request, __FUNCTION__);
    }

    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {
        $this->logWhatIsGoingOn($request, __FUNCTION__);
    }

    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $this->logWhatIsGoingOn($request, __FUNCTION__);
    }

    public function postDispatch(Zend_Controller_Request_Abstract $request)
    {
        $this->logWhatIsGoingOn($request, __FUNCTION__);
    }

    public function dispatchLoopShutdown()
    {
        $this->log(__FUNCTION__ .' : action time: ' . round(microtime(true) - self::$starttime, 6) . 's');
    }

    private function logWhatIsGoingOn(Zend_Controller_Request_Abstract $request, $whereAmIam)
    {
        $this->log($whereAmIam . ' : module/controller/action: ' . $request->getModuleName().'/'.$request->getControllerName() . '/' . $request->getActionName());
    }

    private function log($message, $extras = null)
    {
        $log = Zend_Registry::get('log');
        $log->log($message, Zend_Log :: INFO, $extras);
    }
}