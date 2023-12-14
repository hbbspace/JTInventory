<?php

class User_Side extends Controller {

    public function __construct()
	{	
		if($_SESSION['level'] == 'Teknisi') {
			Flasher::setMessage('Terdeteksi!','Tindakan terlarang.','danger');
			header('location: '. base_url . '/login');
			exit;
		}
	}

    public function index() {
        $data['jumlahBarang']=$this->model('User')->hitungTotalBarang();
        $data['request']=$this->model('User')->tampilRequestBarang(); 
        $data['nama']=$this->getNamaById();
        //var_dump($data['nama']);
        $this->view('templates/topUser', $data);
		$this->view('templates/sideMenuUser');
		$this->view('User_View/home/index', $data);
		$this->view('templates/bottom');
    }

    public function Rincian_Request($id){
        $data['request']=$this->model('User')->tampilRequestBarang();
        $data['rincian']=$this->model('User')->tampilRincianRequestBarang($id);
        $data['nama']=$this->getNamaById();
		$this->topBarName();
		$this->view('templates/sideMenuUser');
		$this->view('User_View/rincian/index', $data);
		$this->view('templates/bottom');
    }

    public function Rincian_Peminjaman($id){
        $data['rincian']=$this->model('User')->tampilRincianProgressBarang($id);
        $data['nama']=$this->getNamaById();
		$this->topBarName();
		$this->view('templates/sideMenuUser');
		$this->view('User_View/rincian_peminjaman/index', $data);
		$this->view('templates/bottom');
    }
    
    public function Rincian_History($id){
        $data['rincian']=$this->model('User')->tampilRincianHistoryBarang($id);
        $data['nama']=$this->getNamaById();
		$this->topBarName();
		$this->view('templates/sideMenuUser');
		$this->view('User_View/rincian_history/index', $data);
		$this->view('templates/bottom');
    }
    // Controller Fungsi Inti

    public function Data_Barang() {
        $data['title'] = 'Data Barang';
        $data['barang']=$this->model('User')->tampilSemuaBarang();

		$this->topBarName();
        $this->view('templates/sideMenuUser');
        $this->view('User_View/data_barang/index', $data);
        $this->view('templates/bottom');
    }

    public function Data_Peminjaman() {
        $data['title'] = 'Data Peminjaman';
        $data['barang']=$this->model('User')->tampilPeminjaman();

		$this->topBarName();
        $this->view('templates/sideMenuUser');
        $this->view('User_View/data_peminjaman/index', $data);
        $this->view('templates/bottom');
    }

    public function Data_Pengembalian() {
        $data['title'] = 'Data Peminjaman';
        $data['barang']=$this->model('User')->tampilPengembalian();       
		$this->topBarName();
        $this->view('templates/sideMenuUser');
        $this->view('User_View/data_pengembalian/index', $data);
        $this->view('templates/bottom');
    }

    public function History() {
        $data['title'] = 'History';
        $data['history']=$this->model('User')->tampilHistory();
		$this->topBarName();
        $this->view('templates/sideMenuUser');
        $this->view('User_View/history/index', $data);
        $this->view('templates/bottom');
    }

    public function Akun(){
        $data=$this->model('User')->tampilProfile();	 


		$this->topBarName();
		$this->view('templates/sideMenuUser');
		$this->view('User_View/akun/index', $data);
		$this->view('templates/bottom');
    }

    public function Logout() {
        $this->model('User')->Logout();
    }


    // Controller Fungsi Fitur
    public function getNamaById(){
        $data['nama'] = $this->model('User')->getNamaById($_SESSION['user_id']);
        return $data['nama'];
        
    }

    public function topBarName(){
        $data['level'] = $_SESSION['level'];
        $data['nama']=$this->getNamaById();
        return $this->view('templates/topUser', $data);
    }

    public function cariBarang(){
        $data['barang']=$this->model('User')->cariBarang();

		$this->topBarName();
        $this->view('templates/sideMenuUser');
        $this->view('User_View/data_barang/index', $data);
        $this->view('templates/bottom');
    }

    public function editAkun(){
        $data=$this->model('Admin')->editProfile();	 

		$this->topBarName();
		$this->view('templates/sideMenuUser');
		$this->view('edit_akun/index', $data);
		$this->view('templates/bottom');
    }

    public function tambahDataBarang() {
        if($this->model('User')->tambahDataPeminjamanBarang($_POST) > 0) {
            Flasher::setMessage('Berhasil','Ditambahkan','success');
            header('Location: ' . base_url . '/User_Side/Data_Barang');
            exit; 
        }else{
            Flasher::setMessage('Gagal','Ditambahkan','danger');
            header('Location: ' . base_url . '/User_Side/Data_Barang');
            exit; 

        }
    }
}