<?php

spl_autoload_register('app::autoload');

class app
{
    protected $config = false;
    public $request = false;
    public $user = false;
    public $acceptCokie = 0;

    private static $instance = false;
    private function  __wakeup(){}
    private function  __clone(){}
    private function  __construct()
    {
        self::init();
        $this->request = new request;
        
    }
    
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

    private function init()
    {
        $basePath = get_include_path();
        $basePath .= PATH_SEPARATOR. CLASSES;
        set_include_path($basePath);
    }

    public static function autoload($name)
    {
        include $name.'.php';
    }
    

    public function start($config)
    {
        $this->config = $config;
        $this->acceptCookie = 1;
        $this->user = new user;
        
        
        try {
                    $this->runController(
                    !empty($_REQUEST['controller']) ? $_REQUEST['controller'] : 'shop',
                    !empty($_REQUEST['action']) ? $_REQUEST['action'] : 'shop',
                    $_REQUEST['id']
                );
                    
        } catch (httpException $e) {
            $e->sendHttpState();
            echo $e->getMessage();
            $this->runController('errors','notfound');
        } catch(dbException $e){
            echo $e->getMessage();die();
        } catch(Exception $e){
            echo $e->getMessage();die();
    }
    }
    protected function runController($controller, $action, $id='')
    {
        $fname = 'controller'.ucfirst(strtolower(str_replace(['.','/'], '', $controller)));
        
        if (!@include_once $this->path['controllers'].$fname.'.php'){
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
       
        $controller->$aname($id);
    }
   
    public static function print_d($data=[])
    {
        echo '<pre>';
        print_r($data);       
        echo '</pre>';
    }
}