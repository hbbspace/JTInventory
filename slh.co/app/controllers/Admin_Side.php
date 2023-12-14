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
        $data['jumlahBarang']=$this->model('Admin')->hitungTotalBarang();
		$data['jumlahBarangDipinjam']=$this->model('Admin')->totalBarangDipinjam();
        $data['jumlahUser']=$this->model('Admin')->hitungTotalUser();
		$data['peminjaman']=$this->model('Admin')->tampilSemuaRequest();

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

    public function editAkun(){
        $data=$this->model('Admin')->tampilProfile();	 

		$this->topBarName();
		$this->view('templates/sideMenuAdmin');
		$this->view('edit/index', $data);
		$this->view('templates/bottom');

        if ($this->model('Admin')->editProfile($_POST)){
            Flasher::setMessage('Berhasil','Diubah','success');
            header('Location: ' . base_url . '/Admin_Side/Akun');
            exit;
        } else{
            Flasher::setMessage('Gagal','Diubah','danger');
            header('Location: ' . base_url . '/Admin_Side/Akun');
            exit; 
        }
    }

    public function hapusAkun() {
        if ($this->model('Admin')->hapusAkun($_SESSION['user_id']) > 0){
            Flasher::setMessage('Berhasil','Akun dihapus','success');
            header('Location: ' . base_url);
            exit;
        } else{
            Flasher::setMessage('Gagal','Akun tidak dihapus','danger');
            header('Location: ' . base_url . '/Admin_Side/Akun');
            exit; 
        }
    }

    public function Logout() {
        $this->model('Admin')->Logout();
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

    public function Rincian_Request($id){
        $data['rincian']=$this->model('Admin')->tampilRincianRequestBarang($id);
		$this->topBarName();
		$this->view('templates/sideMenuAdmin');
		$this->view('rincian/index', $data);
		$this->view('templates/bottom');
    }

    public function Rincian_Peminjaman($id){
        $data['rincian']=$this->model('Admin')->tampilDataBarangProgress($id);
		$this->topBarName();
		$this->view('templates/sideMenuAdmin');
		$this->view('data_peminjaman_rincian/index', $data);
		$this->view('templates/bottom');
    }

    public function Rincian_Pengembalian($id){
        $data['rincian']=$this->model('Admin')->tampilRincianBarangReturn($id);
		$this->topBarName();
		$this->view('templates/sideMenuAdmin');
		$this->view('data_pengembalian_rincian/index', $data);
		$this->view('templates/bottom');
    }

    public function Data_Request(){
        $data['title'] = 'Data Peminjaman';
        $data['request']=$this->model('Admin')->tampilSemuaRequest();

		$this->topBarName();
        $this->view('templates/sideMenuAdmin');
        $this->view('data_request/index', $data);
        $this->view('templates/bottom');
    }
}