<?php

class Home extends Controller {
	// public function __construct()
	// {	
	// 	if($_SESSION['session_login'] != 'sudah_login') {
	// 		Flasher::setMessage('Login','Tidak ditemukan.','danger');
	// 		header('location: '. base_url . '/login');
	// 		exit;
	// 	}
	// }
	public function index() {
		$data['title'] = 'Home';
		$data['level'] = $_SESSION['level'];
		if($_SESSION['nama']!=null){
			$data['nama']= $_SESSION['nama'];
		}else{
			$data['nama']= "habib";
		}
		$data['jumlahBarang']=$this->model('Data_Barang_Model')->hitungTotalBarang();
		$data['jumlahBarangDipinjam']=$this->model('Data_Barang_Model')->totalBarangDipinjam();
		$data['peminjaman']=$this->model('Data_Peminjaman_Model')->getAllPeminjaman();

		//$data['nama'] = $this->model('User_model')->getUser();

		$this->view('templates/top', $data);
		$this->view('templates/sideMenuAdmin');
		$this->view('home/index', $data);
		$this->view('templates/bottom');
	}
}