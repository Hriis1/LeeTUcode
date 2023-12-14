<?php
require_once "config.php";
function regenerateSessionID()
{
    session_regenerate_id(true);
    $_SESSION["last_regeneration"] = time();
}

function regenerateSessionIDLoggedIn()
{
    session_regenerate_id(true);
    $newSessionID = session_create_id(); //Generate a nwe session id
    $sessionID = $newSessionID . "_" . $_SESSION["user_id"]; //Combine the session id with the users id
    session_id($sessionID); //Set the session id
    $_SESSION["last_regeneration"] = time();
}

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    "lifetime" => 1800,
    "domain" => "localhost",
    "path" => "/",
    "secure" => true,
    "httponly" => true
]);

session_start();

/// Check if the session has expired
$sessionExpired = false;

if (isset($_SESSION["last_activity"])) {
    $inactiveTime = 1800; // 30 minutes in seconds
    $currentTime = time();

    if ($currentTime - $_SESSION["last_activity"] >= $inactiveTime) {
        $sessionExpired = true;
    }
}

if (isset($_SESSION["user_id"])) //If there is a loged in user
{
    if (!isset($_SESSION["last_regeneration"]) || $sessionExpired) {
        regenerateSessionIDLoggedIn();
    } else {
        $interval = 60 * 30;
        if (time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerateSessionIDLoggedIn();
        }
    }
} else //If there isnt a loged in user
{
    if (!isset($_SESSION["last_regeneration"]) || $sessionExpired) {
        // Redirect to the front page when the session has expired
        header("Location: /front-page.php");
        exit();
    } else {
        $interval = 60 * 30;
        if (time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerateSessionID();
        }
    }
}
