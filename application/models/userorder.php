<?php
class userorder extends model 
{
    public function getUserById($userId)
    {
        
        return  $this -> db->
        select('*')->
        from('users')->
        where("id=$userId")->
        query();

        
    }
   
    public function updateProduct_Order($userName, $userPhone, $userComment, $userId, $products)
    {
        $products = json_encode($products);
        $this->db->insert('product_order')->
        insertData(['user_name'=>$userName, 'user_phone'=>$userPhone, 'user_comment'=>$userComment, 'user_id'=> $userId, 'products'=>$products])->
                query();
    }
}
