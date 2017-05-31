<?php
class Api_Form_DataEdition extends Zend_Form
{
    /**
     * @throws Zend_Form_Exception
     */
    public function init()
    {

//FORM
        $this
            ->setDecorators(array(
                'FormElements',
                array('HtmlTag', array('tag' => 'div', 'class' => 'row')),
                'Form'
            ));
//FIELDS

        //templateName
        $templateName = new Zend_Form_Element_Radio('templateName');
        $templateName->setLabel('Wybierz projekt')
            ->setAttrib('class', 'radio')
            ->setIsArray(true)
            ->setMultiOptions($this->getTemplateListWithImages())
            ->setSeparator('')
            ->setOptions(array('multiple' => false, 'isArray' => false, 'escape' => false))
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper12($templateName))
            ->setRequired(true)
            ->addValidator('NotEmpty', true);

        //businessCardTitle
        $businessCardTitle = new Zend_Form_Element_Text('businessCardTitle');
        $businessCardTitle->setLabel('Firma (lub osoba)')
            ->setAttrib('class', 'text')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper12($businessCardTitle))
            ->setRequired(true)
            ->addValidator('NotEmpty', true)
            ->addValidator('StringLength', false, array('max' => 1024));

        //basicInfoTitle
        $basicInfoTitle = new Zend_Form_Element_Text('basicInfoTitle');
        $basicInfoTitle->setDescription('<h4 class="form-field">Opis</h4>')
            ->clearDecorators()
            ->addDecorators($this->CustomTag($basicInfoTitle, 'div', 'large-12 columns'))
            ->helper = 'formNote';

        //basicInfoEnable
        $basicInfoEnable = new Zend_Form_Element_Checkbox('basicInfoEnable');
        $basicInfoEnable->setLabel('Informacje podstawowe')
            ->setAttrib('class', 'checkbox disabled')
            ->setAttrib('checked', 'checked')
            ->setAttrib('data-onchange', 'toggleFields')
            ->setAttrib('onclick', 'event.preventDefault();')
            ->addValidator(new Zend_Validate_InArray(array(1)), false)
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper12($basicInfoEnable));

        //basicInfoSectionTitle
        $basicInfoSectionTitle = new Zend_Form_Element_Text('basicInfoSectionTitle');
        $basicInfoSectionTitle->setLabel('Nagłówek sekcji')
            ->setAttrib('class', 'text')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper12($basicInfoSectionTitle))
            ->setRequired(true)
            ->addValidator('NotEmpty', true)
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //basicInfoDescription
        $basicInfoDescription = new Zend_Form_Element_Textarea('basicInfoDescription');
        $basicInfoDescription->setLabel('Opis firmy (lub osoby)')
            ->setAttrib('class', 'text')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper12($basicInfoDescription))
            ->setRequired(true)
            ->addValidator('NotEmpty', true)
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 4096));

        //detailsDataTextTitle
        $detailsDataTextTitle = new Zend_Form_Element_Text('detailsDataTextTitle');
        $detailsDataTextTitle->setDescription('<h4 class="form-field">Dane teleadresowe</h4>')
            ->clearDecorators()
            ->addDecorators($this->CustomTag($detailsDataTextTitle, 'div', 'large-12 columns'))
            ->helper = 'formNote';

        //detailsDataEnable
        $detailsDataEnable = new Zend_Form_Element_Checkbox('detailsDataEnable');
        $detailsDataEnable->setLabel("Dane teleadresowe")
            ->setAttrib('class', 'checkbox disabled')
            ->setAttrib('checked', 'checked')
            ->setAttrib('onclick', 'event.preventDefault();')
            ->addValidator(new Zend_Validate_InArray(array(1)), false)
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper12($detailsDataEnable));

        //detailsDataAddressEnable
        $detailsDataAddressEnable = new Zend_Form_Element_Checkbox('detailsDataAddressEnable');
        $detailsDataAddressEnable->setLabel("Widoczne")
            ->setAttrib('class', 'checkbox')
            ->setAttrib('data-onchange', 'toggleFields')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper12($detailsDataAddressEnable));

        //detailsDataAddressStreet
        $detailsDataAddressStreet = new Zend_Form_Element_Text('detailsDataAddressStreet');
        $detailsDataAddressStreet->setLabel("Ulica")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'detailsDataAddressEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper6($detailsDataAddressStreet))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //detailsDataAddressLocalNumber
        $detailsDataAddressLocalNumber = new Zend_Form_Element_Text('detailsDataAddressLocalNumber');
        $detailsDataAddressLocalNumber->setLabel("nr domu")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'detailsDataAddressEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper6($detailsDataAddressLocalNumber))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //detailsDataAddressZipCode
        $detailsDataAddressZipCode = new Zend_Form_Element_Text('detailsDataAddressZipCode');
        $detailsDataAddressZipCode->setLabel("Kod pocztowy")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'detailsDataAddressEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper6($detailsDataAddressZipCode))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //detailsDataAddressCity
        $detailsDataAddressCity = new Zend_Form_Element_Text('detailsDataAddressCity');
        $detailsDataAddressCity->setLabel("Poczta")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'detailsDataAddressEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper6($detailsDataAddressCity))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //detailsDataPhoneEnable
        $detailsDataPhoneEnable = new Zend_Form_Element_Checkbox('detailsDataPhoneEnable');
        $detailsDataPhoneEnable->setLabel("Widoczne")
            ->setAttrib('class', 'checkbox')
            ->setAttrib('data-onchange', 'toggleFields')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper4($detailsDataPhoneEnable));

        //detailsDataPhoneValue
        $detailsDataPhoneValue = new Zend_Form_Element_Text('detailsDataPhoneValue');
        $detailsDataPhoneValue->setLabel("Telefon")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'detailsDataPhoneEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper8($detailsDataPhoneValue))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //detailsDataEmailEnable
        $detailsDataEmailEnable = new Zend_Form_Element_Checkbox('detailsDataEmailEnable');
        $detailsDataEmailEnable->setLabel("Widoczne")
            ->setAttrib('class', 'checkbox')
            ->setAttrib('data-onchange', 'toggleFields')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper4($detailsDataEmailEnable));

        //detailsDataEmailValue
        $detailsDataEmailValue = new Zend_Form_Element_Text('detailsDataEmailValue');
        $detailsDataEmailValue->setLabel("E-mail")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'detailsDataEmailEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper8($detailsDataEmailValue))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //detailsDataNipEnable
        $detailsDataNipEnable = new Zend_Form_Element_Checkbox('detailsDataNipEnable');
        $detailsDataNipEnable->setLabel("Widoczne")
            ->setAttrib('class', 'checkbox')
            ->setAttrib('data-onchange', 'toggleFields')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper4($detailsDataNipEnable));

        //detailsDataNipValue
        $detailsDataNipValue = new Zend_Form_Element_Text('detailsDataNipValue');
        $detailsDataNipValue->setLabel("NIP")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'detailsDataNipEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper8($detailsDataNipValue))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //detailsDataLinkEnable
        $detailsDataLinkEnable = new Zend_Form_Element_Checkbox('detailsDataLinkEnable');
        $detailsDataLinkEnable->setLabel("Widoczne")
            ->setAttrib('class', 'checkbox')
            ->setAttrib('data-onchange', 'toggleFields')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper4($detailsDataLinkEnable));

        //detailsDataLinkValue
        $detailsDataLinkValue = new Zend_Form_Element_Text('detailsDataLinkValue');
        $detailsDataLinkValue->setLabel("Adres www")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'detailsDataLinkEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper8($detailsDataLinkValue))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //detailsDataSectionTitle
        $detailsDataSectionTitle = new Zend_Form_Element_Text('detailsDataSectionTitle');
        $detailsDataSectionTitle->setLabel("Nagłówek sekcji")
            ->setAttrib('class', 'text')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper12($detailsDataSectionTitle))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //correspondenceDataTextTitle
        $correspondenceDataTextTitle = new Zend_Form_Element_Text('correspondenceDataTextTitle');
        $correspondenceDataTextTitle->setDescription('<h4 class="form-field">Dane do korespondencji</h4>')
            ->clearDecorators()
            ->addDecorators($this->CustomTag($correspondenceDataTextTitle, 'div', 'large-12 columns'))
            ->helper = 'formNote';

        //correspondenceDataEnable
        $correspondenceDataEnable = new Zend_Form_Element_Checkbox('correspondenceDataEnable');
        $correspondenceDataEnable->setLabel("Dane do korespondencji")
            ->setAttrib('class', 'checkbox disabled')
            ->setAttrib('checked', 'checked')
            ->setAttrib('onclick', 'event.preventDefault();')
            ->addValidator(new Zend_Validate_InArray(array(1)), false)
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper12($correspondenceDataEnable));

        //correspondenceDataAddressEnable
        $correspondenceDataAddressEnable = new Zend_Form_Element_Checkbox('correspondenceDataAddressEnable');
        $correspondenceDataAddressEnable->setLabel("Widoczne")
            ->setAttrib('class', 'checkbox')
            ->setAttrib('data-onchange', 'toggleFields')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper12($correspondenceDataAddressEnable));

        //correspondenceDataAddressStreet
        $correspondenceDataAddressStreet = new Zend_Form_Element_Text('correspondenceDataAddressStreet');
        $correspondenceDataAddressStreet->setLabel("Ulica")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'correspondenceDataAddressEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper6($correspondenceDataAddressStreet))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //correspondenceDataAddressLocalNumber
        $correspondenceDataAddressLocalNumber = new Zend_Form_Element_Text('correspondenceDataAddressLocalNumber');
        $correspondenceDataAddressLocalNumber->setLabel("nr domu")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'correspondenceDataAddressEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper6($correspondenceDataAddressLocalNumber))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //correspondenceDataAddressZipCode
        $correspondenceDataAddressZipCode = new Zend_Form_Element_Text('correspondenceDataAddressZipCode');
        $correspondenceDataAddressZipCode->setLabel("Kod pocztowy")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'correspondenceDataAddressEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper6($correspondenceDataAddressZipCode))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //correspondenceDataAddressCity
        $correspondenceDataAddressCity = new Zend_Form_Element_Text('correspondenceDataAddressCity');
        $correspondenceDataAddressCity->setLabel("Poczta")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'correspondenceDataAddressEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper6($correspondenceDataAddressCity))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //correspondenceDataPhoneEnable
        $correspondenceDataPhoneEnable = new Zend_Form_Element_Checkbox('correspondenceDataPhoneEnable');
        $correspondenceDataPhoneEnable->setLabel("Widoczne")
            ->setAttrib('class', 'checkbox')
            ->setAttrib('data-onchange', 'toggleFields')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper4($correspondenceDataPhoneEnable));

        //correspondenceDataPhoneValue
        $correspondenceDataPhoneValue = new Zend_Form_Element_Text('correspondenceDataPhoneValue');
        $correspondenceDataPhoneValue->setLabel("Telefon")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'correspondenceDataPhoneEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper8($correspondenceDataPhoneValue))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //correspondenceDataSectionTitle
        $correspondenceDataSectionTitle = new Zend_Form_Element_Text('correspondenceDataSectionTitle');
        $correspondenceDataSectionTitle->setLabel("Nagłówek sekcji")
            ->setAttrib('class', 'text')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper12($correspondenceDataSectionTitle))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //mapEnable
        $mapEnable = new Zend_Form_Element_Checkbox('mapEnable');
        $mapEnable->setLabel("Mapa Google <small>(lokalizacja)</small>")
            ->setAttrib('class', 'checkbox')
            ->setAttrib('data-onchange', 'toggleFields')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper12($mapEnable));

        //mapContainer
        $mapContainer = new Zend_Form_Element_Text('mapContainer');
        $mapContainer->setDescription('<div style="width: 100%; height: 100%;" id="mapContainer"></div><div id="localisationMapLegend"><span>Aby doprecyzować lokalizację możesz przeciągnąć marker w dowolną pozycję na mapie.</span><a href="#">Ustaw mapę na podstawie danych teleadresowych &raquo;</a></div>')
            ->clearDecorators()
            ->addDecorators($this->CustomTag($mapContainer, 'div', 'large-12 medium-12 columns'))
            ->helper = 'formNote';

        //mapLat
        $mapLat = new Zend_Form_Element_Text('mapLat');
        $mapLat->setLabel("LAT")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'mapEnable')
            ->setAttrib('readonly', 'true')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper6($mapLat));

        //mapLng
        $mapLng = new Zend_Form_Element_Text('mapLng');
        $mapLng->setLabel("LNG")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'mapEnable')
            ->setAttrib('readonly', 'true')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper6($mapLng));

        //mapApiKeyEnable
        $mapApiKeyEnable = new Zend_Form_Element_Checkbox('mapApiKeyEnable');
        $mapApiKeyEnable->setLabel("Aktywne")
            ->setAttrib('class', 'checkbox')
            ->setAttrib('data-onchange', 'toggleFields')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper4($mapApiKeyEnable));

        //mapApiKey
        $mapApiKey = new Zend_Form_Element_Text('mapApiKey');
        $mapApiKey->setLabel("Klucz Api Google Maps")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'mapApiKeyEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper8($mapApiKey))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //mapSectionTitle
        $mapSectionTitle = new Zend_Form_Element_Text('mapSectionTitle');
        $mapSectionTitle->setLabel("Nagłówek sekcji")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'mapEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper12($mapSectionTitle))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //formEnable
        $formEnable = new Zend_Form_Element_Checkbox('formEnable');
        $formEnable->setLabel("Formularz kontaktowy")
            ->setAttrib('class', 'checkbox')
            ->setAttrib('data-onchange', 'toggleFields')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper12($formEnable));

        //formSectionTitle
        $formSectionTitle = new Zend_Form_Element_Text('formSectionTitle');
        $formSectionTitle->setLabel("Nagłówek sekcji")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'formEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper12($formSectionTitle))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //clientEmail
        $clientEmail = new Zend_Form_Element_Text('clientEmail');
        $clientEmail->setLabel("E-mail do wysyłki formularza")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'formEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper12($clientEmail))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //socialMediaEnable
        $socialMediaEnable = new Zend_Form_Element_Checkbox('socialMediaEnable');
        $socialMediaEnable->setLabel("Social Media")
            ->setAttrib('class', 'checkbox')
            ->setAttrib('data-onchange', 'toggleFields')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper12($socialMediaEnable));

        //socialMediaFacebookEnable
        $socialMediaFacebookEnable = new Zend_Form_Element_Checkbox('socialMediaFacebookEnable');
        $socialMediaFacebookEnable->setLabel("Widoczne")
            ->setAttrib('class', 'checkbox')
            ->setAttrib('data-onchange', 'toggleFields')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper4($socialMediaFacebookEnable));

        //socialMediaFacebookUrl
        $socialMediaFacebookUrl = new Zend_Form_Element_Text('socialMediaFacebookUrl');
        $socialMediaFacebookUrl->setLabel("Facebook")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'socialMediaFacebookEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper8($socialMediaFacebookUrl))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //socialMediaInstagramEnable
        $socialMediaInstagramEnable = new Zend_Form_Element_Checkbox('socialMediaInstagramEnable');
        $socialMediaInstagramEnable->setLabel("Widoczne")
            ->setAttrib('class', 'checkbox')
            ->setAttrib('data-onchange', 'toggleFields')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper4($socialMediaInstagramEnable));

        //socialMediaInstagramUrl
        $socialMediaInstagramUrl = new Zend_Form_Element_Text('socialMediaInstagramUrl');
        $socialMediaInstagramUrl->setLabel("Instagram")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'socialMediaInstagramEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper8($socialMediaInstagramUrl))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //socialMediaGooglePlusEnable
        $socialMediaGooglePlusEnable = new Zend_Form_Element_Checkbox('socialMediaGooglePlusEnable');
        $socialMediaGooglePlusEnable->setLabel("Widoczne")
            ->setAttrib('class', 'checkbox')
            ->setAttrib('data-onchange', 'toggleFields')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper4($socialMediaGooglePlusEnable));

        //socialMediaGooglePlusUrl
        $socialMediaGooglePlusUrl = new Zend_Form_Element_Text('socialMediaGooglePlusUrl');
        $socialMediaGooglePlusUrl->setLabel("Google+")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'socialMediaGooglePlusEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper8($socialMediaGooglePlusUrl))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //socialMediaTwitterEnable
        $socialMediaTwitterEnable = new Zend_Form_Element_Checkbox('socialMediaTwitterEnable');
        $socialMediaTwitterEnable->setLabel("Widoczne")
            ->setAttrib('class', 'checkbox')
            ->setAttrib('data-onchange', 'toggleFields')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper4($socialMediaTwitterEnable));

        //socialMediaTwitterUrl
        $socialMediaTwitterUrl = new Zend_Form_Element_Text('socialMediaTwitterUrl');
        $socialMediaTwitterUrl->setLabel("Twitter")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'socialMediaTwitterEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper8($socialMediaTwitterUrl))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //socialMediaYouTubeEnable
        $socialMediaYouTubeEnable = new Zend_Form_Element_Checkbox('socialMediaYouTubeEnable');
        $socialMediaYouTubeEnable->setLabel("Widoczne")
            ->setAttrib('class', 'checkbox')
            ->setAttrib('data-onchange', 'toggleFields')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper4($socialMediaYouTubeEnable));

        //socialMediaYouTubeUrl
        $socialMediaYouTubeUrl = new Zend_Form_Element_Text('socialMediaYouTubeUrl');
        $socialMediaYouTubeUrl->setLabel("YouTube")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'socialMediaYouTubeEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper8($socialMediaYouTubeUrl))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //socialMediaLinkedInEnable
        $socialMediaLinkedInEnable = new Zend_Form_Element_Checkbox('socialMediaLinkedInEnable');
        $socialMediaLinkedInEnable->setLabel("Widoczne")
            ->setAttrib('class', 'checkbox')
            ->setAttrib('data-onchange', 'toggleFields')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper4($socialMediaLinkedInEnable));

        //socialMediaLinkedInUrl
        $socialMediaLinkedInUrl = new Zend_Form_Element_Text('socialMediaLinkedInUrl');
        $socialMediaLinkedInUrl->setLabel("LinkedIn")
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'socialMediaLinkedInEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper8($socialMediaLinkedInUrl))
            ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));

        //offerEnable
        $offerEnable = new Zend_Form_Element_Checkbox('offerEnable');
        $offerEnable->setLabel("Oferta")
            ->setAttrib('class', 'checkbox')
            ->setAttrib('data-onchange', 'toggleFields')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper12($offerEnable));

        //offerSectionTitle
        $offerSectionTitle = new Zend_Form_Element_Text('offerSectionTitle');
        $offerSectionTitle->setLabel('Nagłówek sekcji')
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'offerEnable')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper12($offerSectionTitle));

        //offerContent
        $offerContent = new Zend_Form_Element_Textarea('offerContent');
        $offerContent->setLabel('Opis oferty')
            ->setAttrib('class', 'text')
            ->setAttrib('rel', 'offerEnable')
            ->setAttrib('COLS', '40')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper12($offerContent));

        //forceHttps
        $forceHttps = new Zend_Form_Element_Checkbox('forceHttps');
        $forceHttps->setLabel("Włącz HTTPS")
            ->setAttrib('class', 'checkbox')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper12($forceHttps));

        //businessCardDisable
        $businessCardDisable = new Zend_Form_Element_Text('businessCardDisable');
        $businessCardDisable->setDescription('<a href="#">Wyłącz wizytówkę</a>')
            ->clearDecorators()
            ->addDecorators($this->CustomTag($businessCardDisable, 'div', 'large-6 medium-6 columns'))
            ->helper = 'formNote';

        //businessCardPreview
        $businessCardPreview = new Zend_Form_Element_Text('businessCardPreview');
        $businessCardPreview->setDescription('<a target="_blank" href="http://'.$_SERVER['HTTP_HOST'].$this->getView()->baseUrl().'">Przejdź do wizytówki</a>')
            ->clearDecorators()
            ->addDecorators($this->CustomTag($businessCardPreview, 'div', 'large-6 medium-6 columns'))
            ->helper = 'formNote';

        //businessCardReset
        $businessCardReset = new Zend_Form_Element_Text('businessCardReset');
        $businessCardReset->setDescription('<a href="#">Resetuj dane</a>')
            ->clearDecorators()
            ->addDecorators($this->CustomTag($businessCardReset, 'div', 'large-6 medium-6 columns'))
            ->helper = 'formNote';

        //submitButton
        $submitButton = new Zend_Form_Element_Submit('submitButton');
        $submitButton->setLabel("Publikuj")
            ->setAttrib('class', 'submit')
            ->setValue('SEND')
            ->clearDecorators()
            ->addDecorators($this->ElementWrapper6($submitButton))
            ->removeDecorator('Label');


