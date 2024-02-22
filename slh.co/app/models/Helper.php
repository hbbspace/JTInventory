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


	// Fungsi inti Admin & User
    public function tambahDataUser($data) {
        $password = $data['password'];
        $salt = bin2hex(random_bytes(16));
        $combined_password = $salt . $password;
        $hashed_password = password_hash($combined_password, PASSWORD_BCRYPT);
        $data['password'] = $hashed_password;
    
        if (
            $data['nama'] != null &&
            $data['unicode'] != null &&
            $data['jenis_kelamin'] != null &&
            $data['email'] != "null" &&
            $data['username'] != null &&
            $data['password'] != null &&
            $data['level'] != "Pilih Level"
        ) {
            $unicode=$data['unicode'];
            $query="SELECT * FROM user WHERE unicode=:unicode";
            $this->db->query($query);
            $this->db->bind(':unicode', $unicode);
            // Menjalankan query dan mendapatkan hasilnya
            $result = $this->db->single();
            if($result){
                Flasher::setMessage('Gagal', 'Registrasi Karena Unicode Sudah Digunakan', 'danger');
                return 0;
            }else{

                $ambilId = "SELECT user_id FROM user ORDER BY user_id DESC LIMIT 1";
                $this->db->query($ambilId);
                $id = $this->db->single();
                $newUserId = $id['user_id'] + 1;
                $query = "INSERT INTO user VALUES (:newUserId, :unicode, :email, :username, :password, :salt, :level)";
        
                $this->db->query($query);
                $this->db->bind('newUserId', $newUserId);
                $this->db->bind('unicode', $data['unicode']);
                $this->db->bind('email', $data['email']);
                $this->db->bind('username', $data['username']);
                $this->db->bind('password', $data['password']); // Ubah ke hashed_password
                $this->db->bind('salt', $salt);
                $this->db->bind('level', $data['level']);
                $this->db->execute();
                if($data['level']=='Mahasiswa'){
                    $query2 = "INSERT INTO mahasiswa VALUES (:nim, :nama_mhs, :jk)";
                    $this->db->query($query2);
                    $this->db->bind('nim', $data['unicode']);
                    $this->db->bind('nama_mhs', $data['nama']);
                    $this->db->bind('jk', $data['jenis_kelamin']);
                    $this->db->execute();
                    return 1;
                }else if($data['level']=='Dosen'){
                    $query2 = "INSERT INTO dosen VALUES (:nidn, :nama_dosen, :jk)";
                    $this->db->query($query2);
                    $this->db->bind('nidn', $data['unicode']);
                    $this->db->bind('nama_dosen', $data['nama']);
                    $this->db->bind('jk', $data['jenis_kelamin']);
                    $this->db->execute();
                    return 1;
                }else{
                    Flasher::setMessage('Gagal', 'Registrasi Karena data tidak Valid', 'danger');
                    return 0;
                }
            }
        } else {
            return 0;
        }
    }

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
    
    public function hitungBarangDipinjamForUser(){
        // Mendapatkan id pengguna dari sesi
        $id=$_SESSION['user_id'];
        
        // Membuat query SQL
        $query="SELECT SUM(lb.qty) as jumlah FROM list_barang as lb INNER JOIN peminjaman as p on p.id_peminjaman=lb.id_peminjaman 
        WHERE (p.status = 'progress' or p.status='return') and p.user_id=$id";
        
        // Menjalankan query SQL
        $this->db->query($query);
        
        // Mengembalikan hasil query
        return $this->db->single();
    }
    

    public function tampilPeminjaman($status){
        if($_SESSION['level'] == 'Teknisi') {
            $query="SELECT m.nama_mhs AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id,p.keterangan as keterangan FROM peminjaman AS p
            INNER JOIN user AS u ON u.user_id = p.user_id
            INNER JOIN mahasiswa AS m ON m.nim = u.unicode
            WHERE p.status = '$status'
            UNION
            SELECT d.nama_dosen AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id ,p.keterangan as keterangan FROM peminjaman AS p
            INNER JOIN user AS u ON u.user_id = p.user_id
            INNER JOIN dosen AS d ON d.nidn = u.unicode
            WHERE p.status = '$status'";
        } else {
            $id=$_SESSION['user_id'];
            $query="SELECT p.id_peminjaman as id,p.time as waktu ,sum(lb.qty) as jumlah, p.status as status, p.keterangan as keterangan
            FROM peminjaman as p inner join list_barang as lb on p.id_peminjaman=lb.id_peminjaman inner join barang as b on b.id_barang = lb.id_barang WHERE p.user_id='$id' and p.status='$status'
            GROUP BY p.id_peminjaman";
        }
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function tampilPeminjamanSemuaStatus(){
        $id=$_SESSION['user_id'];
        $query="SELECT p.id_peminjaman as id,p.time as waktu ,sum(lb.qty) as jumlah, p.status as status, p.keterangan as keterangan
        FROM peminjaman as p inner join list_barang as lb on p.id_peminjaman=lb.id_peminjaman inner join barang as b on b.id_barang = lb.id_barang WHERE p.user_id='$id'
        GROUP BY p.id_peminjaman";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function tampilHistory(){
        if($_SESSION['level'] == 'Teknisi') {
            $query="SELECT m.nama_mhs AS nama, p.time AS waktu, u.level AS level, p.id_peminjaman AS id, p.keterangan AS keterangan, p.status AS status FROM peminjaman AS p
            INNER JOIN user AS u ON u.user_id = p.user_id
            INNER JOIN mahasiswa AS m ON m.nim = u.unicode
            WHERE p.status = 'done' OR p.status ='failed'
            UNION
            SELECT d.nama_dosen AS nama, p.time AS waktu, u.level AS level, p.id_peminjaman AS id, p.keterangan AS keterangan, p.status AS status FROM peminjaman AS p
            INNER JOIN user AS u ON u.user_id = p.user_id
            INNER JOIN dosen AS d ON d.nidn = u.unicode
            WHERE p.status = 'done' OR p.status ='failed';";
        } else {
            $id=$_SESSION['user_id'];
            $query = "SELECT p.id_peminjaman as id, p.time as waktu, SUM(lb.qty) as jumlah, p.status as status
            FROM peminjaman as p 
            INNER JOIN list_barang as lb ON p.id_peminjaman = lb.id_peminjaman 
            INNER JOIN barang as b ON b.id_barang = lb.id_barang 
            WHERE p.user_id = '$id' AND (p.status = 'done' OR p.status = 'failed')
            GROUP BY p.id_peminjaman";
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
        $unicode = $_SESSION['unicode'];
        $password = $data['password'];
        $level = $_SESSION['level'];
        if($password!=null){
            $salt = bin2hex(random_bytes(16));
            $combined_password = $salt . $password;
            $hashed_password = password_hash($combined_password, PASSWORD_BCRYPT);
            $var = $hashed_password;
            $query = "UPDATE user SET email = :email, username = :username, password = '$var', salt = '$salt' WHERE user_id = $id";
            $this->db->query($query);
            $this->db->bind('username', $data['username']);
            $this->db->bind('email', $data['email']);
            $this->db->execute();
        }else{
            $query = "UPDATE user SET email = :email, username = :username WHERE user_id = $id";
            $this->db->query($query);
            $this->db->bind('username', $data['username']);
            $this->db->bind('email', $data['email']);
            $this->db->execute();
        }
        if ($level == 'Teknisi') {
            $query2 = "UPDATE teknisi SET nama_teknisi = :nama_teknisi, jk = :jenis_kelamin WHERE nip = $unicode";
            $this->db->query($query2);
            $this->db->bind('nama_teknisi', $data['nama']);
            $this->db->bind('jenis_kelamin', $data['jk']);
            $this->db->execute();
        } else if ($level == 'Dosen') {
            $query2 = "UPDATE dosen SET nama_dosen = :nama_dosen, jk = :jenis_kelamin WHERE nidn = $unicode";
            $this->db->query($query2);
            $this->db->bind('nama_dosen', $data['nama']);
            $this->db->bind('jenis_kelamin', $data['jk']);
            $this->db->execute();
        } else {
            $query2 = "UPDATE mahasiswa SET nama_mhs = :nama_mhs, jk = :jenis_kelamin WHERE nim = $unicode";
            $this->db->query($query2);
            $this->db->bind('nama_mhs', $data['nama']);
            $this->db->bind('jenis_kelamin', $data['jk']);
            $this->db->execute();
        }
        return true;
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

    public function getBarangById($id_barang) {
        $this->db->query('SELECT * FROM barang WHERE id_barang = :id_barang');
        $this->db->bind('id_barang', $id_barang);
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
            //$query = "INSERT INTO barang VALUES (:id_barang, :nama_barang, :maintener, :qty)";
            $query = "call AddBarang(:id_barang, :nama_barang, :maintener, :qty )";
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

    public function editDataBarang($data) {
        $query = "UPDATE barang SET nama_barang = :nama_barang, maintener = :maintener, qty = :qty WHERE id_barang = :id_barang";

        $this->db->query($query);
        $this->db->bind('nama_barang', $data['nama_barang']);
        $this->db->bind('id_barang', $data['id_barang']);
        $this->db->bind('maintener', $data['maintener']);
        $this->db->bind('qty', $data['qty']);

        $this->db->execute();


        return $this->db->rowCount();
    }

    public function hapusDataBarang($id_barang) {
        $query="SELECT p.id_peminjaman FROM  list_barang as lb INNER JOIN peminjaman as p on lb.id_peminjaman=p.id_peminjaman WHERE lb.id_barang='$id_barang'";
        $this->db->query($query);
        $filter1=$this->db->single();
        if($filter1==null){
            $query = "DELETE FROM barang WHERE id_barang = :id_b";
            $this->db->query($query);
            $this->db->bind('id_b', $id_barang);
            $this->db->execute();
            return 1;
        }elseif($filter1!=null){
            return 2;
        }
        return 3;
    }
    
    public function hitungTotalBarang(){
        $query="SELECT sum(qty) as nilai FROM barang";
        $this->db->query($query);
        return $this->db->single();
    }

    public function totalBarangDipinjam(){
        $query="SELECT sum(qty) as jumlahPinjam FROM list_barang as lb INNER JOIN peminjaman as p on p.id_peminjaman = lb.id_peminjaman WHERE p.status='progress' or p.status='return';";
        $this->db->query($query);
        return $this->db->single();
    }

    public function hitungTotalUser() {
        $query="SELECT count(user_id) as jumlahUser FROM user AS u WHERE u.level = 'Dosen' OR u.level = 'Mahasiswa'";
        $this->db->query($query);
        return $this->db->single();
    }

    public function tampilDataBarang($idBarang,$status) {
        if($_SESSION['level']=='Teknisi'){
            $query="SELECT u.level as level from user as u inner join peminjaman as p on p.user_id = u.user_id where p.id_peminjaman='$idBarang'";
            $this->db->query($query);
            $levelTampilan=$this->db->single();
            if($levelTampilan['level']=='Mahasiswa')
                $query="SELECT p.id_peminjaman as id,p.keterangan as keterangan,p.time as waktu,m.nama_mhs as nama, b.nama_barang as nama_barang,b.id_barang as id_barang ,lb.qty as jumlah, p.tgl_pinjam as tanggal_pinjam, p.tgl_kembali as tanggal_kembali, p.status as status, p.Nama_File as nama_file
                FROM peminjaman as p inner join list_barang as lb on p.id_peminjaman=lb.id_peminjaman inner join barang as b on b.id_barang=lb.id_barang
                inner join user as u on p.user_id=u.user_id
                INNER JOIN mahasiswa AS m ON m.nim = u.unicode
                WHERE p.status='$status' and p.id_peminjaman='$idBarang'";
            else{
                $query="SELECT p.id_peminjaman as id,p.keterangan as keterangan,p.time as waktu,d.nama_dosen as nama, b.nama_barang as nama_barang,b.id_barang as id_barang ,lb.qty as jumlah, p.tgl_pinjam as tanggal_pinjam, p.tgl_kembali as tanggal_kembali, p.status as status,p.Nama_File as nama_file
                FROM peminjaman as p inner join list_barang as lb on p.id_peminjaman=lb.id_peminjaman inner join barang as b on b.id_barang=lb.id_barang
                inner join user as u on p.user_id=u.user_id
                INNER JOIN dosen AS d ON d.nidn = u.unicode
                WHERE p.status='$status' and p.id_peminjaman='$idBarang'";
            }
        }else {
        $id=$_SESSION['user_id'];
        $query="SELECT p.id_peminjaman as id,p.keterangan as keterangan,p.time as waktu,b.nama_barang as nama_barang,b.id_barang as id_barang ,lb.qty as jumlah, p.tgl_pinjam as tanggal_pinjam, p.tgl_kembali as tanggal_kembali, p.status as status, p.Nama_File as nama_file
        FROM peminjaman as p inner join list_barang as lb on p.id_peminjaman=lb.id_peminjaman inner join barang as b on b.id_barang=lb.id_barang WHERE p.user_id='$id' and p.status='$status' and p.id_peminjaman='$idBarang'";
        }
        $this->db->query($query);
        return $this->db->resultSet();
    }

    
    public function tampilDataBarangHistory($idBarang) {
        if($_SESSION['level']=='Teknisi'){
            $query="SELECT u.level as level from user as u inner join peminjaman as p on p.user_id = u.user_id where p.id_peminjaman='$idBarang'";
            $this->db->query($query);
            $levelTampilan=$this->db->single();
            if($levelTampilan['level']=='Mahasiswa')
                $query="SELECT p.id_peminjaman as id,p.keterangan as keterangan,p.time as waktu,m.nama_mhs as nama, b.nama_barang as nama_barang,b.id_barang as id_barang ,lb.qty as jumlah, p.tgl_pinjam as tanggal_pinjam, p.tgl_kembali as tanggal_kembali, p.status as status, p.Nama_File as nama_file
                FROM peminjaman as p inner join list_barang as lb on p.id_peminjaman=lb.id_peminjaman inner join barang as b on b.id_barang=lb.id_barang
                inner join user as u on p.user_id=u.user_id
                INNER JOIN mahasiswa AS m ON m.nim = u.unicode
                WHERE p.status='done' OR p.status='failed' and p.id_peminjaman='$idBarang'";
            else{
                $query="SELECT p.id_peminjaman as id, p.keterangan as keterangan, p.time as waktu, d.nama_dosen as nama, b.nama_barang as nama_barang, b.id_barang as id_barang , lb.qty as jumlah, p.tgl_pinjam as tanggal_pinjam, p.tgl_kembali as tanggal_kembali, p.status as status, p.Nama_File as nama_file
                FROM peminjaman as p inner join list_barang as lb on p.id_peminjaman=lb.id_peminjaman inner join barang as b on b.id_barang=lb.id_barang
                inner join user as u on p.user_id=u.user_id
                INNER JOIN dosen AS d ON d.nidn = u.unicode
                WHERE p.status='done' OR p.status='failed' and p.id_peminjaman='$idBarang'";
            }
        }else {
        $id=$_SESSION['user_id'];
        $query="SELECT p.id_peminjaman as id,p.keterangan as keterangan,p.time as waktu,b.nama_barang as nama_barang,b.id_barang as id_barang ,lb.qty as jumlah, p.tgl_pinjam as tanggal_pinjam, p.tgl_kembali as tanggal_kembali, p.status as status,p.Nama_File as nama_file
        FROM peminjaman as p inner join list_barang as lb on p.id_peminjaman=lb.id_peminjaman inner join barang as b on b.id_barang=lb.id_barang WHERE p.user_id='$id' and p.status='done' OR p.status='failed' and p.id_peminjaman='$idBarang'";
        }
        $this->db->query($query);
        return $this->db->resultSet();
    }


    public function tambahDataPeminjamanBarang($barang){
        $id=$_SESSION['user_id'];
        if (isset($barang['tanggal_pinjam']) && isset($barang['tanggal_kembali']) && isset($barang['check'])) {
            // Ambil array barang yang dicentanG
            $check = $barang['check'];
            // Ambil array jumlah pinjam yang sesuai
            $jumlah_pinjam = $barang['jumlah_pinjam'];

            // Ambil id terakhir
            $ambilId = "SELECT id_peminjaman FROM peminjaman ORDER BY id_peminjaman DESC LIMIT 1";
            $this->db->query($ambilId);
            $idPeminjaman = $this->db->single();
            $newPeminjaman = ($idPeminjaman['id_peminjaman'] + 1);

            if (isset($_FILES['foto_ktm'])) {
                $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/dasarWeb/JTInventory/slh.co/public/img/";
                $file_size = $_FILES['foto_ktm']['size'];
                $file_tmp = $_FILES['foto_ktm']['tmp_name'];
                $file_extension = strtolower(pathinfo($_FILES['foto_ktm']['name'], PATHINFO_EXTENSION));

                // Generate nama file unik
                $filename = "file_" . time() . "." . $file_extension;
                $target_file = $target_dir . $filename;

                $allowed_extensions = array("jpg", "jpeg", "png");
                if(!in_array($file_extension, $allowed_extensions)) {
                    echo "Extensi file yang diizinkan adalah jpg, jpeg dan png";
                    Flasher::setMessage('gagal','Ditambahkan','danger');
                    exit;
                } else if($file_size > 2097152){
                    echo "Maksimum file yang diizinkan adalah 2MB";
                    Flasher::setMessage('gagal','Ditambahkan','danger');
                    exit;
                } else {
                    move_uploaded_file($file_tmp, $target_file);
                    Flasher::setMessage('Berhasil','Ditambahkan','success');
                }

                // Buat query peminjaman
                $queryPeminjaman = "INSERT INTO peminjaman (id_peminjaman, user_id, tgl_pinjam, tgl_kembali, nama_file, status) 
                                    VALUES (:id_peminjaman, :user_id, :tgl_pinjam, :tgl_kembali, :nama_file, 'request')";
                $this->db->query($queryPeminjaman);
                $this->db->bind(':id_peminjaman', $newPeminjaman);
                $this->db->bind(':user_id', $id);
                $this->db->bind(':tgl_pinjam', $barang['tanggal_pinjam']);
                $this->db->bind(':tgl_kembali', $barang['tanggal_kembali']);
                $this->db->bind(':nama_file', $filename);
                $this->db->execute();

            } else {
                // Buat query peminjaman
                $queryPeminjaman = "INSERT INTO peminjaman (id_peminjaman, user_id, tgl_pinjam, tgl_kembali, status) VALUES (:id_peminjaman, :user_id, :tgl_pinjam, :tgl_kembali, 'request')";
                $this->db->query($queryPeminjaman);
                $this->db->bind(':id_peminjaman', $newPeminjaman);
                $this->db->bind(':user_id', $id);
                $this->db->bind(':tgl_pinjam', $barang['tanggal_pinjam']);
                $this->db->bind(':tgl_kembali', $barang['tanggal_kembali']);
                $this->db->execute();
            }

                // Ambil id peminjaman yang baru dibuat
            $query = "SELECT id_peminjaman AS id FROM peminjaman WHERE user_id = $id AND status='request' ORDER BY time DESC LIMIT 1;"; 
            $this->db->query($query);
            $idPeminjaman=$this->db->single();

            $queryListBarang = "INSERT INTO list_barang VALUES (:id_barang, :id_peminjaman, :qty)";
            $this->db->query($queryListBarang);
            for ($i=0; $i<count($check); $i++) {
                $this->db->bind(':id_barang', $check[$i]);
                $this->db->bind(':id_peminjaman', $idPeminjaman['id']);
                $this->db->bind(':qty', $jumlah_pinjam[$i]);
                // Eksekusi query
                $this->db->execute();
            }
            return $this->db->rowCount();    
  
        } else {
            return 0;
        }
    }


    public function AcceptedRequest($id)  {
        $query = "UPDATE peminjaman
                  SET time = NOW(), status = 'progress'
                  WHERE id_peminjaman = $id";
        // $query = "call AcceptReq(@id := {$id})";
        $this->db->query($query);
        $this->db->execute();
    
        return $this->db->rowCount();
    }
     

    public function AcceptedReturn($id )  {
        $query="UPDATE peminjaman
        SET time = NOW(), status = 'done'
        WHERE id_peminjaman=$id;";
        // $query = "call AcceptReturn(@id := {$id})";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }
    
    public function RejectRequest($id )  {
        // $query="UPDATE peminjaman
        // SET time = NOW(), status = 'failed'
        // WHERE id_peminjaman=$id;";
        $query = "call RejectReq(@id := {$id})";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function RejectReturn($id)  {
        // $query="UPDATE peminjaman
        // SET time = NOW(), status = 'progress'
        // WHERE id_peminjaman=$id;";
        $query = "call RejectReturn(@id := {$id})";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function UpdateStok($id,$status){
        $key = "SELECT id_barang as id, qty as jumlah_pinjam FROM list_barang WHERE id_peminjaman=$id";
        $this->db->query($key);
        $rows = $this->db->resultSet();
        // var_dump($row);
        foreach ($rows as $row) {
            $idBarang = $row['id'];
            $stokQuery = "SELECT qty as jumlah_stok FROM barang WHERE id_barang='$idBarang' ";
            $this->db->query($stokQuery);
            $stokRow = $this->db->single();
            if($status=='peminjaman'){
                $jumlahStok = $stokRow['jumlah_stok'] - $row['jumlah_pinjam'];
                $updateQuery = "UPDATE barang SET qty=$jumlahStok WHERE id_barang='$idBarang'";
                $this->db->query($updateQuery);
                $this->db->execute();
            }else if($status=='pengembalian'){
                $jumlahStok = $stokRow['jumlah_stok'] + $row['jumlah_pinjam'];
                $updateQuery = "UPDATE barang SET qty=$jumlahStok WHERE id_barang='$idBarang'";
                $this->db->query($updateQuery);
                $this->db->execute();
            }else{
                return 0;
                
            }
        }
        return 1;
    }

    public function Return($id){
        $query="UPDATE peminjaman
        SET time = NOW(), status = 'return'
        WHERE id_peminjaman=$id;";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }
    
    public function Telat($id){
        $query="UPDATE peminjaman
        SET time = NOW(), keterangan = 'System : Anda Harus Membayar Denda ke Admin' , status='return'
        WHERE id_peminjaman=$id;";
        $this->db->query($query);
        $this->db->execute();
        return 1;
    }


    public function gantiPassword($data) {
        $var = $data['input'];
        $query = "SELECT user_id FROM user WHERE username = '$var' OR email = '$var'";
        $this->db->query($query);
        if($id = $this->db->single() > 0) {
            $password = $data['password'];
            $salt = bin2hex(random_bytes(16));
            $combined_password = $salt . $password;
            $hashed_password = password_hash($combined_password, PASSWORD_BCRYPT);
            $var = $hashed_password;
            $query2 = "UPDATE user SET password = '$var', salt = '$salt' WHERE user_id = '$id'";
            $this->db->query($query2);
            $this->db->execute();
            return 1;
        } else {
            return 0;
        }
    }

    public function hapusUser($id) {
        $cekPeminjamanQuery = "SELECT id_peminjaman FROM peminjaman WHERE user_id = :id AND (status = 'progress' OR status = 'return')";
        $this->db->query($cekPeminjamanQuery);
        $this->db->bind(':id', $id);
    
        if ($this->db->single() !== false) {
            return 0;
        } else {
            $cekPeminjamanQuery = "SELECT id_peminjaman FROM peminjaman WHERE user_id = :id AND (status = 'request' OR status = 'done' OR status = 'failed')";
            $this->db->query($cekPeminjamanQuery);
            $this->db->bind(':id', $id);
    
            if ($this->db->single() !== false) {
                $query = "SELECT id_peminjaman, nama_file FROM peminjaman WHERE user_id = :id";
                $this->db->query($query);
                $this->db->bind(':id', $id);
                $idPeminjamanSet = $this->db->resultSet();
    
                foreach ($idPeminjamanSet as $idPeminjaman) {
                    $deleteListBarangQuery = "DELETE FROM list_barang WHERE id_peminjaman = :id_peminjaman";
                    $this->db->query($deleteListBarangQuery);
                    $this->db->bind(':id_peminjaman', $idPeminjaman['id_peminjaman']);
                    $this->db->execute();
    
                    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/dasarWeb/JTInventory/slh.co/public/img/";
                    $target_file = $target_dir . $idPeminjaman['nama_file'];
    
                    if (file_exists($target_file)) {
                        if (unlink($target_file)) {
                            $deletePeminjamanQuery = "DELETE FROM peminjaman WHERE id_peminjaman = :id_peminjaman";
                            $this->db->query($deletePeminjamanQuery);
                            $this->db->bind(':id_peminjaman', $idPeminjaman['id_peminjaman']);
                            $this->db->execute();
                        }
                    }
                }
            }
    
            $deleteUserQuery = "DELETE FROM user WHERE user_id = :id";
            $this->db->query($deleteUserQuery);
            $this->db->bind(':id', $id);
            $this->db->execute();
            return 1;
        }
    }
    
    public function tambahDataKeterangan($keterangan){
        $keteranganval=$keterangan['keterangan'];
        $idPeminjaman=$keterangan['row_id'];
        if(isset($keterangan['keterangan']) && isset($keterangan['row_id'])){
            $query="UPDATE peminjaman SET keterangan='$keteranganval'
            WHERE id_peminjaman=$idPeminjaman;";
            $this->db->query($query);
            $this->db->execute();
            return $this->db->rowCount();
        }
    }

    public function deleteRequest($id){
        $query="SELECT nama_file FROM peminjaman where id_peminjaman = $id";
        $this->db->query($query);
        $filename = $this->db->single();

        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/dasarWeb/JTInventory/slh.co/public/img/";

        $target_file = $target_dir . $filename['nama_file'];

        // Check if the file exists before attempting to delete it
        if (file_exists($target_file)) {
            // Attempt to delete the file
            if (unlink($target_file)) {
                // File deletion success
                $query="DELETE FROM list_barang WHERE id_peminjaman=$id";
                $this->db->query($query);
                $this->db->execute();

                //sing pingin tak dadekne trigger :
                $query="DELETE FROM peminjaman WHERE id_peminjaman=$id";
                $this->db->query($query);
                $this->db->execute();
                return 1;
            } else {
                // File deletion failure                
                header('Location: ' . base_url . '/User_Side/History/');
                return 0;
                exit;
            }
        } else {
            // File doesn't exist            
            header('Location: ' . base_url . '/User_Side/Akun/');
            return 0;
            exit;
        }
    }
}