<?php

class Admin_model {
    private $db;

    public function __construct(){
        $this->db=new Database;
    }
    public function getAlladmin(){
        $query="SELECT* FROM teknisi;";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getAllBarang(){
        $query="SELECT* FROM barang;";
        $this->db->query($query);
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
    
    public function hapusDataAdmin($nip) {
        $query = "DELETE FROM user WHERE unicode = ':nip'";
        $this->db->query($query);
        $this->db->bind('unicode', $nip);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getAllPeminjaman(){
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

    public function getNamaById($id){
      $query="SELECT t.nama_teknisi AS nama FROM user AS u INNER JOIN teknisi AS t ON t.nip = u.unicode WHERE u.user_id = '$id'";
      $this->db->query($query);
      return $this->db->single();
    }
    
    public function getRincianProfile(){
        $id = $_SESSION['user_id'];
        $level=$_SESSION['level'];

        $query = "SELECT t.nama_teknisi AS nama , t.nip AS nip, t.jk AS jk, u.username AS username, u.email AS email, u.level as level FROM user AS u 
        INNER JOIN teknisi AS t ON t.nip = u.unicode WHERE u.level = '$level' AND u.user_id = '$id'";
        $this->db->query($query);
        return $this->db->single();
        
    }

    public function getAllHistory(){
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



}