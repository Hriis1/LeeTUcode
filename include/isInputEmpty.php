<?php

namespace utils;

function isInputEmpty()
{
    $args = func_get_args();

    foreach ($args as $arg) {
        if (empty($arg)) {
            return true;
        }
    }

    return false;
}