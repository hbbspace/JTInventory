<?php

class Register_Model{
    private $db;

    public function __construct(){
        $this->db=new Database;
    }
    public function tambahDataUser($data) {
        $password = $data['password'];
        $salt = bin2hex(random_bytes(16));
        $combined_password = $salt . $password;
        $hashed_password = password_hash($combined_password, PASSWORD_BCRYPT);
        $data['password'] = $hashed_password;
    
        if (
            $data['nama'] != null &&
            $data['unicode'] != null &&
            $data['jenis_kelamin'] != null &&
            $data['email'] !== "null" &&
            $data['username'] != null &&
            $data['password'] != null &&
            $data['level'] !== "null"
        ) {
            $query = "INSERT INTO user VALUES ('', :unicode, :email, :username, :password, :salt, :level)";
    
            $this->db->query($query);
            $this->db->bind('unicode', $data['unicode']);
            $this->db->bind('email', $data['email']);
            $this->db->bind('username', $data['username']);
            $this->db->bind('password', $data['password']); // Ubah ke hashed_password
            $this->db->bind('salt', $salt);
            $this->db->bind('level', $data['level']);
            $this->db->execute();
            if($data['level']=='Mahasiswa'){
                $query2 = "INSERT INTO mahasiswa VALUES (:nim, :nama_mhs, :jk)";
                $this->db->query($query2);
                $this->db->bind('nim', $data['unicode']);
                $this->db->bind('nama_mhs', $data['nama']);
                $this->db->bind('jk', $data['jenis_kelamin']);
                $this->db->execute();
                return 1;
            }else if($data['level']=='Dosen'){
                $query2 = "INSERT INTO dosen VALUES (:nidn, :nama_dosen, :jk)";
                $this->db->query($query2);
                $this->db->bind('nidn', $data['unicode']);
                $this->db->bind('nama_dosen', $data['nama']);
                $this->db->bind('jk', $data['jenis_kelamin']);
                $this->db->execute();
                return 1;
            }else{
                Flasher::setMessage('Gagal', 'Registrasi Karena data tidak Valid', 'danger');
                return 0;
            }
        } else {
            return 0;
        }
    }
}