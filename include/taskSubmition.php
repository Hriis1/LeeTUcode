<?php
class TaskSubmition
{

    private $_submitedFunction = "";
    private $_submitionStatus = False;

    function __construct($function, $status)
    {
        $this->_submitedFunction = $function;
        $this->_submitionStatus = $status;
    }
 
    public function setStatus($status)
    {
        if(is_bool($status)){
            $this->_submitionStatus = $status
        }
        else
        {   
            echo "Status input not boolean!"
            return -1;
        }
    }

    //Getters
    function getSubmitedFunction()
    {
        return $this->_submitedFunction;
    }

    function getSubmitionStatus()
    {
        return $this->_submitionStatus;
    }



}