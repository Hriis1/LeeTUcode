<?php

require_once "sessionConfig.php";
require_once "config.php";

// Store the current page URL in a session variable
$_SESSION['last_visited'] = $_SERVER['REQUEST_URI'];