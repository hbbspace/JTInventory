<?php

abstract class Aktor {
    protected $userId;
    protected $unicode;
    protected $email;
    protected $username;
    protected $password;
    protected $salt;
    protected $level;

	public function __construct() {
        $helper = new Helper();
        $result = $helper->ambilDataParent($_SESSION['user_id']);
        
        $this->userId = $result['user_id'];
        $this->unicode = $result['unicode'];
        $this->email = $result['email'];
        $this->username = $result['username'];
        $this->password = $result['password'];
        $this->salt = $result['salt'];
        $this->level = $result['level'];
    }

    // Fungsi Inti
    public function login(){
        $helper = new Helper();
        $result = $helper->checkLogin();
        return $result;
    }

    public abstract function tampilHistory();

    public abstract function tampilProfile();

    public function hapusAkun($data){
        $helper = new Helper();
        $result = $helper->hapusUser($data);
        return $result;
    }

    public function logout() {
        session_destroy();
        header("Location:http://localhost/dasarWeb/JTInventory/slh.co/public/");
    }

    // Fungsi Pendukung
    public function getNamaById($id){
        $helper = new Helper();
        $result = $helper->getNamaById($id);
        return $result;
    }
}
?>