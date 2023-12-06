<?php

class History_Model extends Controller {
    private $table='peminjaman';
    private $db;

    public function __construct(){
        $this->db=new Database;
    }
    public function getAllhistory(){
        $this->db->query("SELECT m.nama_mhs AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id FROM'. $this->table.' AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN mahasiswa AS m ON m.nim = u.unicode
        WHERE p.status = 'done' OR p.status = 'failed'
        UNION
        SELECT d.nama_dosen AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id FROM'. $this->table.' AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN dosen AS d ON d.nidn = u.unicode
        WHERE p.status = 'done' OR p.status = 'failed'");
        return $this->db->resultSet();
    }
}