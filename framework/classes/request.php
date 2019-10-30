<?php

class request
{
    public $isForm = false;
    public $request = [];
    public $controller = '';
    public $action = '';
    public $isAjax = false;
    
    
    public function  __construct()
    {
        $this->request = $_REQUEST ?? [];
        
        $this->controller = $this->request['controller'] ?? '';
        $this->action = $this->request['action'] ?? '';
        $this->isForm = isset($this->request['send']);

        $this->isAjax = isset($_REQUEST['ajax']) && $_REQUEST['ajax'] ? true : false;
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        $this->isAjax = true;
        }
        
    unset($this->request['controller'], 
    $this->request['action'], 
    $this->request['send'], 
    $this->request['ajax'],
    $this->request['id']
);

    }
    
}