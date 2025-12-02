<?php

function config()
{
    static $config = null;
    if ($config === null) {
        $config = require(__DIR__ . '/config.php');
    }
    return $config;
}


