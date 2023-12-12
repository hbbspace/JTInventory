<?php

class Login extends Controller {
    public function index() {
        $data['title'] = 'Halaman Login';

		$this->view('login/index', $data);
    }

    public function prosesLogin() {

        $row = $this->model('Helper')->checkLogin();        
        var_dump($row);
        if($row > 0 ) {

            if($row['level'] == 'Teknisi') {
                $row = $this->model('Admin')->login();
            } else if ($row['level'] == 'Dosen') {
                $row = $this->model('User')->login();
            } else {
                $row = $this->model('User')->login();
            }

            $_SESSION['username'] = $row['username'];
            $_SESSION['level'] = $row['level'];
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['unicode'] = $row['unicode'];
                
            if($_SESSION['level'] == 'Teknisi'){
                header('location: '. base_url . '/Admin_Side');
            }else {
                header('location: '. base_url . '/User_Side');
            }
        } else {
            Flasher::setMessage('Login Gagal','Username/Password tidak valid.','danger');
            header('location: '. base_url .'/Login');
            exit;	
        }
    }
}