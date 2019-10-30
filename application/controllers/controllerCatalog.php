<?php

class controllerCatalog extends controller
{
    protected $layout='catalog/index';
    protected $templateDir = 'templates';
    public function actionIndex($categoryID)
    {
        $params = 
        [
            'lo_category' => $this->menuTpl(),
            'lo_product'=>$this->ProductTpl($categoryID),
        ];
        echo  $this->renderLayout($params);
    }

    protected function menuTpl()
    {
        return $this->renderTemplate('category', 
        [
            'categories'=>
                $this->getModel('category')-> categoryList()
        ]);
    }
    
    protected function ProductTpl($categoryID)
    {
        return $this->renderTemplate('product',
        [ 
            'products'=>
                !empty($categoryID) ?
                $this->getModel('product')-> getProductsListByCategory($categoryID):
                $this->getModel('product')->getLatesProduct(6)
        ]);
    }
}
