<?php

class Data_Peminjaman extends Controller {
    public function index() {
        $data['title'] = 'Home';
        $data['peminjaman']=$this->model('Data_Peminjaman_Model')->getAllPeminjaman();

        $this->view('templates/top');
        $this->view('templates/sideMenuAdmin');
        $this->view('data_peminjaman/index', $data);
        $this->view('templates/bottom');
    }
}