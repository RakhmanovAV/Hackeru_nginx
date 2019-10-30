<?php
class test extends model 
{
    public function first()
    {
        $this->db->querySimpel("INSERT INTO users (email, password) VALUES ('test@mail.test', '1234')");
        $users = $this -> db -> selectQuery('select * from users');
        app::print_d($users);

    }
}