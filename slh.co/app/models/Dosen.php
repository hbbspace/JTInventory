<?php

require_once 'User.php';
class Dosen extends User{

    protected $nip;
    protected $namaDosen;
    protected $jenisKelamin;

    public function __construct(){
        parent::__construct();
        $helper = new Helper();
        $result = $helper->ambilDataChild($_SESSION['unicode']);

        $this->nip = $result['nidn'];
        $this->namaDosen = $result['nama_dosen'];
        $this->jenisKelamin = $result['jk'];
    }
}
?>