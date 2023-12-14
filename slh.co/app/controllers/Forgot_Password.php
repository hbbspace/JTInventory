<?php

class Forgot_Password extends Controller {

    public function index() {
        $data['title'] = 'SLH.CO';

        $this->view('User_View/forgot_password/index', $data);
    }

    public function gantiPassword() {
        if($this->model('Helper')->gantiPassword($_POST) > 0) {
            Flasher::setMessage('Berhasil','Password berubah.','success');
            header('Location: ' . base_url . '/Login');
            exit; 
        }else{
            Flasher::setMessage('Gagal','Username/Email tidak ada di Database.','danger');
            header('Location: ' . base_url . '/Forgot_Password');
            exit; 
        }
    }
}