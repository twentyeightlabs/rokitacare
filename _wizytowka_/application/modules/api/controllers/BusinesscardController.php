<?php

/**
 * Class Api_BusinesscardController
 */
class Api_BusinesscardController extends BusinessCard_Rest_Controller
{
    /**
     * The index action handles index/list requests; it should respond with a
     * list of the requested resources.
     */
    public function indexAction()
    {
        $this->forward('get', null, null, array('id'=>'current'));
    }

    /**
     * The get action handles GET requests and receives an 'id' parameter; it
     * should respond with the server resource state of the resource identified
     * by the 'id' value.
     */
    public function getAction()
    {
        $response = $this->getResponse();
        $bodyResponse = Api_Factory_BodyResponse::create();

        try{
            $this->auth();
            $response->setHttpResponseCode(200);
            $response->setBody($this->buildBusinessCardServiceDependsRequestParam()->get()->toJson());
        }catch(Api_Service_Exception_Auth $e) {
            $bodyResponse->setIsError(true);
            $bodyResponse->setExceptionClass(get_class($e));
            $bodyResponse->setExceptionMessage($e->getMessage());
            $response->setHttpResponseCode(401);
            $response->setBody($bodyResponse->toJson());
        }catch(Exception $e){
            $bodyResponse->setIsError(true);
            $bodyResponse->setExceptionClass(get_class($e));
            $bodyResponse->setExceptionMessage($e->getMessage());
            $response->setHttpResponseCode(500);
            $response->setBody($bodyResponse->toJson());
        }

        $response->setHeader('Content-Type', 'application/json; charset=UTF-8');
    }

    /**
     * The post action handles POST requests; it should accept and digest a
     * POSTed resource representation and persist the resource state.
     */
    public function postAction()
    {
        $response = $this->getResponse();
        $bodyResponse = Api_Factory_BodyResponse::create();

        try{
            $this->auth();
            $this->getBusinessCardFormService()->postFormHandle($this->getRequest(),new Api_Form_DataEdition(), $this->getBusinessCardService());
            $response->setHttpResponseCode(200);
        }catch(Api_Service_Exception_Auth $e) {
            $bodyResponse->setIsError(true);
            $bodyResponse->setExceptionClass(get_class($e));
            $bodyResponse->setExceptionMessage($e->getMessage());
            $response->setHttpResponseCode(401);
            $response->setBody($bodyResponse->toJson());
        }catch(Api_Service_Exception_InvalidFormData $e){
            $bodyResponse->setIsError(true);
            $bodyResponse->setExceptionClass(get_class($e));
            $bodyResponse->setExceptionMessage($e->getMessage());
            $bodyResponse->setErrors($e->displayErrors());
            $response->setHttpResponseCode(500);
            $response->setBody($bodyResponse->toJson());
        }catch(Exception $e){
            $bodyResponse->setIsError(true);
            $bodyResponse->setExceptionClass(get_class($e));
            $bodyResponse->setExceptionMessage($e->getMessage());
            $response->setHttpResponseCode(500);
            $response->setBody($bodyResponse->toJson());
        }

        $response->setHeader('Content-Type', 'application/json; charset=UTF-8');
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

    /**
     * @return Application_Service_BusinessCard
     * @throws ErrorException
     */
    private function buildBusinessCardServiceDependsRequestParam()
    {
        switch ($this->getRequest()->getParam('id')) {
            case "default":
                $businessCardService = Api_Factory_BusinessCardService:: create($this->getBusinessCardOption('dataFileDefault'));
                break;
            case "current":
                $businessCardService = Api_Factory_BusinessCardService:: create($this->getBusinessCardOption('dataFile'));
                break;
            default:
                throw new InvalidArgumentException('no require parameters. Allows parameters: default,current');
                break;
        }
        return $businessCardService;
    }
}