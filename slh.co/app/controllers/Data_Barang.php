<?php

class Data_Barang extends Controller{
    public function index() {
        $data['title'] = 'Home';
        $data['barang']=$this->model('Data_Barang_Model')->getAllBarang();

        $this->view('templates/header');
		$this->view('templates/menu');
        $this->view('list_barang/index', $data);
        $this->view('templates/footer');
    }
}