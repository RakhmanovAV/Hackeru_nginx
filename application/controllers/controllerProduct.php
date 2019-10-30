<?php

class controllerProduct extends controller
{
    protected $layout='product';
    protected $templateDir = 'templates';
    public function actionIndex($productID)
    {
        $params = 
        [
            'lo_category' => $this->menuTpl(),
            'lo_productcard'=>$this->CardProductTpl($productID),
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

    protected function CardProductTpl($productID)
    {
        return $this->renderTemplate('productcard', 
        [
            'products'=>$this->getModel('product')-> getProductsById($productID)
             
        ]);
        
    }
}