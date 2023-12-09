<?php

class Home extends Controller {
	public function index() {
		$data['title'] = 'Home';
		$data['level'] = 'Teknisi';
		$data['nama']= 'Habibatul Mustofa';
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