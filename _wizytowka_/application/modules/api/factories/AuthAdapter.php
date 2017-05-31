<?php

/**
 * Class Api_Factory_AuthAdapter
 */
class Api_Factory_AuthAdapter
{
    public static function create($filePasswd, $config)
    {
        self :: throwExceptionIfFileIsEmptyString($filePasswd);
        self :: throwExceptionIfFileNotExists($filePasswd);

        $adapter = new Zend_Auth_Adapter_Http($config);
        $basicResolver = new Zend_Auth_Adapter_Http_Resolver_File();
        $basicResolver->setFile($filePasswd);
        $adapter->setBasicResolver($basicResolver);
        return $adapter;
    }

    private static function throwExceptionIfFileNotExists($file)
    {
        if(!file_exists($file)){
            throw new ErrorException('File: ' . $file . ' do not exists');
        }
    }

    private static function throwExceptionIfFileIsEmptyString($file)
    {
        if(empty($file)){
            throw new ErrorException('File name is empty');
        }
    }
}