<?php

class pgsql {
    private $connection = false;
    public function __construct($config)
    {
        if ( $this -> connection === false ) {
            $this -> connection = pg_connect(
                'host=' . $config['host'] .
                ' port=' . $config['port'] .
                ' dbname=' . $config['db_name'] .
                ' user=' . $config['user'] .
                ' password=' . $config['password']
            );
        }
        
    }

    public function querySimpel($sql)
    {
        return pg_query($this->connection, $sql);
    }
    public function selectQuery($sql)
    {
        $res = pg_query($this->connection, $sql);
        $out = [];
        $current = false;
        while($current = pg_fetch_assoc($res)) {
            $out[]=$current;
        }
        return $out;
    }

    const TYPE_SELECT = 1;
    const TYPE_INSERT = 2;
    const TYPE_UPDATE = 3;
    const TYPE_DELETE = 4;

    protected $queryType = 0;
    protected $selectFields = '';
    protected $table = '';
    protected $tableAlias = 't';
    protected $condition = '';
    protected $insertFields ='';
    protected $insertValues ='';
    protected $updateData ='';

    public function select($fields= '*') {
        $this-> queryType = self::TYPE_SELECT;
        $this-> selectFields = $fields;
        return $this;
    }
    
    public function from($table) {
        $this -> table =$table;
        return $this;
        $pg->where("/");
    }

    public function where($condition, $params=[]) {
        if(!empty($params)){
            foreach($params as $alias => $value){
                $condition = str_replace($alias,"'". $this->escape($value) ."'", $condition);
            }
        }
        $this-> condition = $condition;
        return $this;
    }

    public function insert($table)
    {
        $this->table=$table;
        $this-> queryType =self::TYPE_INSERT;
        return $this;
    }

    public function insertData(array $data)
    {
        $fields = '';
        $values = '';
        foreach($data as $rowName => $value){
            $fields .= ($fields == ''  ? '' : ',') . $rowName;
            $values .= ($values == '' ? '\'' : ',\'') . $this->escape($value) . "'";
        }
        $this->insertFields = '(' . $fields . ')';
        $this->insertValues = '(' . $values . ')';
        return $this;
    }

    public function update($table)
    {
        $this->table = $table;
        $this->queryType = self::TYPE_UPDATE;
       
        return $this;
        

    }

    public function updateData($data)
    {
        foreach($data as $rowName => $value){
            $this->updateData .= ($this->updateData == '' ? '' : ',') . $rowName . "='" . $this->escape($value) . "'";
        }
         
        return $this;
    }

    public function escape($data) {
        return pg_escape_string($data);
    }
    
    public function query(){
        $sql=$this->getText();
        if($this->queryType == self::TYPE_SELECT){
            return $this->selectQuery($sql);
                }else{
                    return $this->querySimpel($sql);
                }
    }

        public function  getText(){
        $sql = '';
        switch ($this->queryType) {
            case self::TYPE_SELECT:
                $sql = $this->getSelectText();
                break;
            case self::TYPE_INSERT:
                $sql = $this->getInsertText();
                break;
            case self::TYPE_UPDATE:
                $sql = $this->getUpdateText();
                break;
            case self::TYPE_DELETE:
                $sql = $this->getDeleteText();
                break;
        }
       
        return $sql;
    }

    protected function getInsertText()
    {
        return 'INSERT INTO ' . $this -> table .  ' ' . $this->insertFields . 'VALUES ' . $this->insertValues;
        
    }

    protected function getUpdateText() 
    {
        $sql = 'UPDATE ' . $this->table . ' SET ' . $this->updateData;
        if (!empty($this->condition)) {
            $sql .= 'WHERE ' . $this->condition;
        }
        
        return $sql;
    }

    protected function getSelectText()
    {
        $sql = 'SELECT ' . $this->selectFields . ' FROM ' . $this->table;
        
        
        if (!empty($this->condition)) {
            $sql .= ' WHERE ' . $this->condition;
        }
        
        return $sql; 
    }

    
    
}
