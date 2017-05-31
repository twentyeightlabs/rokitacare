<?php
/**
 * @author Łukasz Masłowski <lukasz.maslowski@netart.pl>
 * Class Api_Controller_Plugin_Logger
 */
class Api_Controller_Plugin_Logger extends  Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        if ('api' != $request->getModuleName()) {
            return;
        }
        $this->logHttpRequest($request);
    }

    public function postDispatch(Zend_Controller_Request_Abstract $request)
    {
        if ('api' != $request->getModuleName()) {
              return;
        }
        $this->logHttpResponse($this->getResponse());
    }

    private function log($message, $extras = null)
    {
        $log = Zend_Registry::get('log');
        $log->log($message, Zend_Log :: INFO, $extras);
    }

    private function logHttpRequest(Zend_Controller_Request_Http $request){

        //log request
        $this->log('request:');
        $this->log('    ' . $request->getMethod() . ' ' . $request->getRequestUri() . '  ' . $request->SERVER_PROTOCOL);

        foreach(apache_request_headers() as $k=>$v){
            $this->log('    '.$k . ' ' .$v);
        }

        $this->log('    body: '. $request->getRawBody());
    }

    private function logHttpResponse(Zend_Controller_Response_Http $response)
    {
        //log response
        $this->log('response:');
        $this->log('    httpResponseCode: '.$response->getHttpResponseCode());
        foreach(apache_response_headers() as $k=>$v){
            $this->log('    '. $k . ':' .  $v);
        }

        foreach($response->getHeaders() as $header){
            $this->log('    ' . $header['name']. ': '.$header['value']);
        }

        $this->log('    bodyResponse : ');
        $this->log('      ' . $this->getResponse()->getBody());
        //log response
    }
}