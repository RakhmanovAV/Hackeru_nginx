<?php
$config = include './config.php';
include './framework/core.php';

if (DEBUG) {
 ini_set('display_errors', 1);
 error_reporting(E_ALL);   
}
//$app = new app();
app::app() ->start($config);
app::print_d($_REQUEST);
//echo app::app() -> patch['controllers'];