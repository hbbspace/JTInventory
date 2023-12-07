<?php

// Abstract class Admin yang merupakan turunan dari Aktor
abstract class Admin extends Aktor {
    private $nip;
    private $namaTeknisi;
    private $jenisKelamin;

    public function __construct($userId, $unicode, $email, $username, $password, $salt, $level, $nip, $namaTeknisi, $jenisKelamin) {
        parent::__construct($userId, $unicode, $email, $username, $password, $salt, $level);
        $this->nip = $nip;
        $this->namaTeknisi = $namaTeknisi;
        $this->jenisKelamin = $jenisKelamin;
    }

    public abstract function manageDataItem();

    public abstract function konfirmasiPeminjamanBarang();

    public abstract function konfirmasiPengembalianBarang();

    public abstract function mencariBarang();

    public abstract function mengurutkanBarang();

    public abstract function melihatHistory();

    public abstract function mengaturAkun();
}
?>