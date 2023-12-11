<?php

class History_Model extends Controller {
    private $db;

    public function __construct(){
        $this->db=new Database;
    }
    public function getAllhistory(){
        $querry="SELECT m.nama_mhs AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id, p.keterangan AS keterangan FROM peminjaman AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN mahasiswa AS m ON m.nim = u.unicode
        WHERE p.status = 'done' OR p.status ='failed'
        UNION
        SELECT d.nama_dosen AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id, p.keterangan AS keterangan FROM peminjaman AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN dosen AS d ON d.nidn = u.unicode
        WHERE p.status = 'done' OR p.status ='failed'";
        $this->db->query($querry);

        return $this->db->resultSet();
    }
}