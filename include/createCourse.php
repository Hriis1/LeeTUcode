<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") //if the user got to this page via POST
{
    $course_name = $_POST["name"];
    $course_requirements = $_POST["requirements"];
    $course_description = $_POST["description"];
    $creator_id = $_POST["creator_id"];

    try {
        require_once "sessionConfig.php";
        require_once "dbHandler.php";
        require_once "utils.php";
        require_once "isInputEmpty.php";
        

        //ERROR HANDLERS
        $error = "";

        if (utils\isInputEmpty($course_name, $course_requirements, $course_description, $creator_id)) {
            $error = "Fill in all fields!";
        }
        else if ($dbHandler->isCourseNameTaken($course_name)) {
            $error = "Course name taken!";
        }

        if (!$error) //if there were no errors
        {
            //Create the course
            $dbHandler->createCourse($course_name, $course_requirements, $course_description, $creator_id);

            //Join the course since the creator should be a member

            header('Location: ../profile.php?createCourse=success'); 
            die(); //Kill the script

        } else //if there were errors
        {
            $_SESSION["create_course_error"] = $error;

            header('Location: ../createCoursePage.php?createCourse=fail'); //Redirect the user to the home page
            die();
           
        }
    } catch (mysqli_sql_exception $e) {
        die("Query failed: " . $e->getMessage());
    } catch (Exception $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header('Location: ../index.php'); //Redirect the user to home page
    die();
}


