<?php

class Data_Pengembalian extends Controller {

    public function index() {
        $data['title'] = 'Home';
        $data['admin']=$this->model('Data_Peminjaman_Model')->getAllPengembalian();

        $this->view('templates/header');
		$this->view('templates/menu');
        $this->view('data_peminjaman/index', $data);
        $this->view('templates/footer');
    }

}