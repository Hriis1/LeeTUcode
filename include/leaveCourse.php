<?php
include_once "sessionConfig.php";
include_once "dbHandler.php";

$courseID = $_GET["course_id"];
if (isset($_SESSION["user_id"])) {
    if ($dbHandler->hasUserJoinedCourse($_SESSION["user_id"], $courseID)) {
        //If the user has joined the course
        $dbHandler->leaveCourse($courseID, $_SESSION["user_id"]);
        header("Location: ../course.php?id=" . $courseID . "&leaveCourse=success");
        exit();
    } else {
        //If the user has not yet joined the course
        header("Location: ../course.php?id=" . $courseID . "&leaveCourse=fail");
        exit();
    }
} else {
    header("Location: ../course.php?id=" . $courseID . "&leaveCourse=fail");
    exit();
}