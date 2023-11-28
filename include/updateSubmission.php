<?php
include_once "dbHandler.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dbHandler->updateTaskSubmitionStatus($_POST["submitionStatus"], $_POST["taskId"]);
    $dbHandler->updateTaskSubmitionResponse($_POST["compilationResponse"], $_POST["taskId"]);
}