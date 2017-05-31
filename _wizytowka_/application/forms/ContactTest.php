<?php
class Application_Form_ContactTest extends Application_Form_Contact
{
    public function init()
    {
        parent::init();
        $this->removeElement('captcha');
        $this->removeElement('csrf');
    }
}