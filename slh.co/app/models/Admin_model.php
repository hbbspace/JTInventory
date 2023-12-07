<?php

class Admin_model {
    private $table='teknisi';
    private $table1='barang';
    private $table2='peminjaman';
    private $db;

    public function __construct(){
        $this->db=new Database;
    }
    public function getAlladmin(){
        $this->db->query('SELECT * FROM '.$this->table);
        return $this->db->resultSet();
    }

    public function getAllBarang(){
        $this->db->query('SELECT * FROM '.$this->table1);
        return $this->db->resultSet();
    }
    public function tambahDataBarang($data) {
        $query = "INSERT INTO barang VALUES (:nama_barang, :id_barang, :maintener, :qty)";

        $this->db->query($query);
        $this->db->bind('nama_barang', $data['nama_barang']);
        $this->db->bind('id_barang', $data['id_barang']);
        $this->db->bind('maintener', $data['maintener']);
        $this->db->bind('qty', $data['qty']);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function hapusDataBarang($id_barang) {
        $query = "DELETE FROM barang WHERE id_barang = :id_b";
        $this->db->query($query);
        $this->db->bind('id_b', $id_barang);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getAllPeminjaman(){
        $this->db->query("SELECT m.nama_mhs AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id FROM'. $this->table2.' AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN mahasiswa AS m ON m.nim = u.unicode
        WHERE p.status = 'request'
        UNION
        SELECT d.nama_dosen AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id FROM'. $this->table2.' AS p
        INNER JOIN user AS u ON u.user_id = p.user_id
        INNER JOIN dosen AS d ON d.nidn = u.unicode
        WHERE p.status = 'request'");
        return $this->db->resultSet();
    }


}