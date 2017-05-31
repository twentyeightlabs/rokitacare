<?php

/**
 * Class Api_Service_Exception_InvalidFormData
 */
class Api_Service_Exception_InvalidFormData extends Api_Service_Exception
{
    protected $errors;

    public function setErrors(array $errors)
    {
        $this->errors = $errors;
    }

    public function displayErrors()
    {
        $errors = array();
        foreach($this->errors as $name=>$error)
        {
            if(!is_array($error)){
                continue;
            }
            if(count($error) == 0){
                continue;
            }
            foreach($error as $err) {
                $errors[$name][]  = $err;
            }
        }
        return $errors;
    }
}