<?php

class Helper {
	
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

	// Fungsi Basic Inti
	public function checkLogin()
	{
		$query = "SELECT user_id, unicode, username, level, salt, password as hashed_password FROM user WHERE username = :username";
		$this->db->query($query);
		$this->db->bind('username', $_POST['username']);
		$result = $this->db->single();
		$salt = $result['salt'];
		$hashed_password = $result['hashed_password'];
		if ($hashed_password != null && $salt != null) {
			$combined_password = $salt . $_POST['password'];
			if (password_verify($combined_password, $hashed_password)) {
				return $result;
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}

    public function ambilDataParent($id) {
        $query="SELECT * FROM user WHERE user_id = '$id'";
        $this->db->query($query);
        return $this->db->single();
    }

    public function ambilDataChild($id) {
        if($_SESSION['level'] == 'Teknisi') {
            $query="SELECT * FROM teknisi AS t INNER JOIN user AS u ON u.unicode = t.nip WHERE u.unicode = '$id'";
        } else if ($_SESSION['level'] == 'Dosen') {
            $query="SELECT * FROM dosen AS t INNER JOIN user AS u ON u.unicode = t.nidn WHERE u.unicode = '$id'";
        } else {
            $query="SELECT * FROM mahasiswa AS t INNER JOIN user AS u ON u.unicode = t.nim WHERE u.unicode = '$id'";
        }
        $this->db->query($query);
        return $this->db->single();
    }


	// Fungsi inti Admin
	public function tampilSemuaAdmin(){
        $query="SELECT * FROM teknisi;";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function tampilSemuaBarang(){
            $query="SELECT * FROM barang";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function tampilPeminjaman($status){
        if($_SESSION['level'] == 'Teknisi') {
            $query="SELECT m.nama_mhs AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id FROM peminjaman AS p
            INNER JOIN user AS u ON u.user_id = p.user_id
            INNER JOIN mahasiswa AS m ON m.nim = u.unicode
            WHERE p.status = '$status'
            UNION
            SELECT d.nama_dosen AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id FROM peminjaman AS p
            INNER JOIN user AS u ON u.user_id = p.user_id
            INNER JOIN dosen AS d ON d.nidn = u.unicode
            WHERE p.status = '$status'";
        } else {
            $id=$_SESSION['user_id'];
            $query="SELECT p.id_peminjaman as id,p.time as waktu ,sum(lb.qty) as jumlah, p.status as status
            FROM peminjaman as p inner join list_barang as lb on p.id_peminjaman=lb.id_peminjaman inner join barang as b on b.id_barang = lb.id_barang WHERE p.user_id='$id' and p.status='$status'";
        }
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function tampilHistory(){
        if($_SESSION['level'] == 'Teknisi') {
            $query="SELECT m.nama_mhs AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id, p.keterangan AS keterangan FROM peminjaman AS p
            INNER JOIN user AS u ON u.user_id = p.user_id
            INNER JOIN mahasiswa AS m ON m.nim = u.unicode
            WHERE p.status = 'done' OR p.status ='failed'
            UNION
            SELECT d.nama_dosen AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id, p.keterangan AS keterangan FROM peminjaman AS p
            INNER JOIN user AS u ON u.user_id = p.user_id
            INNER JOIN dosen AS d ON d.nidn = u.unicode
            WHERE p.status = 'done' OR p.status ='failed';";
        } else if ($_SESSION['level'] == 'Dosen') {
            $id=$_SESSION['user_id'];
            $query="SELECT d.nama_dosen AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id, p.keterangan AS keterangan FROM peminjaman AS p
            INNER JOIN user AS u ON u.user_id = p.user_id
            INNER JOIN dosen AS d ON d.nidn = u.unicode
            WHERE p.status = 'done' OR p.status ='failed' AND p.user_id = $id";
        } else {
            $id=$_SESSION['user_id'];
            $query = "SELECT m.nama_mhs AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id, p.keterangan AS keterangan FROM peminjaman AS p
            INNER JOIN user AS u ON u.user_id = p.user_id
            INNER JOIN mahasiswa AS m ON m.nim = u.unicode
            WHERE p.status = 'done' OR p.status ='failed' AND p.user_id = $id";
        }
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function tampilProfile(){
        $id = $_SESSION['user_id'];
        if($_SESSION['level'] == 'Teknisi') {
            $query = "SELECT t.nama_teknisi AS nama , t.nip AS unicode, t.jk AS jk, u.username AS username, u.email AS email, u.level as level FROM user AS u 
            INNER JOIN teknisi AS t ON t.nip = u.unicode WHERE u.level = 'Teknisi' AND u.user_id = '$id'";
        } else if ($_SESSION['level'] == 'Dosen') {
            $query = "SELECT t.nama_dosen AS nama , t.nidn AS unicode, t.jk AS jk, u.username AS username, u.email AS email, u.level as level FROM user AS u 
            INNER JOIN dosen AS t ON t.nidn = u.unicode WHERE u.level = 'Dosen' AND u.user_id = '$id'";
        } else {
            $query = "SELECT t.nama_mhs AS nama , t.nim AS unicode, t.jk AS jk, u.username AS username, u.email AS email, u.level as level FROM user AS u 
            INNER JOIN mahasiswa AS t ON t.nim = u.unicode WHERE u.level = 'Mahasiswa' AND u.user_id = '$id'";
        }
        $this->db->query($query);
        return $this->db->single();
    }
    public function editProfile($data) {
        $id = $_SESSION['user_id'];
        $query = "UPDATE user SET email = :email, username = :username,  WHERE user_id =  ";
    }

    // Fungsi Tambahan
    public function getNamaById($id){
        if($_SESSION['level'] == 'Teknisi') {        
            $query="SELECT t.nama_teknisi AS nama FROM user AS u INNER JOIN teknisi AS t ON t.nip = u.unicode WHERE u.user_id = '$id'";
        } else if ($_SESSION['level'] == 'Dosen') {
            $query="SELECT t.nama_dosen AS nama FROM user AS u INNER JOIN dosen AS t ON t.nidn = u.unicode WHERE u.user_id = '$id'";
        } else{
            $query="SELECT t.nama_mhs AS nama FROM user AS u INNER JOIN mahasiswa AS t ON t.nim = u.unicode WHERE u.user_id = '$id'";            
        }
        $this->db->query($query);
        return $this->db->single();
    }

    public function cariBarang(){
        $keyword=$_POST['keyword'];
        $query="SELECT * FROM barang where nama_barang LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }

    public function tambahDataBarang($data) {
        if ($data['nama_barang'] != null && $data['id_barang'] != null && $data['maintener'] != null && $data['qty'] != null) {
            $query = "INSERT INTO barang VALUES (:id_barang, :nama_barang, :maintener, :qty)";

            $this->db->query($query);
            $this->db->bind('nama_barang', $data['nama_barang']);
            $this->db->bind('id_barang', $data['id_barang']);
            $this->db->bind('maintener', $data['maintener']);
            $this->db->bind('qty', $data['qty']);

            $this->db->execute();
            
        } else {
            return 0;
        }

        return $this->db->rowCount();
    }

    public function hapusDataBarang($id_barang) {
        $query = "DELETE FROM barang WHERE id_barang = :id_b";
        $this->db->query($query);
        $this->db->bind('id_b', $id_barang);

        $this->db->execute();

        return $this->db->rowCount();
    }
    
    public function hitungTotalBarang(){
        $query="SELECT sum(qty) as nilai FROM barang";
        $this->db->query($query);
        return $this->db->single();
    }

    public function totalBarangDipinjam(){
        $query="SELECT sum(qty) as jumlahPinjam FROM list_barang";
        $this->db->query($query);
        return $this->db->single();
    }

    public function hitungTotalUser() {
        $query="SELECT count(user_id) as jumlahUser FROM user AS u WHERE u.level = 'Dosen' OR u.level = 'Mahasiswa'";
        $this->db->query($query);
        return $this->db->single();
    }

    public function tampilDataRequestBarang($idBarang) {
        if($_SESSION['level']=='Teknisi'){
            $query="SELECT u.level as level from user as u inner join peminjaman as p on p.user_id = u.user_id where p.id_peminjaman='$idBarang'";
            $this->db->query($query);
            $levelTampilan=$this->db->single();
            if($levelTampilan['level']=='Mahasiswa')
                $query="SELECT p.id_peminjaman as id,p.time as waktu,m.nama_mhs as nama, b.nama_barang as nama_barang,b.id_barang as id_barang ,lb.qty as jumlah, p.tgl_pinjam as tanggal_pinjam, p.tgl_kembali as tanggal_kembali, p.status as status
                FROM peminjaman as p inner join list_barang as lb on p.id_peminjaman=lb.id_peminjaman inner join barang as b on b.id_barang=lb.id_barang
                inner join user as u on p.user_id=u.user_id
                INNER JOIN mahasiswa AS m ON m.nim = u.unicode
                WHERE p.status='request' and p.id_peminjaman='$idBarang'";
            else{
                $query="SELECT p.id_peminjaman as id,p.time as waktu,d.nama_dosen as nama, b.nama_barang as nama_barang,b.id_barang as id_barang ,lb.qty as jumlah, p.tgl_pinjam as tanggal_pinjam, p.tgl_kembali as tanggal_kembali, p.status as status
                FROM peminjaman as p inner join list_barang as lb on p.id_peminjaman=lb.id_peminjaman inner join barang as b on b.id_barang=lb.id_barang
                inner join user as u on p.user_id=u.user_id
                INNER JOIN dosen AS d ON d.nidn = u.unicode
                WHERE p.status='request' and p.id_peminjaman='$idBarang'";
            }
        }else {
        $id=$_SESSION['user_id'];
        $query="SELECT p.id_peminjaman as id,p.time as waktu,b.nama_barang as nama_barang,b.id_barang as id_barang ,lb.qty as jumlah, p.tgl_pinjam as tanggal_pinjam, p.tgl_kembali as tanggal_kembali, p.status as status
        FROM peminjaman as p inner join list_barang as lb on p.id_peminjaman=lb.id_peminjaman inner join barang as b on b.id_barang=lb.id_barang WHERE p.user_id='$id' and p.status='request' and p.id_peminjaman='$idBarang'";
        }
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function tampilDataBarangProgress($idBarang) {
        if($_SESSION['level']=='Teknisi'){
            $query="SELECT u.level as level from user as u inner join peminjaman as p on p.user_id = u.user_id where p.id_peminjaman='$idBarang'";
            $this->db->query($query);
            $levelTampilan=$this->db->single();
            if($levelTampilan['level']=='Mahasiswa')
                $query="SELECT p.id_peminjaman as id,p.time as waktu,m.nama_mhs as nama, b.nama_barang as nama_barang,b.id_barang as id_barang ,lb.qty as jumlah, p.tgl_pinjam as tanggal_pinjam, p.tgl_kembali as tanggal_kembali, p.status as status
                FROM peminjaman as p inner join list_barang as lb on p.id_peminjaman=lb.id_peminjaman inner join barang as b on b.id_barang=lb.id_barang
                inner join user as u on p.user_id=u.user_id
                INNER JOIN mahasiswa AS m ON m.nim = u.unicode
                WHERE p.status='progress' and p.id_peminjaman='$idBarang'";
            else{
                $query="SELECT p.id_peminjaman as id,p.time as waktu,d.nama_dosen as nama, b.nama_barang as nama_barang,b.id_barang as id_barang ,lb.qty as jumlah, p.tgl_pinjam as tanggal_pinjam, p.tgl_kembali as tanggal_kembali, p.status as status
                FROM peminjaman as p inner join list_barang as lb on p.id_peminjaman=lb.id_peminjaman inner join barang as b on b.id_barang=lb.id_barang
                inner join user as u on p.user_id=u.user_id
                INNER JOIN dosen AS d ON d.nidn = u.unicode
                WHERE p.status='progress' and p.id_peminjaman='$idBarang'";
            }
        }else {
        $id=$_SESSION['user_id'];
        $query="SELECT p.id_peminjaman as id,p.time as waktu,b.nama_barang as nama_barang,b.id_barang as id_barang ,lb.qty as jumlah, p.tgl_pinjam as tanggal_pinjam, p.tgl_kembali as tanggal_kembali, p.status as status
        FROM peminjaman as p inner join list_barang as lb on p.id_peminjaman=lb.id_peminjaman inner join barang as b on b.id_barang=lb.id_barang WHERE p.user_id='$id' and p.status='request' and p.id_peminjaman='$idBarang'";
        }
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function tampilDataBarangRequestPengembalian($idBarang) {
        if($_SESSION['level']=='Teknisi'){
            $query="SELECT u.level as level from user as u inner join peminjaman as p on p.user_id = u.user_id where p.id_peminjaman='$idBarang'";
            $this->db->query($query);
            $levelTampilan=$this->db->single();
            if($levelTampilan['level']=='Mahasiswa')
                $query="SELECT p.id_peminjaman as id,p.time as waktu,m.nama_mhs as nama, b.nama_barang as nama_barang,b.id_barang as id_barang ,lb.qty as jumlah, p.tgl_pinjam as tanggal_pinjam, p.tgl_kembali as tanggal_kembali, p.status as status
                FROM peminjaman as p inner join list_barang as lb on p.id_peminjaman=lb.id_peminjaman inner join barang as b on b.id_barang=lb.id_barang
                inner join user as u on p.user_id=u.user_id
                INNER JOIN mahasiswa AS m ON m.nim = u.unicode
                WHERE p.status='Return' and p.id_peminjaman='$idBarang'";
            else{
                $query="SELECT p.id_peminjaman as id,p.time as waktu,d.nama_dosen as nama, b.nama_barang as nama_barang,b.id_barang as id_barang ,lb.qty as jumlah, p.tgl_pinjam as tanggal_pinjam, p.tgl_kembali as tanggal_kembali, p.status as status
                FROM peminjaman as p inner join list_barang as lb on p.id_peminjaman=lb.id_peminjaman inner join barang as b on b.id_barang=lb.id_barang
                inner join user as u on p.user_id=u.user_id
                INNER JOIN dosen AS d ON d.nidn = u.unicode
                WHERE p.status='Return' and p.id_peminjaman='$idBarang'";
            }
        }else {
        $id=$_SESSION['user_id'];
        $query="SELECT p.id_peminjaman as id,p.time as waktu,b.nama_barang as nama_barang,b.id_barang as id_barang ,lb.qty as jumlah, p.tgl_pinjam as tanggal_pinjam, p.tgl_kembali as tanggal_kembali, p.status as status
        FROM peminjaman as p inner join list_barang as lb on p.id_peminjaman=lb.id_peminjaman inner join barang as b on b.id_barang=lb.id_barang WHERE p.user_id='$id' and p.status='request' and p.id_peminjaman='$idBarang'";
        }
        $this->db->query($query);
        return $this->db->resultSet();
    }

    
}