<?php

class Admin extends Controller {

    // public function user($userId, $unicode, $email, $username, $password, $salt, $level) {

    // }

    public function index() {
        $data['title'] = 'Home';
        $data['admin']=$this->model('Admin_model')->getAllAdmin();

        $this->view('templates/top');
        $this->view('admin/index', $data);
        $this->view('templates/bottom');
    }

    public function tambahAdmin() {
        if($this->model('Admin_Model')->tambahDataAdmin($_POST) > 0) {
            Flasher::setMessage('Berhasil','Ditambahkan','succes');
            header('Location: ' . base_url . '/Admin');
            exit; 
        }else{
            Flasher::setMessage('Gagal','Ditambahkan','danger');
            header('Location: ' . base_url . '/Admin');
            exit; 

        }
    }

    // public function Data_Barang() {
    //     $data['title'] = 'Data Barang';
    //     $data['barang']=$this->model('Admin_model')->getAllBarang();

    //     $this->view('templates/top');
    //     $this->view('list_barang/index', $data);
    //     $this->view('templates/bottom');
    // }

    // public function Data_Peminjaman() {
    //     $data['title'] = 'Data Peminjaman';
    //     $data['peminjaman']=$this->model('Admin_model')->getAllPeminjaman();

    //     $this->view('templates/top');
    //     $this->view('data_peminjaman/index', $data);
    //     $this->view('templates/bottom');
    // }

    // public function Data_Pengembalian() {
    //     $data['title'] = 'Data Peminjaman';
    //     $data['admin']=$this->model('Admin_model')->getAllPeminjaman();

    //     $this->view('templates/top');
    //     $this->view('data_pengembalian/index', $data);
    //     $this->view('templates/bottom');
    // }

    // public function History() {
    //     $data['title'] = 'History';
    //     $data['admin']=$this->model('Admin_model')->getAllAdmin();

    //     $this->view('templates/top');
    //     $this->view('history/index', $data);
    //     $this->view('templates/bottom');
    // }

    // public function Akun() {
    //     $data['title'] = 'Akun';
    //     $data['admin']=$this->model('Admin_model')->getAllAdmin();

    //     $this->view('templates/top');
    //     $this->view('akun/index', $data);
    //     $this->view('templates/bottom');
    // }

    // public function Logout() {
    //     //$data['admin']=$this->model('Admin_model')->getAllAdmin();

    //     $data['title'] = 'Halaman Login';

	// 	$this->view('login/index', $data);
    // }
}