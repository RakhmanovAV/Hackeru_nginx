<?php

class controllerCart extends controller
{
    protected $layout='cart/index';
    protected $templateDir = 'templates';
    public function actionAdd($id)
    {         
        cart::addProduct($id); 
        $referrer = $_SERVER['HTTP_REFERER'];
        header("location: $referrer");
    }


    public function actionAddAjax($id)
    {         
       echo cart::addProduct($id); 
        return true;
    }
    
    public function actionIndex()
    {   
        $productsInCart = cart::getProducts();
        $productsIds = '';
        $products = '';
        $totalPrice = '';
        if($productsInCart)
        {   $productsIds = array_keys($productsInCart);
            $products = $this->getModel('product')->getProductsByIds($productsIds);
            $totalPrice = cart::getTotalPrice($products);
        }
        echo $this->renderLayout([
            'lo_category' => $this->menuTpl(),
            'lo_cart'=>$this->renderTemplate('cart', 
                [    'products'=>$products,
                    'productsInCart'=>$productsInCart,
                    'totalPrice'=>$totalPrice                       
                                        ])
            ]);
    }

    public function actionDelete($id)
    {
        cart::deleteProduct($id);
        header("Location: /cart/index");
    }
    
    protected function menuTpl()
    {
        return $this->renderTemplate('category', 
        [
            'categories'=>$this->getModel('category')-> categoryList()
        ]);
    }
    protected function cartTpl()
    {    
        
        
        
    }

    public function actionCheckout()
    {   
        
        if (cart::getProducts() == false) {
                     header("Location: /");
                 }
        $productsInCart = cart::getProducts();
        $productsIds = false;
        $products = false;
        $totalPrice = false;
        $userName = false;
        $userPhone = false;
        $userComment = false;
        $result = false;

        $totalQuantity = Cart::countItems();
        if($productsInCart)
        {   $productsIds = array_keys($productsInCart);
            $products = $this->getModel('product')->getProductsByIds($productsIds);
            $totalPrice = cart::getTotalPrice($products);
        }
        
        if (!empty(app::app()->user->isUser)) {
            
            $userId =$_SESSION['id'];    
            $user = $this ->getModel('userorder')->getUserById($userId);
            $user = reset($user);
            $userName = $user['email'];
           
        }else {
                     $userId = 0;
        }

        if (isset($_POST['submit'])) {
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            
            $errors = false;
            
            if (!$this->checkName($userName)) {
                $errors[] = 'Неправильное имя';
            }
            if (!$this->checkPhone($userPhone)) {
                $errors[] = 'Неправильный телефон';
            }
            if ($errors == false) {
                
                $this ->getModel('userorder')->updateProduct_Order($userName, $userPhone, $userComment, $userId, $productsInCart);
                $result = true;
                Cart::clear();
                }
            }
        

        echo $this->renderLayout([
            'lo_category' => $this->menuTpl(),
            
            'lo_checkout' => $this->renderTemplate('checkout',[
                                    'productsInCart'=>$productsInCart,
                                    'totalPrice'=>$totalPrice, 
                                    'result' =>$result,
                                    'totalQuantity'=>$totalQuantity,
                                    'userName' => $userName,
                                    'userPhone' => $userPhone,
                                    'userComment' => $userComment,
                                    'errors' => $errors,
                                    'result' => $result
                                    ])
        ]);
        return true;
    }    
    
    public static function checkName($name)
        {
            if (strlen($name) >= 2) {
                return true;
            }
            return false;
        }

    public static function checkPhone($phone)
        {
            if (strlen($phone) >= 10) {
                return true;
            }
            return false;
        }
}
