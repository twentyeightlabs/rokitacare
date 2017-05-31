<?php
/**
 * Class BusinessCard_View_Helper_GlobalGoogleMapsApiKey
 */
class BusinessCard_View_Helper_GlobalGoogleMapsApiKey extends Zend_View_Helper_Abstract
{
    CONST GLOBAL_GOOGLE_MAPS_API_KEY = "AIzaSyARR7am-AX3dM4XcudeqeVMSywTjOcXNsE";

    public function globalGoogleMapsApiKey()
    {
        return self :: GLOBAL_GOOGLE_MAPS_API_KEY;
    }
}