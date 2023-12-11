<?php

class Login_Model {
	
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}


	public function checkLogin()
	{
		$query = "SELECT user_id, unicode, username, level, salt, password as hashed_password FROM user WHERE username = :username";
		$this->db->query($query);
		$this->db->bind('username', $_POST['username']);
		$result = $this->db->single();
		$salt = $result['salt'];
		$hashed_password = $result['hashed_password'];
		if ($hashed_password != null && $salt != null) {
			$combined_password = $salt . $_POST['password'];
			if (password_verify($combined_password, $hashed_password)) {
				return $result;
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}
	
	
}