<?php

class controllerTest extends controller
{
    public function  __construct()
    {
       // echo 'YES' . '<br />';
    }

    public function actionTest () 
    {
        //echo 'test<br />';
    }
    
    public function actionPage()
    {
        $this->renderLayout();
        //app::print_d($_REQUEST);
        //echo 'page<br />';
    }
}

