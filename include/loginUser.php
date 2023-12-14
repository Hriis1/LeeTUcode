<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") //if the user got to this page via POST
{
    $username = $_POST["username"];
    $pass = $_POST["pass"];

    try {
        require_once "sessionConfig.php";
        require_once "dbHandler.php";
        require_once "utils.php";


        //ERROR HANDLERS
        $errors = [];

        if (isInputEmptyLogIn($username, $pass)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        if (!$dbHandler->getUserByUsernaame($username)) {
            $errors["login_incorrect"] = "User doesn't exist!";
        } else if (!$dbHandler->isPasswordCorrect($username, $pass)) {
            $errors["incorrect_password"] = "Password is incorrect!";
        }

        if (!$errors) //if there were no errors
        {
            $user = $dbHandler->getUserByUsernaame($username); //Get the users data

            //Set the session variables for the users id
            $_SESSION["user_id"] = $user["id"];

            regenerateSessionIDLoggedIn(); //Generate a new session id and combin it with the users id

            $redirectUrl = isset($_SESSION['last_visited']) ? $_SESSION['last_visited'] : '../index.php';
            header('Location: ' . $redirectUrl . '?login=success');

            die(); //Kill the script

        } else //if there were errors
        {
            $_SESSION["errors_login"] = $errors;

            header('Location: ../loginForm.php?login=fail'); //Go back to log in form
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
