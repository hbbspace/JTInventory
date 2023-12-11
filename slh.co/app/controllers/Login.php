<?php

class Login extends Controller {
    public function index() {
        $data['title'] = 'Halaman Login';

		$this->view('login/index', $data);
    }

    public function prosesLogin() {

        // $username = $_POST['username'];
        // $password = $_POST['password'];

        // $data['login'] = $this->model('Login_Model')->checkLogin($username, $password);

        // session_start();
        // if($data['login'] == null) {
        //     header('location: '. base_url . '/home');
        // } else {
        //     foreach($data['login'] as $row) :
        //         $_SESSION['nama'] = $row['nama'];
        //         header('location: '. base_url);
        //     endforeach;
        //     Flasher::set_flashdata('danger','Login gagal. Username / Password Anda Salah.');
        // }
        $row = $this->model('Login_Model')->checkLogin($_POST);
        if($row > 0 ) {
                $_SESSION['username'] = $row['username'];
                //$_SESSION['nama'] = $row['nama'];
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['unicode'] = $row['unicode'];
                //$this->model('LoginModel')->isLoggedIn($_SESSION['session_login']);
                header('location: '. base_url . '/Home');
        } else {
            Flasher::setMessage('Tidak Ditemukan','Username/Password','danger');
            header('location: '. base_url .'/Login');
            exit;	
        }
        
        //cek var dump
        // $data['query'] = $this->model('Login_Model')->checkLogin($_POST);
        // $this->view('login/index', $data);
    }
}