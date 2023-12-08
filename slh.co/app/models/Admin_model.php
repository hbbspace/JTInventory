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
    public function tambahDataAdmin($data) {
        $password=$data['password'];
        $salt = bin2hex(random_bytes(16));
        $combined_password = $salt . $password;
        $hashed_password = password_hash($combined_password, PASSWORD_BCRYPT);
        $data['password']=$hashed_password;
        if($data['nama'] != null && $data['nip'] != null && $data['jenis_kelamin'] != "null" && $data['email'] != "null" 
        && $data['username'] != null && $data['password'] != null){
            $query = "INSERT INTO user VALUES ( '',:unicode, :email, :username, :password, :salt, :level)";
    
            $this->db->query($query);
            $this->db->bind('unicode', $data['nip']);
            $this->db->bind('email', $data['email']);
            $this->db->bind('username', $data['username']);
            $this->db->bind('password', $data['password']);
            $this->db->bind('salt', $salt);
            $this->db->bind('level', 'Teknisi');
    
            $this->db->execute();
            $query = "INSERT INTO teknisi VALUES (:nip, :nama_teknisi, :jk)";
            $this->db->query($query);
            $this->db->bind('nip', $data['nip']);
            $this->db->bind('nama_teknisi', $data['nama']);
            $this->db->bind('jk', $data['jenis_kelamin']);
            $this->db->execute();

        }else{
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