<?php
class Mahasiswa extends User {
    private $nim;
    private $namaMHS;
    private $jenisKelamin;

    public function Mahasiswa($userId, $unicode, $email, $username, $password, $salt, $level, $nim, $namaMHS, $jenisKelamin) {
        parent::User($userId, $unicode, $email, $username, $password, $salt, $level);
        $this->nim = $nim;
        $this->namaMHS = $namaMHS;
        $this->jenisKelamin = $jenisKelamin;
    }

    public function getnim() {
        return $this->nim;
    }

    public function setnim($nim) {
        $this->nim = $nim;
    }

    public function getnamaMHS() {
        return $this->namaMHS;
    }

    public function setnamaMHS($namaMHS) {
        $this->namaMHS = $namaMHS;
    }

    public function setjenisKelamin($jenisKelamin) {
        $this->jenisKelamin = $jenisKelamin;
    }

    // Metode tambahan untuk mahasiswa
    public function manageDataItem() {
        // Implementasi manajemen data barang
    }

    public function meminjamBarang() {
        // Implementasi peminjaman barang
    }

    public function uploadKTM() {
        // Implementasi upload KTM
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