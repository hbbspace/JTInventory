<?php

require_once 'Admin.php';
class Teknisi extends Admin {
	protected $nip;
	protected $namaTeknisi;
	protected $jenisKelamin;

	public function __construct() {
		parent::__construct();
		$helper = new Helper();
        $result = $helper->ambilDataChild($_SESSION['unicode']);

        $this->nip = $result['nip'];
        $this->namaTeknisi = $result['nama_teknisi'];
        $this->jenisKelamin = $result['jk'];
	}
}
?>