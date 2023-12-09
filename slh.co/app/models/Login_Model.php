<?php

class Login_Model {
	
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

	// public function checkLogin($data) {
        
    //     $this->db->query('SELECT user_id,unicode, username, level, salt, password as hashed_password FROM user WHERE username = :username AND password = :password');
	// 	$this->db->bind('username', $data['username']);
	// 	$this->db->bind('password', $data['password']);
	// 	$this->db->resultSet();
	// 	$salt=$data['salt'];
	// 	$hashed_password=$data['hashed_password'];
	// 	if($salt!=null&&$hashed_password!=null){
	// 		$combined_password = $salt . $data['password'];
	// 		if(password_verify($combined_password, $hashed_password)){
	// 			return $this->db->rowCount();
	// 		}else{
	// 			return 0;
	// 		}
			
	// 	}else{
    //       return 0;
	// 	}
	// }


	public function checkLogin($data)
	{
		$query = "SELECT user_id, unicode, username, level, salt, password FROM user WHERE username = :username";
		$this->db->query($query);
		$this->db->bind('username', $data['username']);
		$result = $this->db->single();
	
		if ($result) {
			$salt = $result['salt'];
			$hashed_password = $result['password'];
	
			if ($hashed_password != null && $salt != null) {
				$combined_password = $salt . $data['password'];
				//password verify belum bisa, karena data mungkin tidak cocok
				if (password_verify($combined_password, $hashed_password)) {
					return $this->db->rowCount();
				} else {
					return 1;
				}
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}
	
	
}