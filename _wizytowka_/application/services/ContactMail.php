<?php

/**
 * Class Application_Service_ContactMail
 */
class Application_Service_ContactMail
{
    private $mail;

    public function __construct(Zend_Mail $mail)
    {
        $this->mail = $mail;
    }

    public function sendContactEmail(Application_Model_ContactMail $contactMail)
    {
        $mail = $this->mail;
        $mail->setBodyText($contactMail->getBodyText());
        $mail->setFrom($contactMail->getFromAddress(), $contactMail->getFromName());
        $mail->setSubject($contactMail->getSubject());
        $mail->addTo($contactMail->getToAddress(),$contactMail->getToName());
        return $mail->send();
    }
}