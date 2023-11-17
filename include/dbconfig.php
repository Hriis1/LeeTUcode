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
}

// Report all mysqli errors as exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$dbHandler = new dbHandler();
