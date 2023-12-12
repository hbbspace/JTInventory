<?php

class Dosen extends User{
    
    protected $nidn;
    protected $NamaDosen;
    private $db;

    public function __construct(){
        $this->db=new Database;
    }

    public function getJenisKelamin() {
        return $this->jenisKelamin;
    }

    public function Teknisi($data){
		$query = "SELECT nip, nama_teknisi, jk FROM teknisi WHERE username = :username";
		$this->db->query($query);
		$this->db->bind('username', $data['username']);
		$result = $this->db->single();        
        $nip=$result['nip'];
        $namaTeknisi=$result ['nama_teknisi'];
        $jenisKelamin =$result['jk'];
    }

    public function setJenisKelamin($jenisKelamin) {
        $this->jenisKelamin = $jenisKelamin;
    }

    public function TampilPeminjaman(){
        $querry="SELECT m.nama_mhs AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id FROM peminjaman AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN mahasiswa AS m ON m.nim = u.unicode
        WHERE p.status = 'request'
        UNION
        SELECT d.nama_dosen AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id FROM peminjaman AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN dosen AS d ON d.nidn = u.unicode
        WHERE p.status = 'request'";
        $this->db->query($querry);

        return $this->db->resultSet();
    }
    public function TampilPengembalian(){
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
    public function TampilAkun(){
        
    }
    public function TampilHistory(){
        $querry="SELECT m.nama_mhs AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id, p.keterangan as keterangan FROM peminjaman AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN mahasiswa AS m ON m.nim = u.unicode
        WHERE p.status = 'done' OR p.status ='failed'
        UNION
        SELECT d.nama_dosen AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id, p.keterangan as keterangan FROM peminjaman AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN dosen AS d ON d.nidn = u.unicode
        WHERE p.status = 'done' OR p.status ='failed'";
        $this->db->query($querry);

        return $this->db->resultSet();
    }
    // public function meminjamBarang() {

    // }

    // public function mengembalikanBarang() {

    // }

    // // public function uploadKTM() {

    // // }

    // public function mencariBarang() {

    // }

    // public function mengurutkanBarang() {

    // }

    // public function melihatStory() {

    // }

    // public function mengaturAkun() {

    // }
}