<?php

class controllerUser extends controller
{
    //protected $layout='shop';
    protected $templateDir = 'user';

    public function actionRegister()
    {
        $db = new pgsql (app::app()->db['local']);
        $users = $db->select('*')->from('users')->where('sub_token !=\'\'')->query();
        foreach($users as $user){
            switch($user['status']){
                case 1 :
                    echo $user['status'] . ' <a href="/user/authorization?token=' . $user['sub_token'] . '">' .$user['email'] . '</a><br />';
                    break;
                case 2 :
                    echo $user['status'] . ' <a href="/user/restore?token=' . $user['sub_token'] . '">' .$user['email'] . '</a><br />';
                    break;
            }
            
        }
    }
    public function actionRegistration()
    {
        $data =app::app()->request->request;
        //app::print_d(app::app()->request);
        //die();
        if(app::app()->request->isForm){
            try{
                app::app()->user->registration(app::app()->request->request);
            } catch(Exception $e){
                $data['error'] = $e->getMessage();
           }
        }
        echo $this->renderLayout([
             'lo_content'=>$this->renderTemplate('registration', $data)
        ]);
    }
                           
    public function actionAuthorization()
    {
        $data =app::app()->request->request;
        if(app::app()->request->isForm){
            try{                         
               $user = app::app()->user->authenticate(app::app()->request->request);
                    app::app()->user->authorization($user);
                                     
            }catch(Exception $e){
                $data['error'] = $e->getMessage();
           }
            }
        echo $this->renderLayout([
            'lo_content'=>$this->renderTemplate('authorization', $data)
       ]);
    }

    public function actionReset()
    {
        $data =app::app()->request->request;
        if(app::app()->request->isForm){
            try{                         
               app::app()->user->reset(app::app()->request->request['email'] ?? false);
                header('location:/user/resetSuccess?email=' .app::app()->request->request['email'] );
            }catch(Exception $e){
                $data['error'] = $e->getMessage();
           }
            }
        echo $this->renderLayout([
            'lo_content'=>$this->renderTemplate('reset')
       ]);
    }
    public function actionResetSuccess()
    {
        
        echo $this->renderLayout([
            'lo_content'=>$this->renderTemplate('resetSuccess', ['email'=>app::app()->request->request['email']])
            ]);
    }

    public function actionRestore()
    {
        $data =app::app()->request->request;
        if(app::app()->request->isForm){
            try{                         
               app::app()->user->restore($data);
                header('location:/user/authorization');
            }catch(Exception $e){
                $data['error'] = $e->getMessage();
           }
            }
            app::print_d($data);
        echo $this->renderLayout([
            'lo_content'=>$this->renderTemplate('restore', ['token'=>$data['token']])
        ]);
    }

    public function actionLogout()
    {
        app::app()->user->logout();
        header('location:/user/authorization');
        
    }





}