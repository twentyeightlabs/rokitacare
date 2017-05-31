<?php

/**
 * Class Api_Factory_AuthService
 */
class Api_Factory_AuthService
{
    public static function create(Zend_Controller_Request_Http $request, Zend_Controller_Response_Http $response, $filePasswd)
    {
        $authAdapter =  Api_Factory_AuthAdapter::create($filePasswd, array(
            'accept_schemes' => 'basic',
            'realm' => 'businessCardApi',
            'nonce_timeout' => 3600
        ));
        return new Api_Service_Auth($request, $response, $authAdapter);
    }
}