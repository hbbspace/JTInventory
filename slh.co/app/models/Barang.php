<?php

require_once 'Create_Delete.php';
class Barang implements Create_Delete{
    private $idBarang;
    private $namaBarang;
    private $maintener;
    private $qty;

    public function __construct($idBarang, $namaBarang, $maintener, $qty) {
        $this->idBarang = $idBarang;
        $this->namaBarang = $namaBarang;
        $this->maintener = $maintener;
        $this->qty = $qty;
    }

    // Setter
    public function setIdBarang($input) {
        $this->idBarang = $input;
    }
    
    public function setNamaBarang($input) {
        $this->namaBarang = $input;
    }

    public function setMaintener($input) {
        $this->maintener = $input;
    }

    public function setQty($input) {
        $this->qty = $input;
    }

    // Getter
    public function getIdBarang() {
        return $this->idBarang;
    }

    public function getNamaBarang() {
        return $this->namaBarang;
    }
    
    public function getMaintener() {
        return $this->maintener;
    }
    
    public function getQty() {
        return $this->qty;
    }

    // fungsi tambahan
    public function tambah($data){
        $this->__construct($data[1], $data[2], $data[3], $data[4]);
    }

    public function hapus($id_barang) {
        $helper = new Helper();
        $result = $helper->hapusDataBarang($id_barang);
        return $result;
    }
}