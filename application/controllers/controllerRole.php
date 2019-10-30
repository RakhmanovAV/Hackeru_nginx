<?php

class controllerRole extends controller
{
    protected $templateDir = 'role'; 

    public function __construct()
    {
        parent::__construct();
    }
    public function actionRoles(){
        $roles=$this->getModel('roles')->rolesList();
        echo $this->renderLayout(['lo_content'=>$this->renderTemplate('roleList',['roles'=>$roles])]);
    }
    public function actionEditRole()
    {
        $error = '';
       
        if(app::app()->request->isForm){
            
            try {
                $this-> getModel('roles')->saveRole(app::app()->request->request);
                header('location:/role/roles');
                }catch(Exception $e){
                    $error = $e->getMessage();
                }
        }
        $id = app::app()->request->request['id'] ?? 0;
        $privileges = $this->getModel('roles')->privilegesList();
        $role = $this->getModel('roles')->roleInfoById($id);
        echo $this->renderLayout(['lo_content'=>$this->renderTemplate('roleEdit',[
            'privileges' => $privileges,
            'roles'=>$role,
            'errors'=> $error
            ])
        ]);
    }

}

