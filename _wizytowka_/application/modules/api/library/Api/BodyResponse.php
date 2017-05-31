<?php

/**
 * Class Api_Response
 */
class Api_BodyResponse
{
    private $isError = false;
    private $exceptionClass = '';
    private $exceptionMessage = '';
    private $data = null;
    private $formHtml = '';
    private $errors = '';


    /**
     * @param string $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    /**
     * @return string
     */
    public function getErrors()
    {
        return $this->errors;
    }



    public function __construct()
    {
        $this->data = new stdClass();
    }

    /**
     * @param mixed $isError
     */
    public function setIsError($isError)
    {
        $this->isError = $isError;
    }

    /**
     * @param mixed $exceptionClass
     */
    public function setExceptionClass($exceptionClass)
    {
        $this->exceptionClass = $exceptionClass;
    }

    /**
     * @param mixed $exceptionMessage
     */
    public function setExceptionMessage($exceptionMessage)
    {
        $this->exceptionMessage = $exceptionMessage;
    }

    /**
     * @param null $formHtml
     */
    public function setFormHtml($formHtml)
    {
        $this->formHtml = $formHtml;
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->data->$name = $value;
    }

    /**
     * @param stdClass $data
     */
    public function setData(stdClass $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'isError' => $this->isError,
            'exceptionClass'=> $this->exceptionClass,
            'exceptionMessage'=> $this->exceptionMessage,
            'errors' => $this->errors,
            'data' => $this->data,
        );
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return Zend_Json::encode($this->toArray());
    }
}