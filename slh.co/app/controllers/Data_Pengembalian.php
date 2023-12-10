<?php

class Data_Pengembalian extends Controller {

    public function index() {
        $data['title'] = 'Home';
        $data['pengembalian']=$this->model('Data_Barang_Model')->getAllPengembalianBarang();

        $this->view('templates/top');
        $this->view('templates/sideMenuAdmin');
        $this->view('data_pengembalian/index', $data);
        $this->view('templates/bottom');
    }

}