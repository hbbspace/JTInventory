<?php

class Login extends Controller {
    public function index() {
        $data['title'] = 'Halaman Login';

		$this->view('login/index', $data);
    }

    public function prosesLogin() {

        $row = $this->model('Login_Model')->checkLogin($_POST);
        if($row > 0 ) {
                  $_SESSION['username'] = $row['username'];
                $_SESSION['level'] = $row['level'];
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['unicode'] = $row['unicode'];
                //$this->model('LoginModel')->isLoggedIn($_SESSION['session_login']);
                if($_SESSION['level']=='Teknisi'){
                    header('location: '. base_url . '/Admin_Side');
                }else{
                    header('location: '. base_url . '/User_Side');
                }
        } else {
            Flasher::setMessage('Login Gagal','Username/Password tidak valid.','danger');
            header('location: '. base_url .'/Login');
            exit;	
        }
        
        //cek var dump
        // $data['query'] = $this->model('Login_Model')->checkLogin($_POST);
        // $this->view('login/index', $data);
    }
}