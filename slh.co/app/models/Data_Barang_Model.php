<?php

class Data_Barang_Model {
    private $table='barang';
    private $db;

    public function __construct(){
        $this->db=new Database;
    }
    public function getAllBarang(){
        $this->db->query('SELECT * FROM '.$this->table);
        return $this->db->resultSet();
    }

}