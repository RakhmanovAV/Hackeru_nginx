<?php

class controllerCategory_admin extends controller
{    
    protected $layout='admincategory/index';
    protected $templateDir = 'templates/admincategory';
    
    public function actionIndex()
    {
        $categories=$this->getModel('category')-> categoryList();
       
        echo $this->renderLayout([
            'lo_admin_category' =>$this->renderTemplate('admincategory', ['categories'=>$categories])
            
            
            ]);
            
            
        return true;
        
       
    }

    public function actionCreate()
    {
               
               if (app::app()->request->isForm) {
                $name = $_POST['name'];
                $sortOrder = $_POST['sort_order'];
                $status = $_POST['status'];
                

                $errors = false;
               // app::print_d($errors );        die();
                if (!isset($name) || empty($name)) {
                    $errors[] = 'Заполните поля';
                }
    
    
                if ($errors == false) {
                    $this->getModel('category')->createCategory($name, $sortOrder, $status);
                    header("Location: /Category_admin/index/");
                }
            }
            $categories=$this->getModel('category')-> categoryList();
        echo $this->renderLayout([
            'lo_admin_category' =>$this->renderTemplate('create', ['categories'=>$categories])
            
            
            ]);
            
            
        return true;
        
       
    }


}    