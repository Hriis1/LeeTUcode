<?php

require_once "sessionConfig.php";

// Store the current page URL in a session variable
$_SESSION['last_visited'] = $_SERVER['HTTP_REFERER'];