<?php

define('DEBUG', 1);
define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', __DIR__.DS);
define('APP_PATH', BASE_PATH.'application'.DS);
define('CLASSES', BASE_PATH.'framework'.DS.'classes'.DS);
        
return[
    'path' =>[
        'controllers'=> APP_PATH.'controllers'.DS,
        'models' => APP_PATH.'models'.DS,
        'views' => APP_PATH.'views'.DS,
        'layouts' => APP_PATH.'views'.DS.'layouts'.DS
    ],
    'db'=>[
        'local'=> [
                'host'=>'localhost ',
                'port'=> 5432 ,
                'db_name'=> 'hackeru' ,
                'user'=> 'hackeru' ,
                'password'=>'password' ,
                 ]
        
    ]
];