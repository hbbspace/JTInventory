<?php

class Login extends Controller {
    public function index() {
        $data['title'] = 'Halaman Login';

		$this->view('login/login', $data);
    }

    public function prosesLogin() {
        if($row = $this->model('LoginModel')->checkLogin($_POST) > 0 ) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['nama'] = $row['nama'];
                $_SESSION['session_login'] = 'sudah_login'; 

                //$this->model('LoginModel')->isLoggedIn($_SESSION['session_login']);
                
                header('location: '. base_url . '/home');
        } else {
            Flasher::set_flashdata('danger','Login gagal. Username / Password Anda Salah.');
            header('location: '. base_url . '/login');
            exit;	
        }
    }
}