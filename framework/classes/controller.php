<?php

abstract class controller 
{
    private $models = [];
    protected $layout = 'main';
    protected $templateDir = '';
    
    public function __construct()
    {

    }

    protected function getModel($name)
    {
        if(!isset($this->models[$name])){
            if(!@include app::app()->path['models'] . $name . '.php'){
                throw new dbException('Undefined model');
            }
            $this->models[$name] = new $name();
        }
        return $this->models[$name];
    }

    protected function renderLayout($params=[])
    {
            foreach ($params as $name => $value){
               $$name = $value;
           }
            ob_start();
            include app::app()->path['layouts'] . $this->layout . '.php';
            return ob_get_clean();
            
    }

    protected function renderTemplate($__tplname, $params = [])
    {
            foreach ($params as $var => $value){
                $$var = $value;
            }
            ob_start();
            include app::app()->path['views'] . $this->templateDir . DS . $__tplname . '.php';
            return ob_get_clean();
    }

    public function response()
    {
        if(app::app()->request->isAjax){
            echo json_encode(['tpl_a_name' => $this->renderTemblate($__tplname), 'tpl_b_name' => 'TEMPLATE B CONTENT']);
        } else {
            echo '<html><head></head><body>test</body></html>';
        }
    }
}

