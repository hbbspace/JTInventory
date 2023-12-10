<?php

abstract class Admin extends Aktor {

    // public function user($userId, $unicode, $email, $username, $password, $salt, $level) {

    // }
    private $db;

    public function __construct(){
        $this->db=new Database;
    }
    public function TampilDataBarang(){
        $query="SELECT* FROM barang";
        $this->db->query($query);
        return $this->db->resultSet();
    }
    public function TampilPeminjaman(){
        $querry="SELECT m.nama_mhs AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id FROM peminjaman AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN mahasiswa AS m ON m.nim = u.unicode
        WHERE p.status = 'request'
        UNION
        SELECT d.nama_dosen AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id FROM peminjaman AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN dosen AS d ON d.nidn = u.unicode
        WHERE p.status = 'request'";
        $this->db->query($querry);

        return $this->db->resultSet();
    }
    public function TampilPengembalian(){
        $querry="SELECT m.nama_mhs AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id FROM peminjaman AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN mahasiswa AS m ON m.nim = u.unicode
        WHERE p.status = 'progress'
        UNION
        SELECT d.nama_dosen AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id FROM peminjaman AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN dosen AS d ON d.nidn = u.unicode
        WHERE p.status = 'progress'";
        $this->db->query($querry);
        return $this->db->resultSet();
    }
    public function TampilAkun(){
        
    }
    public function TampilHistory(){
        $querry="SELECT m.nama_mhs AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id, p.keterangan as keterangan FROM peminjaman AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN mahasiswa AS m ON m.nim = u.unicode
        WHERE p.status = 'done' OR p.status ='failed'
        UNION
        SELECT d.nama_dosen AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id, p.keterangan as keterangan FROM peminjaman AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN dosen AS d ON d.nidn = u.unicode
        WHERE p.status = 'done' OR p.status ='failed'";
        $this->db->query($querry);

        return $this->db->resultSet();
    }

    public function index() {
        $data['title'] = 'Home';
        $data['admin']=$this->model('Admin_model')->getAllAdmin();

        $this->view('templates/top');
        $this->view('templates/sideMenuAdmin');
        $this->view('admin/index', $data);
        $this->view('templates/bottom');
    }

    public function tambahAdmin() {
        if($this->model('Admin_Model')->tambahDataAdmin($_POST) > 0) {
            Flasher::setMessage('Berhasil','Ditambahkan','success');
            header('Location: ' . base_url . '/Admin');
            exit; 
        }else{
            Flasher::setMessage('Gagal','Ditambahkan','danger');
            header('Location: ' . base_url . '/Admin');
            exit; 

        }
    }
    public function hapusAdmin($nip) {
        if($this->model('Admin_model')->hapusDataAdmin($nip) > 0) {
            Flasher::setMessage('Berhasil','Dihapus','success');
            header('Location: ' . base_url . '/Admin');
            exit; 
        }else{
            Flasher::setMessage('Gagal','Dihapus','danger');
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