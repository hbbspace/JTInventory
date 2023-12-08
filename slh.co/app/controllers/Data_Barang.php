<?php

class Data_Barang extends Controller{
    public function index() {
        $data['title'] = 'List_Barang';
        $data['barang']=$this->model('Data_Barang_Model')->getAllBarang();

        $this->view('templates/top');
        $this->view('templates/sideMenuAdmin');
        $this->view('data_barang/index', $data);
        $this->view('templates/bottom');
    }
    
    public function tambahBarang() {
        if($this->model('Data_Barang_Model')->tambahDataBarang($_POST) > 0) {
            header('Location: ' . base_url . '/data_barang');
            exit; 
        }
    }
    public function hapusBarang($id_barang) {
        if($this->model('Data_Barang_Model')->hapusDataBarang($id_barang) > 0) {
            header('Location: ' . base_url . '/data_barang');
            exit;
        }
    }
}