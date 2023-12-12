<?php

class Teknisi extends Admin {
    protected $nip;
    protected $namaTeknisi;
    protected $jenisKelamin;
    private $db;

	public function __construct()
	{
		$this->db = new Database;
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



    // public abstract function user($userId, $unicode, $email, $username, $password, $salt, $level);

    public function getnip() {
        return $this->nip;
    }

    public function setnip($nip) {
        $this->nip = $nip;
    }

    public function getnamaTeknisi() {
        return $this->namaTeknisi;
    }

    public function setnamaTeknisi($namaTeknisi) {
        $this->namaTeknisi = $namaTeknisi;
    }

    public function getjenisKelamin() {
        return $this->jenisKelamin;
    }

    public function setjenisKelamin($jenisKelamin) {
        $this->jenisKelamin = $jenisKelamin;
    }

}
?>