<?php
function hashPassword($pass)
{
    $options = [
        "cost" =>12
    ];
    $hashedPassword = password_hash($pass, PASSWORD_BCRYPT, $options);

    return $hashedPassword;
}