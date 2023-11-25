<?php
function hashPassword($pass)
{
    $options = [
        "cost" =>12
    ];
    $hashedPassword = password_hash($pass, PASSWORD_BCRYPT, $options);

    return $hashedPassword;
}

function isInputEmptySignUp(string $username, string $password, string $email)
{
    if(empty($username) || empty($password) || empty($email))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function isInputEmptyLogIn(string $username, string $password)
{
    if(empty($username) || empty($password))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function isEmailInvalid(string $email)
{
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) //checks if email is valid
    {
        return true;
    }
    else
    {
        return false;
    }
}