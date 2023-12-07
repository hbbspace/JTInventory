<?php
class Dosen extends User {
    private $nidn;
    private $namaDosen;
    private $jenisKelamin;

    public function Dosen($userId, $unicode, $email, $username, $password, $salt, $level, $nidn, $namaDosen, $jenisKelamin) {
        parent::User($userId, $unicode, $email, $username, $password, $salt, $level);
        $this->nidn = $nidn;
        $this->namaDosen = $namaDosen;
        $this->jenisKelamin = $jenisKelamin;
    }

    public function getnidn() {
        return $this->nidn;
    }

    public function setnidn($nidn) {
        $this->nidn = $nidn;
    }

    public function getnamaDosen() {
        return $this->namaDosen;
    }

    public function setnamaDosen($namaDosen) {
        $this->namaDosen = $namaDosen;
    }

    public function getjenisKelamin() {
        return $this->jenisKelamin;
    }

    public function setjenisKelamin($jenisKelamin) {
        $this->jenisKelamin = $jenisKelamin;
    }

    // Metode tambahan untuk dosen
    public function meminjamBarang() {
        // Implementasi peminjaman barang
    }

    public function mengembalikanBarang() {
        // Implementasi pengembalian barang
    }

    public function mencariBarang() {
        // Implementasi pencarian barang
    }

    public function mengurutkanBarang() {
        // Implementasi pengurutan barang
    }

    public function melihatHistory() {
        // Implementasi melihat history
    }

    public function mengaturAkun() {
        // Implementasi mengatur akun
    }
}

?>