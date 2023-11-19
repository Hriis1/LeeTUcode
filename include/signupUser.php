<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") //if the user got to this page via POST
{
    $username = $_POST["username"];
    $pass = $_POST["pass"];
    $email = $_POST["email"];
    $accountType = $_POST["accountType"];

    try {
        require_once "sessionConfig.php";
        require_once "dbHandler.php";
        require_once "utils.php";
        

        //ERROR HANDLERS
        $errors = [];

        if (isInputEmptySignUp($username, $pass, $email)) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (isEmailInvalid($email)) {
            $errors["invalid_email"] = "Email is invalid!";
        }
        if ($dbHandler->isUsernameTaken($username)) {
            $errors["taken_username"] = "Username already taken!";
        }
        if ($dbHandler->isEmailRegistered($email)) {
            $errors["registered_email"] = "Email is already registered!";
        }

        if (!$errors) //if there were no errors
        {
            $dbHandler->createUser($username, $email, $pass, $accountType);
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

            header('Location: ../index.php?signup=fail'); //Redirect the user to the home page
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


