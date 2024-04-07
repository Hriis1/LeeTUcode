<?php
include_once "dbHandler.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $user_ = $dbHandler->getUserByUsernaame($username);
    $userId_ = array_shift($user_);
    if($dbHandler->hasUserJoinedCourse($userId_, $_POST["courseID"])) {
        //If the user has already joined the course
        exit();
    } else {
        //If the user has not yet joined the course
        $dbHandler->joinCourse($_POST["courseID"], $userId_);
        exit();
    }
}
