<?php

class Admin_model {
    private $table='teknisi';
    private $db;

    public function __construct(){
        $this->db=new Database;
    }
    public function getAlladmin(){
        $this->db->query('SELECT * FROM '.$this->table);
        return $this->db->resultSet();
    }



    
}