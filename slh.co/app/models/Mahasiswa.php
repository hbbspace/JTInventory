<?php
class Mahasiswa extends User {

    protected $nip;
    protected $namaMhs;
    protected $jenisKelamin;

    public function __construct(){
        parent::__construct();
        $helper = new Helper();
        $result = $helper->ambilDataChild($_SESSION['unicode']);

        $this->nip = $result['nip'];
        $this->namaMhs = $result['nama_mhs'];
        $this->jenisKelamin = $result['jk'];
    }
}
?>