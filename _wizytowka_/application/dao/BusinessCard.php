<?php
interface Application_Dao_BusinessCard
{
    public function save(Application_Model_BusinessCard $businessCard);
    public function get();
}