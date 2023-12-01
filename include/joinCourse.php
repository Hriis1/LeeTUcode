<?php
include_once "sessionConfig.php";
$courseID = $_GET["course_id"];
if (isset($_SESSION["user_id"])) {
    if ($dbHandler->hasUserJoinedCourse($_SESSION["user_id"], $courseID)) {
        //If the user has already joined the course
        header("Location: ../course.php?id=" . $courseID . "&joinCourse=fail");
        exit();
    } else {
        //If the user has not yet joined the course
        $dbHandler->joinCourse($courseID, $_SESSION["user_id"]);

        header("Location: ../course.php?id=" . $courseID . "&joinCourse=success");
        exit();
    }
} else {
    header("Location: ../course.php?id=" . $courseID . "&joinCourse=fail");
    exit();
}