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
        $data['jumlahBarang']=$this->model($_SESSION['level'])->hitungTotalBarang();
        $data['request']=$this->model($_SESSION['level'])->tampilRequestBarang(); 
        $data['dipinjam']=$this->model($_SESSION['level'])->hitungBarangDipinjamForUser(); 
        $data['nama']=$this->getNamaById();
        //var_dump($data['nama']);
        $this->view('templates/topUser', $data);
		$this->view('templates/sideMenuUser');
		$this->view('User_View/home/index', $data);
		$this->view('templates/bottom');
    }

    public function Rincian_Request($id){
        $status='request';
        $data['request']=$this->model($_SESSION['level'])->tampilRequestBarang();
        $data['rincian']=$this->model($_SESSION['level'])->tampilRincianRequestBarang($id,$status);
        $data['nama']=$this->getNamaById();
		$this->topBarName();
		$this->view('templates/sideMenuUser');
		$this->view('User_View/rincian/index', $data);
		$this->view('templates/bottom');
    }
    
    public function Rincian_Return($id){
        $status='return';
        $data['request']=$this->model($_SESSION['level'])->tampilRequestBarang();
        $data['rincian']=$this->model($_SESSION['level'])->tampilRincianReturnBarang($id,$status);
        $data['nama']=$this->getNamaById();
		$this->topBarName();
		$this->view('templates/sideMenuUser');
		$this->view('User_View/rincian_return/index', $data);
		$this->view('templates/bottom');
    }
    public function Rincian_Peminjaman($id){
        $status='progress';
        $data['rincian']=$this->model($_SESSION['level'])->tampilRincianProgressBarang($id,$status);
        $data['nama']=$this->getNamaById();
		$this->topBarName();
		$this->view('templates/sideMenuUser');
		$this->view('User_View/rincian_peminjaman/index', $data);
		$this->view('templates/bottom');
    }
    
    public function Rincian_History($id){
        $data['rincian']=$this->model($_SESSION['level'])->tampilRincianHistoryBarang($id);
        $data['nama']=$this->getNamaById();
		$this->topBarName();
		$this->view('templates/sideMenuUser');
		$this->view('User_View/rincian_history/index', $data);
		$this->view('templates/bottom');
    }
    
    // Controller Fungsi Inti
    public function Register() {
        if($this->model('Helper')->tambahDataUser($_POST) > 0) {
            Flasher::setMessage('Berhasil','Ditambahkan','success');
            header('Location: ' . base_url . '/Login');
            exit; 
        }else{
            Flasher::setMessage('Gagal','Ditambahkan','danger');
            header('Location: ' . base_url . '/Register');
            exit; 
        }
    }

    public function Data_Barang() {
        $data['title'] = 'Data Barang';
        $data['barang']=$this->model($_SESSION['level'])->tampilSemuaBarang();

		$this->topBarName();
        $this->view('templates/sideMenuUser');
        $this->view('User_View/data_barang/index', $data);
        $this->view('templates/bottom');
    }

    public function Data_Peminjaman() {
        $data['title'] = 'Data Peminjaman';
        $data['barang']=$this->model($_SESSION['level'])->tampilPeminjaman();

		$this->topBarName();
        $this->view('templates/sideMenuUser');
        $this->view('User_View/data_peminjaman/index', $data);
        $this->view('templates/bottom');
    }

    public function Data_Pengembalian() {
        $data['title'] = 'Data Peminjaman';
        $data['barang']=$this->model($_SESSION['level'])->tampilPengembalian();       
		$this->topBarName();
        $this->view('templates/sideMenuUser');
        $this->view('User_View/data_pengembalian/index', $data);
        $this->view('templates/bottom');
    }

    public function History() {
        $data['title'] = 'History';
        $data['history']=$this->model($_SESSION['level'])->tampilHistory();
		$this->topBarName();
        $this->view('templates/sideMenuUser');
        $this->view('User_View/history/index', $data);
        $this->view('templates/bottom');
    }

    public function Akun(){
        $data=$this->model($_SESSION['level'])->tampilProfile();	 


		$this->topBarName();
		$this->view('templates/sideMenuUser');
		$this->view('User_View/akun/index', $data);
		$this->view('templates/bottom');
    }
    public function formEditAkun(){
        $data=$this->model($_SESSION['level'])->tampilProfile();	 

		$this->topBarName();
		$this->view('templates/sideMenuUser');
		$this->view('User_View/akun_edit/index', $data);
		$this->view('templates/bottom');
    }

    public function editAkun(){
        if ($this->model($_SESSION['level'])->editProfile($_POST)){
            Flasher::setMessage('Berhasil','Diubah','success');
            header('Location: ' . base_url . '/User_Side/Akun');
            exit;
        } else{
            Flasher::setMessage('Gagal','Diubah','danger');
            header('Location: ' . base_url . '/User_Side/Akun');
            exit; 
        }
    }

    public function hapusAkun() {
        if ($this->model($_SESSION['level'])->hapusAkun($_SESSION['user_id']) > 0){
            Flasher::setMessage('Berhasil','Akun dihapus','success');
            header('Location: ' . base_url);
            exit;
        } else{
            Flasher::setMessage('Gagal','Akun tidak dihapus','danger');
            header('Location: ' . base_url . '/User_Side/Akun');
            exit; 
        }
    }

    public function Logout() {
        $this->model($_SESSION['level'])->Logout();
    }


    // Controller Fungsi Fitur
    public function getNamaById(){
        $data['nama'] = $this->model($_SESSION['level'])->getNamaById($_SESSION['user_id']);
        return $data['nama'];
        
    }

    public function topBarName(){
        $data['level'] = $_SESSION['level'];
        $data['nama']=$this->getNamaById();
        return $this->view('templates/topUser', $data);
    }

    public function cariBarang(){
        $data['barang']=$this->model($_SESSION['level'])->cariBarang();

		$this->topBarName();
        $this->view('templates/sideMenuUser');
        $this->view('User_View/data_barang/index', $data);
        $this->view('templates/bottom');
    }

    public function tambahPeminjaman() {
        if($this->model($_SESSION['level'])->tambahDataPeminjamanBarang($_POST) > 0) {
            Flasher::setMessage('Berhasil','Ditambahkan','success');
            header('Location: ' . base_url . '/User_Side/Data_Barang');
            exit; 
        }else{
            Flasher::setMessage('Gagal','Ditambahkan','danger');
            header('Location: ' . base_url . '/User_Side/Data_Barang');
            exit; 

        }
    }

    public function Return($id){
        if($this->model($_SESSION['level'])->Return($id) > 0) {
            Flasher::setMessage('Berhasil','Melakukan Return Request','success');
            header('Location: ' . base_url . '/User_Side/data_peminjaman');
            exit; 
        }else{
            Flasher::setMessage('Gagal','Melakukan Return Request','danger');
            header('Location: ' . base_url . '/User_Side/data_peminjaman');  exit; 
        
        }  
    }

    public function Telat($id){
        if($this->model($_SESSION['level'])->cekKeterlambatan($id) > 0) {
            Flasher::setMessage('Anda Telat','Melakukan Pengembalian, Silahkan ke Admin','danger');
            header('Location: ' . base_url . '/User_Side/data_pengembalian');
            exit; 
        }else{
            Flasher::setMessage('Anda Telat','Melakukan Pengembalian, Silahkan ke Admin','danger');
            header('Location: ' . base_url . '/User_Side/data_pengembalian');
            exit; 

        }
    }

    public function Delete_Request($id){
        if($this->model($_SESSION['level'])->deleteRequest($id) > 0) {
            Flasher::setMessage('Berhasil','Melakukan Delete Request','success');
            header('Location: ' . base_url . '/User_Side');
            exit; 
        }else{
            Flasher::setMessage('Gagal','Melakukan Delete Request','danger');
            header('Location: ' . base_url . '/User_Side');
        exit; 
    }
}
}