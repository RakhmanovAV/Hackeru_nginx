<?php

class httpException extends Exception
{
    protected $httpMessages = 
            [
                404 => 'Not Found',
                403 => 'Forbidden'
            ];
    public function __construct(int $code = 0, string $message = "") 
            {
                parent::__construct($message, $code);
            }
    public function  sendHttpState()
            {
                //logger->log($this->getMessage());
                header('HTTP/1.0'.$this->getCode().''.$this->httpMessages[$this->getCode()]);
            }
}

class app
{
    protected $config = false;
    
    private static $instance = false;
    private function __wakeup(){}
    private function  __clone(){}
    private function  __construct(){}
    public static function  app()
    {
        if (self::$instance === false )
            self::$instance = new self();
        return self::$instance;
    }
    
    public function __get($name)
    {
        return $this->config[$name] ?? false;
        
    }

        public function start($config)
    {
        $this -> config = $config;
        
        try {
            $this->runController(
                    !empty($_REQUEST['controller']) ? $_REQUEST['controller'] : 'test',
                    //$_REQUEST['controller'] ?? 'test'
                    //isset($_REQUEST['controller']) ? $_REQUEST['controller'] : 'test'
                    !empty($_REQUEST['action']) ? $_REQUEST['action'] : 'page'
                    );
        } catch (httpException $e) {
            $e->sendHttpState();
            echo $e->getMessage();
            $this->runController('errors','notfound');
            
        }
           
    }
    
    protected function runController($controller, $action)
    {
        $fname = 'controller'.ucfirst(strtolower(str_replace(['.','/'], '', $controller)));
        
        if (!@include_once $this->patch['controllers'].$fname. '.php'){
            throw new httpException(404, 'Controller file not found');
        }
        if (!class_exists($fname)){
            throw new httpException(404, 'Controller class not found'); 
        }
        $controller = new $fname;
        
        $aname = 'action' .ucfirst(strtolower($action));
        if (!method_exists($controller, $aname)){
            throw new httpException(404, 'Action not found');
        }
        
        $controller->$aname();
    }



    public static function print_d($data=[])
    {
        echo '<pre>';
        print_r($data);       
        echo '</pre>';
    }
}