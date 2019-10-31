<?php
session_start();
class user 
{
    protected $db = false;
    public $isUser = false;
    
    public function __construct()
    {
        $this->db = new pgsql (app::app()->db['local']);
        if(!isset($this->id)){
            if(isset($_COOKIE['token'])){
                $user = $this->db->
                select('id, email, role_id, is_admin, reg_date, status')->
                from('users')->where('token=:token', [':token'=>$_COOKIE['token']])->
                query();
                $user=reset($user);
                if(empty($user)){
                    setcookie('token', '', time()-1, '/');
                }else{
                    foreach($user as $key => $value){
                        $this->$key = $value;
                    }
                }
            }
        }
        if(isset($_COOKIE['token'])){
        setcookie('token', $_COOKIE['token'], time()+365*86400, '/', '', false, true);
        }
        if(isset($this->id)){
                $this->isUser = true;
                }
    }
    
    public function __get($name)
    {
        return $_SESSION[$name] ?? false;
    }

    public function __set($name, $value)
    {
        if(is_array($value)){
            $_SESSION[$name]=array_merge((array) ($_SESSION['name'] ?? []), $value);
        }else{
        $_SESSION[$name]=$value;
        }
    }

    public function __isset($name)
    {
        return isset($_SESSION[$name]);
    }

    public function __unset($name)
    {
        unset($_SESSION[$name]);
    }
    public function restore($data)
    {
        if(empty($data['password']))
        {
            throw new Exception('Password is empty');
        }
        if(empty($data['repassword']))
        {
            throw new Exception('Password confirmation is empty');
        }
        if($data['password'] != $data['repassword'])
        {
            throw new Exception('Password confirmation is fail');
        }
        if(empty($data['sub_token'])){
            throw new Exception('Restore token is fail');
        }
        $user = $this->db->select('*')->from('users')->where('sub_token=:sub_token', [':sub_token'=>$data['sub_token']])->query();
        if(empty($user))
        {
            throw new Exception('Restore token is fail');
        }
        $user = reset($user);
        
        $salt = md5(time()+random_int(0, PHP_INT_MAX));
        $password=sha1($data['password'] . $salt);
        $this->db->update('users')->
        updateData(['sub_token'=>'', 'status'=>0, 'password'=> $password, 'salt' => $salt])->
        where('id=:id', [':id'=>$user['id']])->query();
    }
    public function reset($email)
    {
        if(!$email){
            throw new Exception('Адрес не верен');
        }
        $user = $this->db->select('id')->from('users')->where('email=:email',[':email'=>$email])->query();
       
        if(empty($user)){
            throw new Exception('Пользователь с'. $email .'не зарегистрирован');
        }
        $user = reset($user);
        
        $subtoken = sha1(time()+random_int(0, PHP_INT_MAX));
        $this->db->update('users')->updateData(['sub_token' =>$subtoken, 'status' =>2, 'token' => ''])->where('id=:id', [':id'=>$user['id']])->query();
        $_SESSION = [];
        setcookie('token', '',time()-1, '/');
    }

    public function registration($user)
    {
        if ($user['password'] != $user['repassword']){
            throw new Exception('Пароли не совпадают');
        }
        $check = $this->db->select('id')->from('users')->where('email=:email',[':email'=>$user['email']])->query();
        //app::print_d($user); 
        if(!empty($check)){
            throw new Exception('Данный E-mail уже зарегистрирован');
        }
        unset($user['repassword']);
        unset($user['id']);
        ;
        $salt = md5(time()+random_int(0, PHP_INT_MAX));
        $user['password'] = sha1($user['password'] . $salt);
        $user['salt'] = $salt;
        $user['reg_date'] = time(); 
        $user['status'] = 1;

        $subtoken = sha1(time()+random_int(0, PHP_INT_MAX));
        
        $user['sub_token'] = $subtoken;
        //app::print_d($user);
        $this->db->insert('users')->insertData($user)->query();
        header('location:/user/register');
        //$link = 'http://localhost/user/autorization?token=' . $subtoken;
    }
    
    public function authenticate($user)
    {
        $checkUser = $this->db->select('*')->from('users')->where('email=:email',[':email'=>$user['email']])->query();
        //app::print_d($checkUser); 
        //app::print_d($user);
        if(empty( $checkUser)){
            throw new Exception('E-mail' .$user['email'] .'не зарегистрирован');
        }
        $checkUser = reset($checkUser);
        $hach=sha1($user['password'] . $checkUser['salt']);
        if($hach != $checkUser['password']){
            throw new Exception('Пароль не верен');
        }
        if($checkUser['status'] == 1){
            if(!isset($user['sub_token']) || $user['sub_token'] != $checkUser['sub_token']){
                throw new Exception('Не верные данные');
            }
            $this->db->update('users')->updateData(['sub_token'=>'','status'=>0])->where('id=:id', [':id'=>$checkUser['id']])->query();
            app::print_d($checkUser['id']); 
        }elseif($checkUser['status'] == 2){
            throw new Exception('Пароль был сброшен');
        }
        unset($checkUser['password'], $checkUser['salt'], $checkUser['token'], $checkUser['sub_token']);
        return $checkUser;
    }

    public function authorization($user)
    {
        for(;;){
            $token = sha1(time() . random_int(0, PHP_INT_MAX));
            $check = $this->db->select('id')->from('users')->where('token=:token', [':token'=>$token])->query();
            if(empty($check)){
                break;
            } 
        }
            setcookie('token', $token, time()+365*86400, '/', '', false, true);
            $this->db->update('users')->updateData(['token'=>$token])->where('id=:id', [':id'=> $user['id']])->query();
            foreach($user as $key=>$value){
                $this->$key=$value;
            }
            $this->isUser= true;
            header('location:/');
    }

    public function logout()
    {
    
       $this->db->update('users')->updateData(['token'=>''])->where('id=:id', [':id'=>$this->id])->query(); 
       $_SESSION = [];
       setcookie('token', '',time()-1, '/');
    }

    public function chekAdmin()
    {
        
    }


}