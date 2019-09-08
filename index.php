<?php

$config = include './config.php';
include './framework/core.php';

if (DEBUG) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

app::app()->start($config);