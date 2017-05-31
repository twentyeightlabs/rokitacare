<?php

/**
 * Support php 5.2
 */
if(function_exists('lcfirst') === false) {
    function lcfirst($str) {
        if(empty($str)) return '';
        $str[0] = strtolower($str[0]);
        return $str;
    }
}

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));


/**
 * apc clear cache
 */
if(APPLICATION_ENV == 'development' && function_exists('apc_clear_cache')){
    apc_clear_cache();
}

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
)));


// Zend Framework 1.12.10
require 'phar://' . APPLICATION_PATH . '/../library/zend-1.12.10.phar';

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()
            ->run();
