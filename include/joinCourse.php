<?php
include_once "sessionConfig.php";
$courseID = $_GET["course_id"];
if (isset($_SESSION["user_id"])) {
    header("Location: ../course.php?id=" . $courseID . "&joinCourse=success");
} else {
    header("Location: ../course.php?id=" . $courseID . "&joinCourse=fail");
exit();
}