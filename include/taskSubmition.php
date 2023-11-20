<?php
class TaskSubmition
{

    private $_id;
    private $_submitedFunction = "";
    private $_submitionStatus = "";
    private $_taskID;
    private $_userID;

    function __construct($id, $function, $status, $taskID, $userID)
    {
        $this->_id = $id;
        $this->_submitedFunction = $function;
        $this->_submitionStatus = $status;
        $this->_taskID = $taskID;
        $this->_userID = $userID;
    }
 
    public function setStatus($status)
    {
        $this->_submitionStatus = $status;
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