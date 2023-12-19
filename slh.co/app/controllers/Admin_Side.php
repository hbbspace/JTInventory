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
        $data['jumlahBarang']=$this->model($_SESSION['level'])->hitungTotalBarang();
		$data['jumlahBarangDipinjam']=$this->model($_SESSION['level'])->totalBarangDipinjam();
        $data['jumlahUser']=$this->model($_SESSION['level'])->hitungTotalUser();
		$data['peminjaman']=$this->model($_SESSION['level'])->tampilSemuaRequest();

		$this->view('templates/top', $data);
		$this->view('templates/sideMenuAdmin');
		$this->view('home/index', $data);
		$this->view('templates/bottom');

    }

    // Controller Fungsi Inti
    public function Data_Admin() {
        $data['title'] = 'Profile Akun';
        $data[$_SESSION['level']]=$this->model($_SESSION['level'])->tampilSemuaAdmin();

		$this->topBarName();
        $this->view('templates/sideMenuAdmin');
        $this->view('admin/index', $data);
        $this->view('templates/bottom');
    }

    public function Data_Barang() {
        $data['title'] = 'Data Barang';
        $data['barang']=$this->model($_SESSION['level'])->tampilSemuaBarang();

		$this->topBarName();
        $this->view('templates/sideMenuAdmin');
        $this->view('data_barang/index', $data);
        $this->view('templates/bottom');
    }

    public function Data_Request(){
        $data['title'] = 'Data Peminjaman';
        $data['request']=$this->model($_SESSION['level'])->tampilSemuaRequest();
		$this->topBarName();
        $this->view('templates/sideMenuAdmin');
        $this->view('data_request/index', $data);
        $this->view('templates/bottom');
    }

    public function Data_Peminjaman() {
        $data['title'] = 'Data Peminjaman';
        $data['peminjaman']=$this->model($_SESSION['level'])->tampilSemuaPeminjaman();

		$this->topBarName();
        $this->view('templates/sideMenuAdmin');
        $this->view('data_peminjaman/index', $data);
        $this->view('templates/bottom');
    }

    public function Data_Pengembalian() {
        $data['title'] = 'Data Peminjaman';
        $data['pengembalian']=$this->model($_SESSION['level'])->tampilSemuaPengembalian();
        
		$this->topBarName();
        $this->view('templates/sideMenuAdmin');
        $this->view('data_pengembalian/index', $data);
        $this->view('templates/bottom');
    }

    public function History() {
        $data['history']=$this->model($_SESSION['level'])->tampilHistory();
		$this->topBarName();
        $this->view('templates/sideMenuAdmin');
        $this->view('history/index', $data);
        $this->view('templates/bottom');
    }

    public function Akun(){
        $data=$this->model($_SESSION['level'])->tampilProfile();	 


		$this->topBarName();
		$this->view('templates/sideMenuAdmin');
		$this->view('akun/index', $data);
		$this->view('templates/bottom');
    }

    public function formEditAkun(){
        $data=$this->model($_SESSION['level'])->tampilProfile();	 

		$this->topBarName();
		$this->view('templates/sideMenuAdmin');
		$this->view('akun_edit/index', $data);
		$this->view('templates/bottom');
    }

    public function editAkun(){
        
        if ($this->model($_SESSION['level'])->editProfile($_POST)){
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
        if ($this->model($_SESSION['level'])->hapusAkun($_SESSION['user_id']) > 0){
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
        $this->model($_SESSION['level'])->Logout();
    }

    // Controller Fungsi Fitur
    public function tambahBarang() {
        if($this->model($_SESSION['level'])->tambahDataBarang($_POST) > 0) {
            Flasher::setMessage('Berhasil','Ditambahkan','success');
            header('Location: ' . base_url . '/Admin_Side/Data_Barang');
            exit; 
        }else{
            Flasher::setMessage('Gagal','Ditambahkan','danger');
            header('Location: ' . base_url . '/Admin_Side/Data_Barang');
            exit; 
        }
    }

    public function getEditBarang() {
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($this->model($_SESSION['level'])->getBarangById($data['id_barang']));	 
    }

    public function editBarang() {
        if($this->model($_SESSION['level'])->editDataBarang($_POST) > 0) {
            Flasher::setMessage('Berhasil','Diubah','success');
            header('Location: ' . base_url . '/Admin_Side/Data_Barang');
            exit; 
        }else{
            Flasher::setMessage('Gagal','Diubah','danger');
            header('Location: ' . base_url . '/Admin_Side/Data_Barang');
            exit; 
        }
    }

    public function hapusBarang($id_barang) {
        if($this->model($_SESSION['level'])->hapusDataBarang($id_barang) == 1) {
            Flasher::setMessage('Berhasil','Dihapus','success');
            header('Location: ' . base_url . '/Admin_Side/Data_Barang');
            exit; 
        }else if ($this->model($_SESSION['level'])->hapusDataBarang($id_barang) == 2){
            Flasher::setMessage('Gagal','Menghapus Barang Karena Data Barang Sedang Digunakan','danger');
            header('Location: ' . base_url . '/Admin_Side/Data_Barang');
            exit; 
        }else{
            Flasher::setMessage('Gagal','Menghapus Barang Karena Data Tidak Valid','danger');
            header('Location: ' . base_url . '/Admin_Side/Data_Barang');
            exit; 
        }
    }
    
    public function getNamaById(){
        $data['nama']=$this->model($_SESSION['level'])->getNamaById($_SESSION['user_id']);
        return $data['nama'];
    }

    public function topBarName(){
        $data['level'] = $_SESSION['level'];
        $data['nama']=$this->getNamaById();		 
        return 	$this->view('templates/top', $data);
    }

    public function cariBarang(){
        $data['barang']=$this->model($_SESSION['level'])->cariBarang();

		$this->topBarName();
        $this->view('templates/sideMenuAdmin');
        $this->view('data_barang/index', $data);
        $this->view('templates/bottom');
    }

    public function Rincian_Request($id){
        $status='request';
        $data['rincian']=$this->model($_SESSION['level'])->tampilRincianRequestBarang($id,$status);
		$this->topBarName();
		$this->view('templates/sideMenuAdmin');
		$this->view('rincian/index', $data);
		$this->view('templates/bottom');
    }

    public function Rincian_Peminjaman($id){
        $status='progress';
        $data['rincian']=$this->model($_SESSION['level'])->tampilDataBarangProgress($id,$status);
		$this->topBarName();
		$this->view('templates/sideMenuAdmin');
		$this->view('data_peminjaman_rincian/index', $data);
		$this->view('templates/bottom');
    }

    public function Rincian_Pengembalian($id){
        $status='return';
        $data['rincian']=$this->model($_SESSION['level'])->tampilRincianBarangReturn($id,$status);
		$this->topBarName();
		$this->view('templates/sideMenuAdmin');
		$this->view('data_pengembalian_rincian/index', $data);
		$this->view('templates/bottom');
    }

    public function Rincian_History($id){
        $data['rincian']=$this->model($_SESSION['level'])->tampilRincianBarangHistory($id);
		$this->topBarName();
		$this->view('templates/sideMenuAdmin');
		$this->view('rincian_history/index', $data);
		$this->view('templates/bottom');
    }

    public function Accepted($id){
        $idBarang=$id;
        $status='peminjaman';
        // var_dump($this->model($_SESSION['level'])->UpdateStok($idBarang));
            if($this->model($_SESSION['level'])->AcceptedRequest($id) > 0&&$this->model($_SESSION['level'])->UpdateStok($idBarang,$status)>0) {
                Flasher::setMessage('Berhasil','Melakukan Accepted','success');
                header('Location: ' . base_url . '/Admin_Side/Data_Request');
                exit; 
            }else{
                Flasher::setMessage('Gagal','Melakukan Accepted','danger');
                header('Location: ' . base_url . '/Admin_Side/Data_Request');
                exit; 
            }
    }

    public function Rejected($id){
            if($this->model($_SESSION['level'])->RejectRequest($id) > 0) {
                Flasher::setMessage('Berhasil','Melakukan Reject','success');
                header('Location: ' . base_url . '/Admin_Side/Data_Request');
                exit; 
            }else{
                Flasher::setMessage('Gagal','Melakukan Reject','danger');
                header('Location: ' . base_url . '/Admin_Side/Data_Request');
                exit; 
            }
    }
    
    public function AcceptedReturn($id){
        $idBarang=$id;
        $status='pengembalian';
        if($this->model($_SESSION['level'])->AcceptedReturn($id) > 0 && $this->model($_SESSION['level'])->UpdateStok($idBarang,$status)) {
                Flasher::setMessage('Berhasil','Melakukan Accepted','success');
                header('Location: ' . base_url . '/Admin_Side/Data_Request');
                exit; 
            }else{
                Flasher::setMessage('Gagal','Melakukan Accepted','danger');
                header('Location: ' . base_url . '/Admin_Side/Data_Request');
                exit; 
            }
    }

    public function RejectedReturn($id){
            if($this->model($_SESSION['level'])->RejectReturn($id) > 0) {
                Flasher::setMessage('Berhasil','Melakukan Reject','success');
                header('Location: ' . base_url . '/Admin_Side/Data_Request');
                exit; 
            }else{
                Flasher::setMessage('Gagal','Melakukan Reject','danger');
                header('Location: ' . base_url . '/Admin_Side/Data_Request');
                exit; 
            }
    }

    public function tambahDataKeterangan(){
        // var_dump( $this->model($_SESSION['level'])->tambahDataKeterangan($_POST));
        if($this->model($_SESSION['level'])->tambahDataKeterangan($_POST) > 0) {
          Flasher::setMessage('Keterangan Berhasil','Ditambahkan','success');
          header('Location: ' . $_SERVER['HTTP_REFERER']);
          exit; 
        }else{
          Flasher::setMessage('Keterangan Gagal','Ditambahkan','danger');
          header('Location: ' . $_SERVER['HTTP_REFERER']);
          exit; 
        }
      }
}