<?php

class Data_Pengembalian_Model   {
    private $db;

    public function __construct(){
        $this->db=new Database;
    }
    public function getAllPengembalian(){
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

}