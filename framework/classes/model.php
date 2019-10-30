<?php
abstract class model 
{
    protected $db = false;

    public function __construct()
    {
        if($this->db === false ){
            $this->db = new pgsql(app::app()->db['local']);
        }
//app::print_d($this->db);
    }
}