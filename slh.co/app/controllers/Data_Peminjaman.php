<?php

class Data_Peminjaman {
    public function index() {
        $data['title'] = 'Home';
        $data['admin']=$this->model('Data_Peminjaman_Model')->getAllPeminjaman();

        $this->view('templates/top');
        $this->view('data_peminjaman/index', $data);
        $this->view('templates/bottom');
    }
}