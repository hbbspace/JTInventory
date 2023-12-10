<?php
// Abstract class Aktor
abstract class Aktor{
    protected $userId;
    protected $unicode;
    protected $email;
    protected $username;
    protected $password;
    protected $salt;
    protected $level;

    private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

    public function LogIn($data){
		$query = "SELECT user_id, unicode, username, level, salt, password as hashed_password FROM user WHERE username = :username";
		$this->db->query($query);
		$this->db->bind('username', $data['username']);
		$result = $this->db->single();        
        $userId=$result['user_id'];
        $unicode=$result ['result'];
        $email =$result['email'];
        $username =$result ['username'];
        $password =$result ['password'];
        $salt=$result ['salt'];
        $level =$result ['level'];
    }

    public abstract function TampilDataBarang();
    public abstract function TampilPeminjaman();
    public abstract function TampilPengembalian();
    public abstract function TampilAkun();
    public abstract function TampilHistory();


    // public abstract function user($userId, $unicode, $email, $username, $password, $salt, $level);

    public function getuserId() {
        return $this->userId;
    }

    public function setuserId($userId) {
        $this->userId = $userId;
    }

    public function getunicode() {
        return $this->unicode;
    }

    public function setunicode($unicode) {
        $this->unicode = $unicode;
    }

    public function getemail() {
        return $this->email;
    }

    public function setemail($email) {
        $this->email = $email;
    }

    public function getusername() {
        return $this->username;
    }

    public function setusername($username) {
        $this->username = $username;
    }

    public function getpassword() {
        return $this->password;
    }

    public function setpassword($password) {
        $this->password = $password;
    }

    public function getsalt() {
        return $this->salt;
    }

    public function setsalt($salt) {
        $this->salt = $salt;
    }

    public function getlevel() {
        return $this->level;
    }

    public function setlevel($level) {
        $this->level = $level;
    }
}
?>