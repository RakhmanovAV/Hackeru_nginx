<?php

class controllerAdmin extends controller
{
    protected $layout='admin/index';
    protected $templateDir = 'templates';
public function actionIndex(){
    echo $this->renderLayout([
        'lo_admin' =>$this->renderTemplate('admin')
        ]);
    return true;
}

}