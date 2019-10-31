<?php

class roles extends model 
{
    public function rolesList()
    {
        return $this->db->select('*')->from('roles')->query();
    }

    public function privilegesList()
    {
        return $this->db->select('*')->from('privileges')->query();
    }

    public function roleById($id)
    {
        if(!preg_match('#[0-9]*#', $id)){
            throw new httpException(404, 'Invalid role id' . $id);
        }
        $role = $this->db->select('*')->from('roles')-> where('id=:id', [':id'=>$id])->query();
        return empty($role) ? [] : reset($role);
    }

    public function privilegesByRole($roleId)
    {
        if(!preg_match('#[0-9]*#', $id)){
            throw new httpException(404, 'Invalid role id' . $id);
        }
        $sql = 'SELECT p.* FROM roles_privileges as rp JOIN privileges p ON p.id=rp.privileges_id WHERE rp.role_id=' . $roleId;
        $res= $this->db->selectQury($sql);
        $out = [];
        foreach ($res as $item) {
            $out[$item['id']] = [
                'id'=>$item['id'],
                'name'=>$item['name'],
                'code' =>$item['code']
            ];
        }
        return $out;
    }

    public function roleInfoById($id)
    {
        $role = $this->roleById($id);
       if(isset($role['id'])) {
            $role['privileges'] = $this -> privilegesByRole($role['id']);
        }
        return $role;
    }

    public function saveRole($role)
    {
        if(isset($role['id']) && $role['id']){
            return $this->updateRole($role);

        }else{
            
            return $this->createRole($role);
        }
    }

   protected function createRole($role)
    {
        $privileges = $role['privilage'];
        app::print_d($role);die;
        unset($role['id'], $role['privilege']);
        app::print_d($privileges);die;
        $id = $this->db ->insert('roles', 'id')->insertData($role)->query();
        $id = reset($id);
        $id = $id['id'];
        foreach($privilages as $p){
            $this->db->insert('roles_privileges')->insertData(['role_id'=>$id, 'privileges_id'=> $p])->query();
            }
    }

    protected function updateRole($role)
    {

    }
}