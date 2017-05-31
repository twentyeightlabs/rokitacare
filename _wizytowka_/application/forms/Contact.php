<?php
/**
 * Class Application_Form_Contact
 */
class Application_Form_Contact extends Zend_Form
{
    public function init()
    {
        //email
        $this->addElement('text', 'email', array(
            'label' => 'Adres e-mail',
            'placeholder' => 'Wpisz swój e-mail...',
            'class' => 'textInput',
            'required'=> true,
            'filters'=> array('StringTrim'),
            'validators' => array(
                array('NotEmpty', true),
                array('EmailAddress', true)
            )));

        $this->email
            ->clearDecorators()
            ->addDecorator('ViewHelper')
            ->addDecorator('Errors');

        //phone
        $phone = new Zend_Form_Element_Text('phone');
        $this->addElement($phone);

        $phone->setLabel('Telefon');
        $phone->setAttrib('placeholder', 'Wpisz swój nr telefonu...');
        $phone->setAttrib('class', 'textInput')
            ->clearDecorators()
            ->setRequired(true)
            ->addDecorator('ViewHelper')
            ->addDecorator('Errors')
            ->addValidator('NotEmpty', true)
            ->addValidator('Regex', true, array('pattern' => '/^([0-9] ?){9,}$/'));

        //subject
        $this->addElement('text', 'subject', array(
            'label' => 'Temat',
            'placeholder' => 'Podaj temat wiadomości...',
            'class' => 'textInput',
            'required'  => true,
            'filters'   => array('StringTrim'),
            'validators'=> array(
                array('NotEmpty', true)
            ),
        ));
        $this->subject->clearDecorators();
        $this->subject
            ->addDecorator('ViewHelper')
            ->addDecorator('Errors');

        //text massage
        $textarea = new Zend_Form_Element_Textarea('message');
        $textarea->setLabel('Treść wiadomości');
        $textarea->setAttrib('placeholder', 'Wpisz treść wiadomości...');
        $textarea->setAttrib('class', 'require')
            ->clearDecorators()
            ->setRequired(true)
            ->addDecorator('ViewHelper')
            ->addDecorator('Errors')
            ->addValidator('NotEmpty', true);
        $this->addElement($textarea);


        //captcha img
        $captchaImage = new Zend_Captcha_Image('captchaImg');
        $captchaImage->setFont(APPLICATION_PATH . '/../public/captcha/fonts/caviar_dreams/CaviarDreams.ttf');
        $captchaImage->setImgDir(APPLICATION_PATH . '/../public/captcha/images');
        $captchaImage->setImgUrl($this->getView()->baseUrl('captcha/images'));
        $captchaImage->setWordlen(5);
        $captchaImage->setWidth(100);
        $captchaImage->setHeight(54);
        $captchaImage->setLineNoiseLevel(0);
        $captchaImage->setDotNoiseLevel(0);

        // captcha Figlet
        $captchaFiglet = new Zend_Captcha_Figlet(array(
            'name' => 'captchaFiglet',
            'wordLen' => 4,
        ));

        $captcha = new Zend_Form_Element_Captcha('captcha', array(
            'captcha' => $captchaFiglet));
        $captcha->setLabel('Przepisz kod z obrazka widoczny poniżej:');
        $captcha->setAttrib('placeholder', 'Kod...');
        $captcha->setAttrib('class', 'require')
            ->clearDecorators()
            ->setRequired(true)
            ->addDecorator('Errors');
        $this->addElement($captcha);

        //csrf
        $csrf = new Zend_Form_Element_Hash('csrf');
        $csrf->clearDecorators();

        //submit
        $this->addElement('submit', 'send',array('label' => 'Wyślij', 'class'=> 'submit', 'value'=> ' SEND'));
        $this->send
            ->clearDecorators()
            ->addDecorator('ViewHelper');
    }
}