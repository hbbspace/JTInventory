<?php

class User {

    protected $nip;
    protected $namaTeknisi;
    protected $jenisKelamin;
    protected $db;

    public function __construct(){

        $this->db=new Database;
    }

    // Fungsi Inti

    public function tampilSemuaBarang(){
        $query="SELECT* FROM barang;";
        $this->db->query($query);
        return $this->db->resultSet();
    }
    
    public function tampilRequestBarang(){
        $id=$_SESSION['user_id'];
        $querry="SELECT p.id_peminjaman as id,p.time as waktu ,sum(lb.qty) as jumlah, p.status as status
        FROM peminjaman as p inner join list_barang as lb on p.id_peminjaman=lb.id_peminjaman inner join barang as b on b.id_barang=lb.id_barang WHERE p.user_id='$id' and p.status='request';";
        $this->db->query($querry);
        return $this->db->resultSet();
    }

    public function tampilPeminjaman(){
        $id=$_SESSION['user_id'];
        $querry="SELECT p.id_peminjaman as id,p.time as waktu ,sum(lb.qty) as jumlah, p.status as status
        FROM peminjaman as p inner join list_barang as lb on p.id_peminjaman=lb.id_peminjaman inner join barang as b on b.id_barang=lb.id_barang WHERE p.user_id='$id' and p.status='progress';";
        $this->db->query($querry);
        return $this->db->resultSet();
    }

    public function tampilPengembalian(){
        $id=$_SESSION['user_id'];
        $querry="SELECT p.id_peminjaman as id,p.time as waktu ,sum(lb.qty) as jumlah, p.status as status
        FROM peminjaman as p inner join list_barang as lb on p.id_peminjaman=lb.id_peminjaman inner join barang as b on b.id_barang=lb.id_barang WHERE p.user_id='$id' and p.status='request';";
        $this->db->query($querry);
        return $this->db->resultSet();
    }


    public function tampilRincianRequestBarang($idBarang){
        $id=$_SESSION['user_id'];
        $querry="SELECT p.id_peminjaman as id,p.time as waktu,b.nama_barang as nama_barang,b.id_barang as id_barang ,lb.qty as jumlah, p.tgl_pinjam as tanggal_pinjam, p.tgl_kembali as tanggal_kembali, p.status as status
        FROM peminjaman as p inner join list_barang as lb on p.id_peminjaman=lb.id_peminjaman inner join barang as b on b.id_barang=lb.id_barang WHERE p.user_id='$id' and p.status='request' and p.id_peminjaman='$idBarang';";
        $this->db->query($querry);
        return $this->db->resultSet();
    }

    public function tampilHistory(){
        $id=$_SESSION['user_id'];
        $querry="SELECT m.nama_mhs AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id, p.keterangan AS keterangan FROM peminjaman AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN mahasiswa AS m ON m.nim = u.unicode
        WHERE p.status = 'done' OR p.status ='failed' AND p.user_id=$id
        UNION
        SELECT d.nama_dosen AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id, p.keterangan AS keterangan FROM peminjaman AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN dosen AS d ON d.nidn = u.unicode
        WHERE p.status = 'done' OR p.status ='failed' AND p.user_id=$id;";
        $this->db->query($querry);

        return $this->db->resultSet();
    }

    public function tampilProfile(){
        $id = $_SESSION['user_id'];
        $level=$_SESSION['level'];
        if($level=='Mahasiswa'){
            $query = "SELECT mhs.nama_mhs AS nama, mhs.nim AS unicode, mhs.jk AS jk, u.username AS username, u.email AS email, u.level as level FROM user AS u 
            INNER JOIN mahasiswa AS mhs ON mhs.nim = u.unicode where u.user_id = '$id'";
            $this->db->query($query);
            return $this->db->single();
        }else if($level=='Dosen'){
            $query = "SELECT d.nama_dosen AS nama, d.nidn AS unicode, d.jk AS jk, u.username AS username, u.email AS email, u.level as level FROM user AS u 
            INNER JOIN dosen AS d ON d.nidn = u.unicode where u.user_id = '$id'";
            $this->db->query($query);
            return $this->db->single();
        }
    }

    // Fungsi Fitur
    public function getNamaById($id){
     $level=$_SESSION['level'];
     if($level=='Mahasiswa'){
        $query="SELECT mhs.nama_mhs AS nama FROM user AS u INNER JOIN mahasiswa AS mhs ON mhs.nim = u.unicode WHERE u.user_id = '$id'";
        $this->db->query($query);
        return $this->db->single();
    }else if($level=='Dosen'){
        $query="SELECT dosen.nama_dosen AS nama FROM user AS u INNER JOIN dosen AS dosen ON dosen.nidn = u.unicode WHERE u.user_id = '$id'";
        $this->db->query($query);
        return $this->db->single();
    }

    }

    public function editProfile(){

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


}