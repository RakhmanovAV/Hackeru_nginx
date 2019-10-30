<?php
class product extends model 
{
    const SHOW_BY_DEFAULT = 10;

    public function getLatesProduct($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);
        return $this -> db -> 
        select('id, name, price, image, is_new')-> 
        from ('product')->
        where ("status=1 ORDER BY id DESC LIMIT $count")->
        query();
        
    }

    public function getProductsListByCategory($categoryID, $count = self::SHOW_BY_DEFAULT)
    {
        
        return $this -> db -> 
        select('id, name, price, image, is_new')-> 
        from ('product')->
        where ("status=1 AND category_id = $categoryID ORDER BY id DESC LIMIT $count")->
        query();
        
    }


    public function getProductsById($productID)
    {
        

        return $this -> db -> 
        select('*')-> 
        from ('product')->
        where ("id=$productID")->
        query();
        
    }

    public function getProductsByIds($idsArray)
    {
        $idsString = implode(',', $idsArray);

        return $this -> db -> 
        select('*')-> 
        from ('product')->
        where ("status=1 AND id IN ($idsString)")->
        query();
        
    }
}