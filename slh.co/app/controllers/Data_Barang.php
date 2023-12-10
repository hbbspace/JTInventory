<?php

class Data_Barang extends Controller{
    public function index() {
        $data['title'] = 'List_Barang';
        $data['barang']=$this->model('Data_Barang_Model')->getAllBarang();

        $this->view('templates/top');
        $this->view('templates/sideMenuAdmin');
        $this->view('data_barang/index', $data);
        $this->view('templates/bottom');
    }

    
    public function tambahBarang() {
        if($this->model('Data_Barang_Model')->tambahDataBarang($_POST) > 0) {
            Flasher::setMessage('Berhasil','Ditambahkan','success');
            header('Location: ' . base_url . '/Data_Barang');
            exit; 
        }else{
            Flasher::setMessage('Gagal','Ditambahkan','danger');
            header('Location: ' . base_url . '/Data_Barang');
            exit; 
        }
    }

    public function hapusBarang($id_barang) {
        if($this->model('Data_Barang_Model')->hapusDataBarang($id_barang) > 0) {
            Flasher::setMessage('Berhasil','Dihapus','success');
            header('Location: ' . base_url . '/Data_Barang');
            exit; 
        }else{
            Flasher::setMessage('Gagal','Dihapus','danger');
            header('Location: ' . base_url . '/Data_Barang');
            exit; 
        }
    }

    // public function cariBarang(){
    //     $data['barang']=$this->model('Data_Barang_Model')->cariDataBarang();

    //     $this->view('templates/top');
    //     $this->view('templates/sideMenuAdmin');
    //     $this->view('data_barang/index', $data);
    //     $this->view('templates/bottom');
    // }

    // public function tampilDataPeminjaman() {
    //     $data['title'] = 'Home';
    //     $data['peminjaman']=$this->model('Data_Barang_Model')->getAllPeminjamanBarang();

    //     $this->view('templates/top');
    //     $this->view('templates/sideMenuAdmin');
    //     $this->view('data_peminjaman/index', $data);
    //     $this->view('templates/bottom');
    // }
}