//GROUPS

        //layout
        $layoutTitle = new Zend_Form_Element_Text('layoutTitle');
        $layoutTitle->setDescription('<h2 class="form-field">Układ i styl wizytówki</h2>')
            ->clearDecorators()
            ->addDecorators($this->CustomTag($layoutTitle, 'div', 'large-12 columns'))
            ->helper = 'formNote';
        $this->addElement($layoutTitle);

        $this->addDisplayGroup(
            array($basicInfoEnable, $detailsDataEnable, $correspondenceDataEnable, $mapEnable, $formEnable, $socialMediaEnable, $offerEnable, $forceHttps, $templateName),
            'layout'
        );
        $layout = $this->getDisplayGroup('layout');
        $layout->setDescription('Wybierz projekt wizytówki')
            ->clearDecorators()
            ->addDecorators($this->GroupWrapper($layout));

        //content
        $contentTitle = new Zend_Form_Element_Text('contentTitle');
        $contentTitle->setDescription('<h2 class="form-field">Treść wizytówki</h2>')
            ->clearDecorators()
            ->addDecorators($this->CustomTag($contentTitle, 'div', 'large-12 columns'))
            ->helper = 'formNote';
        $this->addElement($contentTitle);

        $this->addDisplayGroup(
            array($businessCardTitle,
                $basicInfoTitle,
                $basicInfoDescription,
                $basicInfoSectionTitle,
                $detailsDataTextTitle,
                $detailsDataAddressEnable,
                $detailsDataAddressStreet,
                $detailsDataAddressLocalNumber,
                $detailsDataAddressZipCode,
                $detailsDataAddressCity,
                $detailsDataPhoneEnable,
                $detailsDataPhoneValue,
                $detailsDataEmailEnable,
                $detailsDataEmailValue,
                $detailsDataNipEnable,
                $detailsDataNipValue,
                $detailsDataLinkEnable,
                $detailsDataLinkValue,
                $detailsDataSectionTitle,
                $correspondenceDataTextTitle,
                $correspondenceDataAddressEnable,
                $correspondenceDataAddressStreet,
                $correspondenceDataAddressLocalNumber,
                $correspondenceDataAddressZipCode,
                $correspondenceDataAddressCity,
                $correspondenceDataPhoneEnable,
                $correspondenceDataPhoneValue,
                $correspondenceDataSectionTitle
            ),
            'content'
        );
        $content = $this->getDisplayGroup('content');
        $content->setDescription('Informacje podstawowe')
            ->clearDecorators()
            ->setAttrib('rel', 'basicInfoEnable')
            ->addDecorators($this->GroupWrapper($content));

        //googlemap
        $this->addDisplayGroup(
            array(
                $mapContainer,
                $mapLat,
                $mapLng,
                $mapApiKeyEnable,
                $mapApiKey,
                $mapSectionTitle
            ),
            'googlemap'
        );
        $googlemap = $this->getDisplayGroup('googlemap');
        $googlemap->setDescription('Mapa Google <small>(lokalizacja)</small>')
            ->clearDecorators()
            ->setAttrib('rel', 'mapEnable')
            ->addDecorators($this->GroupWrapper($googlemap));

        //contactform
        $this->addDisplayGroup(
            array(
                $clientEmail,
                $formSectionTitle
            ),
            'contactform'
        );
        $contactform = $this->getDisplayGroup('contactform');
        $contactform->setDescription('Formularz kontaktowy')
            ->clearDecorators()
            ->setAttrib('rel', 'formEnable')
            ->addDecorators($this->GroupWrapper($contactform));

        //socialmedia
        $this->addDisplayGroup(
            array(
                $socialMediaFacebookEnable,
                $socialMediaFacebookUrl,
                $socialMediaInstagramEnable,
                $socialMediaInstagramUrl,
                $socialMediaGooglePlusEnable,
                $socialMediaGooglePlusUrl,
                $socialMediaTwitterEnable,
                $socialMediaTwitterUrl,
                $socialMediaYouTubeEnable,
                $socialMediaYouTubeUrl,
                $socialMediaLinkedInEnable,
                $socialMediaLinkedInUrl
            ),
            'socialmedia'
        );
        $socialmedia = $this->getDisplayGroup('socialmedia');
        $socialmedia->setDescription('Social Media')
            ->clearDecorators()
            ->setAttrib('rel', 'socialMediaEnable')
            ->addDecorators($this->GroupWrapper($socialmedia));

        //offer
        $this->addDisplayGroup(
            array(
                $offerSectionTitle,
                $offerContent
            ),
            'offer'
        );
        $offer = $this->getDisplayGroup('offer');
        $offer->setDescription('Oferta')
            ->clearDecorators()
            ->setAttrib('rel', 'offerEnable')
            ->addDecorators($this->GroupWrapper($offer));


        //bottomSection
        $this->addDisplayGroup(
            array(
                $businessCardReset,
                $businessCardPreview,
                $businessCardDisable,
                $submitButton
            ),
            'bottomsection'
        );
        $bottomsection = $this->getDisplayGroup('bottomsection');
        $bottomsection->setDescription('Opcje publikacji')
            ->clearDecorators()
            ->addDecorators($this->GroupWrapper($bottomsection));

    }

    /* conditional validation rules */
    public function isValid($data)
    {
        $form = $this;

        if ($data['basicInfoEnable'] == 1) {
            $form->getElement('basicInfoDescription')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
            $form->getElement('basicInfoSectionTitle')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
        }

        if ($data['detailsDataEnable'] == 1) {
            $form->getElement('detailsDataSectionTitle')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
        }

        if ($data['correspondenceDataEnable'] == 1) {
            $form->getElement('correspondenceDataSectionTitle')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
        }

        if ($data['detailsDataAddressEnable'] == 1) {
            $form->getElement('detailsDataAddressStreet')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
            $form->getElement('detailsDataAddressLocalNumber')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
            $form->getElement('detailsDataAddressZipCode')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
            $form->getElement('detailsDataAddressCity')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
        }

        if ($data['detailsDataPhoneEnable'] == 1) {
            $form->getElement('detailsDataPhoneValue')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
        }

        if ($data['detailsDataEmailEnable'] == 1) {
            $form->getElement('detailsDataEmailValue')
                ->setRequired(true)
                ->addValidator('EmailAddress', true)
                ->addValidator('NotEmpty', true);
        }

        if ($data['detailsDataNipEnable'] == 1) {
            $form->getElement('detailsDataNipValue')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
        }

        if ($data['detailsDataLinkEnable'] == 1) {
            $form->getElement('detailsDataLinkValue')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
        }

        if ($data['correspondenceDataAddressEnable'] == 1) {
            $form->getElement('correspondenceDataAddressStreet')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
            $form->getElement('correspondenceDataAddressLocalNumber')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
            $form->getElement('correspondenceDataAddressZipCode')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
            $form->getElement('correspondenceDataAddressCity')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
        }

        if ($data['correspondenceDataPhoneEnable'] == 1) {
            $form->getElement('correspondenceDataPhoneValue')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
        }

        if ($data['mapEnable'] == 1) {
            $form->getElement('mapSectionTitle')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
        }

        if ($data['mapApiKeyEnable'] == 1) {
            $form->getElement('mapApiKey')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
        }

        if ($data['formEnable'] == 1) {
            $form->getElement('formSectionTitle')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
            $form->getElement('clientEmail')
                ->setRequired(true)
                ->addValidator('EmailAddress', true)
                ->addValidator('NotEmpty', true);
        }

        if ($data['offerEnable'] == 1) {
            $form->getElement('offerSectionTitle')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 1024));
            $form->getElement('offerContent')
                ->setRequired(true)
                ->addValidator('NotEmpty', true)
                ->addValidator('StringLength', false, array('encoding' => 'UTF-8', 'max' => 8192));
        }

        if ($data['socialMediaFacebookEnable'] == 1) {
            $form->getElement('socialMediaFacebookUrl')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
        }

        if ($data['socialMediaInstagramEnable'] == 1) {
            $form->getElement('socialMediaInstagramUrl')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
        }

        if ($data['socialMediaGooglePlusEnable'] == 1) {
            $form->getElement('socialMediaGooglePlusUrl')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
        }

        if ($data['socialMediaTwitterEnable'] == 1) {
            $form->getElement('socialMediaTwitterUrl')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
        }

        if ($data['socialMediaYouTubeEnable'] == 1) {
            $form->getElement('socialMediaYouTubeUrl')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
        }

        if ($data['socialMediaLinkedInEnable'] == 1) {
            $form->getElement('socialMediaLinkedInUrl')
                ->setRequired(true)
                ->addValidator('NotEmpty', true);
        }

        return parent::isValid($data);
    }

    public function ElementWrapper4($element)
    {
        return array(
            'viewHelper',
            array('Errors', array('data-related-field' => $element->getName())),
            array ('Label', array('escape' => false)),
            array(
                array('row' => 'HtmlTag'),
                array('tag' => 'div', 'class' => 'form-field'),
            ),
            array('HtmlTag', array('tag' => 'div', 'class' => 'large-4 medium-4 columns formfield_'.$element->getName()))
        );
    }

    public function ElementWrapper6($element)
    {
        return array(
            'viewHelper',
            array('Errors', array('data-related-field' => $element->getName())),
            array ('Label', array('escape' => false)), //array ('Label', array('placement' => 'APPEND'))
            array(
                array('row' => 'HtmlTag'),
                array('tag' => 'div', 'class' => 'form-field'),
            ),
            array('HtmlTag', array('tag' => 'div', 'class' => 'large-6 medium-6 columns formfield_'.$element->getName()))
        );
    }

    public function ElementWrapper8($element)
    {
        return array(
            'viewHelper',
            array('Errors', array('data-related-field' => $element->getName())),
            array ('Label', array('escape' => false)),
            array(
                array('row' => 'HtmlTag'),
                array('tag' => 'div', 'class' => 'form-field'),
            ),
            array('HtmlTag', array('tag' => 'div', 'class' => 'large-8 medium-8 columns formfield_'.$element->getName()))
        );
    }

    public function ElementWrapper12($element)
    {
        return array(
            'viewHelper',
            array('Errors', array('data-related-field' => $element->getName())),
            array ('Label', array('escape' => false)),
            array(
                array('row' => 'HtmlTag'),
                array('tag' => 'div', 'class' => 'form-field')
            ),
            array('HtmlTag', array('tag' => 'div', 'class' => 'large-12 columns formfield_'.$element->getName()))
        );
    }

    public function TextWrapper($element)
    {
        return array(
            'viewHelper',
            array(
                array('row' => 'HtmlTag'),
                array('tag' => 'p', 'class' => 'form-field plaintext-field')
            ),
            array('HtmlTag', array('tag' => 'div', 'class' => 'large-12 columns textfield_'.$element->getName()))
        );
    }

    public function HeaderWrapper($element)
    {
        return array(
            'viewHelper',
            array(
                array('row' => 'HtmlTag'),
                array('tag' => 'h2', 'class' => 'form-field plaintext-field')
            ),
            array('HtmlTag', array('tag' => 'div', 'class' => 'large-12 columns headerfield_'.$element->getName()))
        );
    }

    public function GroupWrapper($element)
    {
        return array(
            array('Description', array('tag' => 'div', 'class' => 'hint hint_'.$element->getName().' large-12 columns', 'escape' => false)),
            'FormElements',
            array('HtmlTag', array('tag' => 'div', 'class' => 'row displayGroup groupfield_'.$element->getName(), 'rel' => $element->getAttrib('rel')))
        );
    }

    public function CustomTag($element, $tag, $class)
    {
        return array(
            'viewHelper',
            array('Description',
                array(
                    'tag' => $tag,
                    'class' => $class.' customtag_'.$element->getName(),
                    'escape' => false
                )
            )
        );
    }

    public function transformJsonBodyRequestToFormParameters($jsonBodyRequest)
    {
        $jsonBodyParamsArray = Zend_Json :: decode($jsonBodyRequest);

        $this->throwExceptionIfRequestDataIsNotValid($jsonBodyParamsArray);

        $paramsFromRequest = array();
        foreach($jsonBodyParamsArray as $param){
            $paramsFromRequest[$param['name']] = $param['value'];
        }
        return $paramsFromRequest;
    }

    /**
     * @param $jsonBodyParamsArray
     * @return mixed
     * @throws Api_Service_Exception_InvalidRequestData
     */
    public function throwExceptionIfRequestDataIsNotValid($jsonBodyParamsArray)
    {
        if(empty($jsonBodyParamsArray)){
            throw new InvalidArgumentException();
        }
        foreach ($jsonBodyParamsArray as $param) {
            if (!is_array($param)) {
                throw new InvalidArgumentException();
            }
        }
    }

    /**
     * @return Application_Model_BusinessCard
     */
    public function buildBusinessCardModel()
    {
        $businessCardModel = new Application_Model_BusinessCard();
        $businessCardModel->loadProperties($this->getValues());
        return $businessCardModel;
    }

    private function getTemplateListWithImages()
    {
        $templateList = array();

        $templateService = new Application_Service_Template($this->getTemplateRepositoryDir());
        $templatesListWithPreviewImgPattern =  $templateService->getTemplateListWithPreviewImgPattern('<span class="templatePreview" title="%s"><img class="small-thumb" src="//%s%s/templates-repository/scripts/%s/meta/preview.png" alt="" /><img class="large-thumb" src="//%s%s/templates-repository/scripts/%s/meta/preview-large.png" alt="" /></span>');

        foreach($templatesListWithPreviewImgPattern as $templateName=>$imgTmplateImgPatten){
            $templateList[$templateName] = sprintf($imgTmplateImgPatten, $templateName, $_SERVER['HTTP_HOST'], $this->getView()->baseUrl(), $templateName, $_SERVER['HTTP_HOST'], $this->getView()->baseUrl(), $templateName);
        }
        return $templateList;
    }

    private function getTemplateRepositoryDir()
    {
        $front = Zend_Controller_Front::getInstance();
        $bootstrap = $front->getParam('bootstrap');
        $options =  $bootstrap->getOption('resources');
        if(!isset($options['view']['basePath']))
        {
            throw new ErrorException('Option $options[\'view\'][\'basePath\'] do not exists');
        }
        return $options['view']['basePath'] . DIRECTORY_SEPARATOR . '/scripts/';
    }

    public function render()
    {
        $content = parent::render();
        $content .= $this->getView()->partial('partials/jsformscripts.phtml');
        return $content;
    }

}
