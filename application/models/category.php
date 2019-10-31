<?php
class category extends model 
{
    public function categoryList()
    {
        
        return  $this -> db -> select('id, name, sort_order, status')-> from ('category')->query();
        
    }

    public function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Отображается';
                break;
            case '0':
                return 'Скрыта';
                break;
        }
    }

    public function createCategory($name, $sortOrder, $status)
    {
        $sql ['name']=$name;
        $sql ['sort_order']=$sortOrder;
        $sql ['status']=$status;
        
        $this->db->insert('category')->insertData($sql)->query();
        

        return $result;
    }
 
}