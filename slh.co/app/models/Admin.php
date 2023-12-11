<?php

class Admin {


    protected $nip;
    protected $namaTeknisi;
    protected $jenisKelamin;

    protected $db;

    public function __construct(){

        $this->db=new Database;
    }

    // Fungsi Inti
    public function tampilSemuaAdmin(){
        $query="SELECT * FROM teknisi;";

        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function tampilSemuaBarang(){
        $query="SELECT* FROM barang;";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function tampilSemuaPeminjaman(){
        $query="SELECT m.nama_mhs AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id FROM peminjaman AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN mahasiswa AS m ON m.nim = u.unicode
        WHERE p.status = 'request'
        UNION
        SELECT d.nama_dosen AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id FROM peminjaman AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN dosen AS d ON d.nidn = u.unicode
        WHERE p.status = 'request'";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function tampilSemuaPengembalian(){
        $querry="SELECT m.nama_mhs AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id FROM peminjaman AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN mahasiswa AS m ON m.nim = u.unicode
        WHERE p.status = 'progress'
        UNION
        SELECT d.nama_dosen AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id FROM peminjaman AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN dosen AS d ON d.nidn = u.unicode
        WHERE p.status = 'progress'";
        $this->db->query($querry);
        return $this->db->resultSet();
    }

    public function tampilHistory(){
        $querry="SELECT m.nama_mhs AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id, p.keterangan AS keterangan FROM peminjaman AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN mahasiswa AS m ON m.nim = u.unicode
        WHERE p.status = 'done' OR p.status ='failed'
        UNION
        SELECT d.nama_dosen AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id, p.keterangan AS keterangan FROM peminjaman AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN dosen AS d ON d.nidn = u.unicode
        WHERE p.status = 'done' OR p.status ='failed';";
        $this->db->query($querry);

        return $this->db->resultSet();
    }

    public function tampilProfile(){
        $id = $_SESSION['user_id'];
        $level=$_SESSION['level'];

        $query = "SELECT t.nama_teknisi AS nama , t.nip AS nip, t.jk AS jk, u.username AS username, u.email AS email, u.level as level FROM user AS u 
        INNER JOIN teknisi AS t ON t.nip = u.unicode WHERE u.level = '$level' AND u.user_id = '$id'";
        $this->db->query($query);
        return $this->db->single();
        
    }

    // Fungsi Fitur
    public function getNamaById($id){
      $query="SELECT t.nama_teknisi AS nama FROM user AS u INNER JOIN teknisi AS t ON t.nip = u.unicode WHERE u.user_id = '$id'";
      $this->db->query($query);
      return $this->db->single();
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

    public function hapusDataBarang($id_barang) {
        $query = "DELETE FROM barang WHERE id_barang = :id_b";
        $this->db->query($query);
        $this->db->bind('id_b', $id_barang);

        $this->db->execute();

        return $this->db->rowCount();
    }
}