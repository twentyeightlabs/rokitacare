<?php

/**
 * Class Api_BusinesscardformController
 */
class Api_BusinesscardformController extends BusinessCard_Rest_Controller
{
    /**
     * The index action handles index/list requests; it should respond with a
     * list of the requested resources.
     */
    public function indexAction()
    {
        $response = $this->getResponse();
        $bodyResponse = Api_Factory_BodyResponse :: create();

        try{
            $this->auth();
            $form = $this->getBusinessCardFormService()->getFormHandle(new Api_Form_DataEdition(), $this->getBusinessCardService());
            $bodyResponse->setFormHtml($form->render());
            $bodyResponse->formHtml = $form->render();
            $response->setHttpResponseCode(200);
        }catch(Api_Service_Exception_Auth $e){
            $bodyResponse->setIsError(true);
            $bodyResponse->setExceptionClass(get_class($e));
            $bodyResponse->setExceptionMessage($e->getMessage());
            $response->setHttpResponseCode(401);
        }catch(Exception $e){
            $bodyResponse->setIsError(true);
            $bodyResponse->setExceptionClass(get_class($e));
            $bodyResponse->setExceptionMessage($e->getMessage());
            $response->setHttpResponseCode(500);

        }

        $response->setHeader('Content-Type', 'application/json; charset=UTF-8');
        $response->setBody($bodyResponse->toJson());
    }

    /**
     * The post action handles POST requests; it should accept and digest a
     * POSTed resource representation and persist the resource state.
     */
    public function postAction()
    {
        $response = $this->getResponse();
        $bodyResponse = Api_Factory_BodyResponse :: create();

        try{
            $this->auth();
            $form = new Api_Form_DataEdition();
            $this->getBusinessCardFormService()->postFormHandle($this->getRequest(), $form,  $this->getBusinessCardService());
            $response->setHttpResponseCode(200);
        }catch(Api_Service_Exception_Auth $e){
            $bodyResponse->setIsError(true);
            $bodyResponse->setExceptionClass(get_class($e));
            $bodyResponse->setExceptionMessage($e->getMessage());
            $response->setHttpResponseCode(401);
        }catch(Api_Service_Exception_InvalidFormData $e){
            $bodyResponse->setIsError(true);
            $bodyResponse->setExceptionClass(get_class($e));
            $bodyResponse->setExceptionMessage($e->getMessage());
            $bodyResponse->setErrors($e->displayErrors());
            $bodyResponse->formHtml = $form->render();
            $bodyResponse->setFormHtml($form->render());
            $response->setHttpResponseCode(200);
        }catch(Exception $e){
            $bodyResponse->setIsError(true);
            $bodyResponse->setExceptionClass(get_class($e));
            $bodyResponse->setExceptionMessage($e->getMessage());
            $response->setHttpResponseCode(500);
        }

        $response->setHeader('Content-Type', 'application/json; charset=UTF-8');
        $response->setBody($bodyResponse->toJson());
    }

    /**
     * The get action handles GET requests and receives an 'id' parameter; it
     * should respond with the server resource state of the resource identified
     * by the 'id' value.
     */
    public function getAction()
    {
        $this->getResponse()->setHttpResponseCode(405);
    }

    /**
     * The put action handles PUT requests and receives an 'id' parameter; it
     * should update the server resource state of the resource identified by
     * the 'id' value.
     */
    public function putAction()
    {
        $this->getResponse()->setHttpResponseCode(405);
    }

    /**
     * The head action handles HEAD requests and receives an 'id' parameter; it
     * should respond with the server resource state of the resource identified
     * by the 'id' value.
     */
    public function headAction()
    {
        $this->getResponse()->setHttpResponseCode(405);
    }

    /**
     * The delete action handles DELETE requests and receives an 'id'
     * parameter; it should update the server resource state of the resource
     * identified by the 'id' value.
     */
    public function deleteAction()
    {
        $this->getResponse()->setHttpResponseCode(405);
    }

}