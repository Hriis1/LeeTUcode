<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") //if the user got to this page via POST
{
    $course_id = $_POST["course_id"];
    $difficulty = $_POST["difficulty"];
    $name = $_POST["name"];
    $description = $_POST["description"];
    $func_name = $_POST["func_name"];
    $func_declaration = $_POST["func_declaration"];
    $num_tests = $_POST["num_tests"];

    $testCasesArr = [];
    $answersArr = [];

    try {
        require_once "sessionConfig.php";
        require_once "dbHandler.php";
        require_once "utils.php";
        require_once "isInputEmpty.php";


        //ERROR HANDLERS
        $error = "";

        for ($i = 0; $i < intval($num_tests); $i++) {

            //Add the test cases to the array
            $testCasesArr[] = $_POST["test" . $i];

            //Check if the test cases were filled
            if($testCasesArr[$i] != "")
            {
                $error = "Test cases were not filled correctly!";
                break;
            }

            //Add the answers to the array
            $answersArr[] = $_POST["answer" . $i];

            //Check if answers were filled
            if($answersArr[$i]  != "")
            {
                $error = "Answers were not filled correctly!";
                break;
            }
        }

        if (utils\isInputEmpty($difficulty, $name, $description, $func_name, $func_declaration, $num_tests)) {
            $error = "Fill in all fields, please!";
        }
        //TO DO but prob wont do it: check if the provided function successfully with the test cases and answers

        if (!$error) //if there were no errors
        {


            header('Location: ../course.php?id='.$course_id.'$addTask=success');
            die(); //Kill the script

        } else //if there were errors
        {
            $_SESSION["add_task_error"] = $error;

            header('Location: ../addTaskPage.php?course_id='.$course_id.'addTask=fail'); //Redirect the user to the home page
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


