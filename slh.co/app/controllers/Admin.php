<?php

class Admin extends Controller {

    // public function user($userId, $unicode, $email, $username, $password, $salt, $level) {

    // }

    public function index() {
        $data['title'] = 'Home';
		$data['level'] = $_SESSION['level'];
        $data['nama']=$this->getNamaById();		 
        $data['jumlahBarang']=$this->model('Data_Barang_Model')->hitungTotalBarang();
		$data['jumlahBarangDipinjam']=$this->model('Data_Barang_Model')->totalBarangDipinjam();
		$data['peminjaman']=$this->model('Data_Peminjaman_Model')->getAllPeminjaman();

		$this->view('templates/top', $data);
		$this->view('templates/sideMenuAdmin');
		$this->view('home/index', $data);
		$this->view('templates/bottom');
    }

    public function tambahAdmin() {
        if($this->model('Admin_Model')->tambahDataAdmin($_POST) > 0) {
            Flasher::setMessage('Berhasil','Ditambahkan','success');
            header('Location: ' . base_url . '/Admin/Akun');
            exit; 
        }else{
            Flasher::setMessage('Gagal','Ditambahkan','danger');
            header('Location: ' . base_url . '/Admin/Akun');
            exit; 

        }
    }
    public function hapusAdmin($nip) {
        if($this->model('Admin_model')->hapusDataAdmin($nip) > 0) {
            Flasher::setMessage('Berhasil','Dihapus','success');
            header('Location: ' . base_url . '/Admin/Akun');
            exit; 
        }else{
            Flasher::setMessage('Gagal','Dihapus','danger'); 
            header('Location: ' . base_url . '/Admin/Akun');
            exit; 
        }
    }

    public function Data_Barang() {
        $data['title'] = 'Data Barang';
        $data['barang']=$this->model('Admin_model')->getAllBarang();

		$this->topBarName();
        $this->view('templates/sideMenuAdmin');
        $this->view('data_barang/index', $data);
        $this->view('templates/bottom');
    }

    public function Data_Peminjaman() {
        $data['title'] = 'Data Peminjaman';
        $data['peminjaman']=$this->model('Admin_model')->getAllPeminjaman();

		$this->topBarName();
        $this->view('templates/sideMenuAdmin');
        $this->view('data_peminjaman/index', $data);
        $this->view('templates/bottom');
    }

    public function Data_Pengembalian() {
        $data['title'] = 'Data Peminjaman';
        $data['pengembalian']=$this->model('Data_Barang_Model')->getAllPengembalianBarang();
        
		$this->topBarName();
        $this->view('templates/sideMenuAdmin');
        $this->view('data_pengembalian/index', $data);
        $this->view('templates/bottom');
    }

    public function History() {
        $data['title'] = 'History';
        $data['history']=$this->model('Admin_model')->getAllHistory();
        // var_dump($data['history']);
		$this->topBarName();
        $this->view('templates/sideMenuAdmin');
        $this->view('history/index', $data);
        $this->view('templates/bottom');
    }

    public function Akun() {
        $data['title'] = 'Profile Akun';
        $data['admin']=$this->model('Admin_model')->getAllAdmin();

		$this->topBarName();
        $this->view('templates/sideMenuAdmin');
        $this->view('admin/index', $data);
        $this->view('templates/bottom');
    }

    public function Logout() {
        //$data['admin']=$this->model('Admin_model')->getAllAdmin();

        $data['title'] = 'Halaman Login';
		$this->view('login/index', $data);
    }

    public function getNamaById(){
        $data['nama']=$this->model('Admin_Model')->getNamaById($_SESSION['user_id']);
        return $data['nama'];
    }


    public function Home() {
		$data['title'] = 'Home';	 
        $data['jumlahBarang']=$this->model('Data_Barang_Model')->hitungTotalBarang();
		$data['jumlahBarangDipinjam']=$this->model('Data_Barang_Model')->totalBarangDipinjam();
		$data['peminjaman']=$this->model('Data_Peminjaman_Model')->getAllPeminjaman();

		$this->topBarName();
		$this->view('templates/sideMenuAdmin');
		$this->view('home/index', $data);
		$this->view('templates/bottom');
	}

    public function topBarName(){
        $data['level'] = $_SESSION['level'];
        $data['nama']=$this->getNamaById();		 
        return 	$this->view('templates/top', $data);
    }

    public function cariBarang(){
        $data['barang']=$this->model('Data_Barang_Model')->cariDataBarang();

		$this->topBarName();
        $this->view('templates/sideMenuAdmin');
        $this->view('data_barang/index', $data);
        $this->view('templates/bottom');
    }

    public function tampilprofile(){
        $data=$this->model('Admin_Model')->getRincianProfile();	 


		$this->topBarName();
		$this->view('templates/sideMenuAdmin');
		$this->view('akun/index', $data);
		$this->view('templates/bottom');
    }

    public function editAkun(){
        $data=$this->model('Admin_Model')->getRincianProfile();	 

		$this->topBarName();
		$this->view('templates/sideMenuAdmin');
		$this->view('edit_akun/index', $data);
		$this->view('templates/bottom');
    }
}