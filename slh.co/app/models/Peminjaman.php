<?php

require_once 'Create_Delete.php';
class Peminjaman implements Create_Delete{
    private $idPeminjaman;
    private $time;
    private $tglPinjam;
    private $tglKembali;
    private $listBarang;
    private $keterangan;
    private $namaFile;
    private $status;

    public function __construct((Barang)$listBarang, $idPeminjaman, $time, $tglPinjam, $tglKembali, $keterangan, $namaFile, $status) {
        $this->listBarang = $listBarang();
        $this->idPeminjaman = $idPeminjaman;
        $this->time = $time;
        $this->tglPinjam = $tglKembali;
        $this->tglKembali = $tglKembali;
        $this->keterangan = $keterangan;
        $this->namaFile = $namaFile;
        $this->status = $status;
    }

    // Setter
    public function setIdPeminjaman($input) {
        $this->idPeminjaman = $input;
    }
    
    public function setTime($input) {
        $this->time = $input;
    }
    
    public function setTglPinjam($input) {
        $this->tglPinjam = $input;
    }

    public function setTglKembali($input) {
        $this->tglKembali = $input;
    }

    public function setListBarang((Barang)$input) {
        $this->listBarang = $input();
    }

    public function setKeterangan($input) {
        $this->keterangan = $input;
    }

    public function setNamaFile($input) {
        $this->namaFile = $input;
    }

    public function setStatus($input) {
        $this->status = $input;
    }

    
    // Getter
    public function getIdPeminjaman() {
        return $this->idPeminjaman;
    }
    
    public function getTime() {
        return $this->time;
    }
    
    public function getTglPinjam() {
        return $this->tglPinjam;
    }

    public function getTglKembali() {
        return $this->tglKembali;
    }

    public function getListBarang() {
        return $this->listBarang;
    }

    public function getKeterangan() {
        return $this->keterangan;
    }

    public function getNamaFile() {
        return $this->namaFile;
    }

    public function getStatus() {
        return $this->status;
    }

    // Fungsi tambahan
    public function tambah($data){
        $this->__construct($data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8]);
    }

    public function hapus($id) {
        $helper = new Helper();
        $result = $helper->deleteRequest($id);
        return $result;
    }
}