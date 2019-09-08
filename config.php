<?php

define('DEBUG', 1);
define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', __DIR__.DS);
define('APP_PATH', BASE_PATH."application".DS);
define('CLASSES', BASE_PATH.'framework'.DS.'classes'.DS);
        
return[
    'patch' =>[
        'controllers'=> APP_PATH.'controllers'.DS,
        'models' => APP_PATH.'models'.DS,
        'views' => APP_PATH.'views'.DS,
    ],
    'db'=>[
        
    ]
];