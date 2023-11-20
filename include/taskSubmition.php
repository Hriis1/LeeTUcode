<?php
include_once "dbHandler.php";
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
 
    public function updateSubmitionStatus(dbHandler $_dbHandler, $status)
    {
        $this->_submitionStatus = $status;

        //Run the sql querry
        $_dbHandler->updateTaskSubmitionStatus($status, $this->_id);
    }

    //Getters
    function getID()
    {
        return $this->_id;
    }
    function getSubmitedFunction()
    {
        return $this->_submitedFunction;
    }

    function getSubmitionStatus()
    {
        return $this->_submitionStatus;
    }

    function getTaskID()
    {
        return $this->_taskID;
    }

    function getUserID()
    {
        return $this->_userID;
    }

}