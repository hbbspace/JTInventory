<?php
// Abstract class Aktor
abstract class Aktor extends Controller {
    protected $userId;
    protected $unicode;
    protected $email;
    protected $username;
    protected $password;
    protected $salt;
    protected $level;

    
    public function __construct($userId, $unicode, $email, $username, $password, $salt, $level) {
        $this->userId = $userId;
        $this->unicode = $unicode;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->salt = $salt;
        $this->level = $level;
    }

    public abstract function user($userId, $unicode, $email, $username, $password, $salt, $level);

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