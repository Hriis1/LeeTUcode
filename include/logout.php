<?php
require_once "sessionConfig.php";

if (isset($_SESSION["user_id"])) 
{
    unset($_SESSION["user_id"]);
    unset($_SESSION["user_username"]);
    unset($_SESSION["user_email"]);
}

header('Location: ../index.php?logout=success'); //Redirect the user to the home page
die(); //Kill the script