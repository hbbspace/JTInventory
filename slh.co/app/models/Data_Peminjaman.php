<?php

class Data_Peminjaman extends Controller {
    private $table='peminjaman';
    private $db;

    public function __construct(){
        $this->db=new Database;
    }
    public function getAllPeminjaman(){
        $this->db->query("SELECT m.nama_mhs AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id FROM'. $this->table.' AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN mahasiswa AS m ON m.nim = u.unicode
        WHERE p.status = 'request'
        UNION
        SELECT d.nama_dosen AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id FROM'. $this->table.' AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN dosen AS d ON d.nidn = u.unicode
        WHERE p.status = 'request'");
        return $this->db->resultSet();
    }

}