<?php

class dbHandler
{
    private $mysqli;
    public function __construct()
    {
        try {
            $host = "localhost";
            $dbname = "leeTUcode";
            $dbusername = "root";
            $dbpassword = "";

            $this->mysqli = new mysqli($host, $dbusername, $dbpassword, $dbname);
            if ($this->mysqli->connect_errno) {
                throw new Exception("Failed to connect to MySQL: " . $this->mysqli->connect_error);
            }
            mysqli_query($this->mysqli, "SET NAMES 'UTF8'");

        } catch (mysqli_sql_exception $e) {
            die("MySQL error: " . $e->getMessage());
        } catch (Exception $e) {
            die("General error: " . $e->getMessage());
        }

    }

    public function createUser(string $username, string $pass, string $email)
    {
        $hashedPassword = hashPassword($pass); //hash the password
    
        $myQuery = $this->mysqli->prepare("INSERT INTO users (username, pass, email) VALUES (?,?,?);"); //Prepare the sql query
        $myQuery->bind_param("sss", $username, $hashedPassword, $email); //bind the params in place of the '?'
        $myQuery->execute(); //Execute the statement
        $myQuery->close(); //Free/close the statement
    }

    public function createTask()
    {

    }

    public function getUser()
    {
        
    }



}

// Report all mysqli errors as exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$dbHandler = new dbHandler();
