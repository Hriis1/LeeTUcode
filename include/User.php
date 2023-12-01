<?php
include_once "dbHandler.php";
class User
{
    private $_id;
    private $_username = "";
    private $_email = "";
    private $_password = "";
    private $_account_type = "";

    function __construct($id, $username, $email, $password, $account_type)
    {
        $this->_id = $id;
        $this->_username = $username;
        $this->_email = $email;
        $this->_password = $password;
        $this->_account_type = $account_type;
    }

    function joinCourse(dbHandler $dbHandler, $courseID)
    {
        $dbHandler->joinCourse($courseID, $this->_id);
    }
    function hasJoinedCourse(dbHandler $dbHandler, $courseID)
    {
        return $dbHandler->hasUserJoinedCourse($this->_id, $courseID);
    }

    //Getters
    function getID()
    {
        return $this->_id;
    }
    function getUsername()
    {
        return $this->_username;
    }

    function getEmail()
    {
        return $this->_email;
    }

    function getPassword()
    {
        return $this->_password;
    }

    function getAccountType()
    {
        return $this->_account_type;
    }
}
