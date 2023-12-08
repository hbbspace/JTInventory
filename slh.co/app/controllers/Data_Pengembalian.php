<?php

class Data_Pengembalian extends Controller {

    public function index() {
        $data['title'] = 'Home';
        $data['pengembalian']=$this->model('Data_Pengembalian_Model')->getAllPengembalian();

        $this->view('templates/top');
        $this->view('data_pengembalian/index', $data);
        $this->view('templates/bottom');
    }

}