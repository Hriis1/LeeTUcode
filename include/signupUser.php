<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") //if the user got to this page via POST
{
    $username = $_POST["username"];
    $pass = $_POST["pass"];
    $email = $_POST["email"];

    try {
        require_once "sessionConfig.php";
        require_once "hashPassword.php";
        require_once "dbconfig.php";
        require_once "utils.php";
        require_once "dbUtils.php";
        

        //ERROR HANDLERS
        $errors = [];

        if (isInputEmptySignUp($username, $pass, $email)) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (isEmailInvalid($email)) {
            $errors["invalid_email"] = "Email is invalid!";
        }
        if (isUsernameTaken($mysqli, $username)) {
            $errors["taken_username"] = "Username already taken!";
        }
        if (isEmailRegistered($mysqli, $email)) {
            $errors["registered_email"] = "Email is already registered!";
        }

        if (!$errors) //if there were no errors
        {
            createUser($mysqli, $username, $pass, $email);

            $mysqli->close(); //free/close the sql connection
            header('Location: ../index.php?signup=success'); //Redirect the user to the home page
            die(); //Kill the script

        } else //if there were errors
        {
            $_SESSION["errors_signup"] = $errors;

            $signupData = [
                "username" => $username,
                "email" => $email
            ];
            $_SESSION["data_signup"] = $signupData;

            header('Location: ../index.php'); //Redirect the user to the home page
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


