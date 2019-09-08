<?php

class request
{
    public $isForm = false;
    public $reqest = [];
    public $controller = '';
    public $action = '';
    public $isAjax = false;
    
    
    public function  __construct()
    {
        $this->reqest = $_REQUEST ?? [];
        $this->controller = $this->reqest['controller'] ?? '';
        $this->action = $this->reqest['action'] ?? '';
        $this->isForm = isset($this->reqest['send']);
        $this->isAjax = isset($_REQUEST['ajax']) && $_REQUEST['ajax'] ? true : false;
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        $this->isAjax = true;
        }
    unset($this->reqest['controller'], $this->reqest['action'], $this->reqest['send'], $this->reqest['ajax']);

    }
}