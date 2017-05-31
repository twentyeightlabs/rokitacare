<?php

/**
 * Class Api_Factory_BusinessCardService
 */
class Api_Factory_BusinessCardService
{
    public static function create($file)
    {
        return new Application_Service_BusinessCard(new Application_Dao_JsonBusinessCard(new Application_Datasource_File($file)));
    }
}