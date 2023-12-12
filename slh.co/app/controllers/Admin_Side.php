<?php

class Admin_Side extends Controller {

    public function __construct()
	{	
		if($_SESSION['level'] != 'Teknisi') {
			Flasher::setMessage('Terdeteksi!','Tindakan terlarang.','danger');
			header('location: '. base_url . '/login');
			exit;
		}
	}

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

    // Controller Fungsi Inti
    public function Data_Admin() {
        $data['title'] = 'Profile Akun';
        $data['admin']=$this->model('Admin')->tampilSemuaAdmin();

		$this->topBarName();
        $this->view('templates/sideMenuAdmin');
        $this->view('admin/index', $data);
        $this->view('templates/bottom');
    }

    public function Data_Barang() {
        $data['title'] = 'Data Barang';
        $data['barang']=$this->model('Admin')->tampilSemuaBarang();

		$this->topBarName();
        $this->view('templates/sideMenuAdmin');
        $this->view('data_barang/index', $data);
        $this->view('templates/bottom');
    }

    public function Data_Peminjaman() {
        $data['title'] = 'Data Peminjaman';
        $data['peminjaman']=$this->model('Admin')->tampilSemuaPeminjaman();

		$this->topBarName();
        $this->view('templates/sideMenuAdmin');
        $this->view('data_peminjaman/index', $data);
        $this->view('templates/bottom');
    }

    public function Data_Pengembalian() {
        $data['title'] = 'Data Peminjaman';
        $data['pengembalian']=$this->model('Admin')->tampilSemuaPengembalian();
        
		$this->topBarName();
        $this->view('templates/sideMenuAdmin');
        $this->view('data_pengembalian/index', $data);
        $this->view('templates/bottom');
    }

    public function History() {
        $data['title'] = 'History';
        $data['history']=$this->model('Admin')->tampilHistory();
		$this->topBarName();
        $this->view('templates/sideMenuAdmin');
        $this->view('history/index', $data);
        $this->view('templates/bottom');
    }

    public function Akun(){
        $data=$this->model('Admin')->tampilProfile();	 


		$this->topBarName();
		$this->view('templates/sideMenuAdmin');
		$this->view('akun/index', $data);
		$this->view('templates/bottom');
    }

    public function Logout() {
        session_destroy();
        header("Location:http://localhost/dasarWeb/JTInventory/slh.co/public/");
    }

    // Controller Fungsi Fitur
    public function tambahBarang() {
        if($this->model('Admin')->tambahDataBarang($_POST) > 0) {
            Flasher::setMessage('Berhasil','Ditambahkan','success');
            header('Location: ' . base_url . '/Admin_Side/Data_Barang');
            exit; 
        }else{
            Flasher::setMessage('Gagal','Ditambahkan','danger');
            header('Location: ' . base_url . '/Admin_Side/Data_Barang');
            exit; 
        }
    }

    public function hapusBarang($id_barang) {
        if($this->model('Admin')->hapusDataBarang($id_barang) > 0) {
            Flasher::setMessage('Berhasil','Dihapus','success');
            header('Location: ' . base_url . '/Admin_Side/Data_Barang');
            exit; 
        }else{
            Flasher::setMessage('Gagal','Dihapus','danger');
            header('Location: ' . base_url . '/Admin_Side/Data_Barang');
            exit; 
        }
    }

    public function getNamaById(){
        $data['nama']=$this->model('Admin')->getNamaById($_SESSION['user_id']);
        return $data['nama'];
    }

    public function topBarName(){
        $data['level'] = $_SESSION['level'];
        $data['nama']=$this->getNamaById();		 
        return 	$this->view('templates/top', $data);
    }

    public function cariBarang(){
        $data['barang']=$this->model('Admin')->cariBarang();

		$this->topBarName();
        $this->view('templates/sideMenuAdmin');
        $this->view('data_barang/index', $data);
        $this->view('templates/bottom');
    }

    public function editAkun(){
        $data=$this->model('Admin')->editProfile();	 

		$this->topBarName();
		$this->view('templates/sideMenuAdmin');
		$this->view('edit_akun/index', $data);
		$this->view('templates/bottom');
    }
}