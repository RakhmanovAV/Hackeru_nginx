<?php
class category extends model 
{
    public function categoryList()
    {
        
        return  $this -> db -> select('id, name')-> from ('category')->query();
        
    }
}