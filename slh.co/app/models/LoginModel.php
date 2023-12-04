<?php

class LoginModel {
	
	//private $table = 'user';
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

	public function checkLogin($data) {
        require_once 'config/koneksi.php';
		$username = antiinjection($koneksi, $_POST['username']);
        // $password = antiinjection($koneksi, $_POST['password']);

        $query = "SELECT user_id,unicode, username, level, salt, password as hashed_password FROM user WHERE username = '$username'";
        $this->db->query($query);
		$this->db->bind('username', $data['username']);
		$this->db->bind('password', md5($data['password']));
		//$this->db->execute();
		//return $this->db->rowCount();
		$data =  $this->db->single();
		return $data;
	}

}