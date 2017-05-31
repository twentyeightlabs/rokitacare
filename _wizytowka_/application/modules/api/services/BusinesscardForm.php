<?php

/**
 * Class Api_Service_BusinesscardForm
 */
class Api_Service_BusinesscardForm
{
    /**
     * @param Zend_Controller_Request_Http $request
     * @param Api_Form_DataEdition $form
     * @param $businesscardService
     */
    public function getFormHandle(Api_Form_DataEdition $form , $businessCardService)
    {
        $form->populate($businessCardService->get()->getProperties());
        return $form;
    }

    /**
     * @param Zend_Controller_Request_Http $request
     * @param Zend_Controller_Response_Http $response
     * @param Api_Form_DataEdition $form
     * @throws Exception
     */
    public function postFormHandle(Zend_Controller_Request_Http $request, Api_Form_DataEdition $form, $businessCardService)
    {
        $requestParams = $this->getAdaptedRequestData($form, $request->getRawBody());
        $this->throwExceptionIfFormIsNotValid($form, $requestParams);
        $businessCardService->save(new Application_Model_BusinessCard($requestParams));
    }

    /**
     * @param Api_Form_DataEdition $form
     * @param $requestParams
     * @throws Api_Service_Exception_InvalidFormData
     */
    private function throwExceptionIfFormIsNotValid(Api_Form_DataEdition $form, $requestParams)
    {
        if(!$form->isValid($requestParams)){
            $exception = new Api_Service_Exception_InvalidFormData();
            $exception->setErrors($form->getErrors());
            throw $exception;
        }
    }

    /**
     * @param Api_Form_DataEdition $form
     * @param $requestData
     * @throws Api_Service_Exception_InvalidRequestData
     */
    private function getAdaptedRequestData(Api_Form_DataEdition $form, $requestData)
    {
        try{
            return $form->transformJsonBodyRequestToFormParameters($requestData);
        }catch(InvalidArgumentException $e){
            throw new Api_Service_Exception_InvalidRequestData();
        }catch(Exception $e){
            throw $e;
        }
    }
}