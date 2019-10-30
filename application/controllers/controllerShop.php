<?php

class controllerShop extends controller
{
    protected $layout='shop';
    protected $templateDir = 'templates';
    public function actionShop()
    {
        $params = 
        [
            'lo_category' => $this->menuTpl(),
            'lo_product'=>$this->ProductTpl(),
        ];
        echo  $this->renderLayout($params);
    }

    protected function menuTpl()
    {
        return $this->renderTemplate('category', 
        [
            'categories'=>$this->getModel('category')-> categoryList()
        ]);
    }

    protected function ProductTpl()
    {
        return $this->renderTemplate('product', 
        [
            'products'=>$this->getModel('product')-> getLatesProduct(6)
        ]);
        
    }
}