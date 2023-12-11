<?php

class Register extends Controller {
    public function index() {
        $data['title'] = 'Register';

        $this->view('register/index', $data);
    }

    public function userRegister() {
        if($this->model('Register_Model')->tambahDataUser($_POST) > 0) {
            Flasher::setMessage('Berhasil','Ditambahkan','success');
            header('Location: ' . base_url . '/Login');
            exit; 
        }else{
            Flasher::setMessage('Gagal','Ditambahkan','danger');
            header('Location: ' . base_url . '/Register');
            exit; 

        }
    }
}