<?php
   class Cari_Barang extends Controller{
    public function index(){
        $data['barang']=$this->model('Data_Barang_Model')->cariDataBarang();

        $this->view('templates/top');
        $this->view('templates/sideMenuAdmin');
        $this->view('data_barang/index', $data);
        $this->view('templates/bottom');
    }
   }
