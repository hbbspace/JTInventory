<?php

class Login_Model {
	
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

	public function checkLogin($username, $password) {
		//$username = antiinjection($koneksi, $_POST['username']);
        // $password = antiinjection($koneksi, $_POST['password']);

        $this->db->query('SELECT user_id,unicode, username, level, salt, password as hashed_password FROM user WHERE username = :$username');
		$this->db->bind('username', $username);
		$this->db->bind('password', md5($password));
		return $this->db->resultSet();
		
		//$this->db->execute();
		//return $this->db->rowCount();
		// $data =  $this->db->single();
		// return $data;
	}
}