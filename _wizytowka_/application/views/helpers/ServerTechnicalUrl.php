<?php
/**
 * Class BusinessCard_View_Helper_ServerTechnicalUrl
 */
class BusinessCard_View_Helper_ServerTechnicalUrl extends Zend_View_Helper_Abstract
{
    CONST TECHNICAL_URL_PATTERN = "//%s.nazwa.pl/_wizytowka_/public/";

    public function serverTechnicalUrl($resource)
    {
        return !$_ENV['USER'] ? false : sprintf(self :: TECHNICAL_URL_PATTERN, $_ENV['USER']).$resource;
    }
}