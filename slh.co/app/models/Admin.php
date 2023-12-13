<?php

require_once 'Aktor.php';
class Admin extends Aktor {

    protected $nip;
    protected $namaTeknisi;
    protected $jenisKelamin;

    public function __construct(){
        parent::__construct();
        $helper = new Helper();
        $result = $helper->ambilDataChild($_SESSION['unicode']);

        $this->nip = $result['nip'];
        $this->namaTeknisi = $result['nama_teknisi'];
        $this->jenisKelamin = $result['jk'];
    }

    // Fungsi Inti
    public function login() {
        return parent::login();
    }

    public function tampilSemuaAdmin(){ 
        $helper = new Helper();
        $result = $helper->tampilSemuaAdmin();
        return $result;
    }

    public function tampilSemuaBarang(){
        $helper = new Helper();
        $result = $helper->tampilSemuaBarang();
        return $result;
    }

    public function tampilSemuaPeminjaman(){
        $helper = new Helper();
        $result = $helper->tampilPeminjaman('progress');
        return $result;
    }
    public function tampilSemuaRequest(){
        $helper = new Helper();
        $result = $helper->tampilPeminjaman('request');
        return $result;
    }

    public function tampilSemuaPengembalian(){
        $helper = new Helper();
        $result = $helper->tampilPeminjaman('return');
        return $result;
    }

    public function tampilHistory(){
        $helper = new Helper();
        $result = $helper->tampilHistory();
        return $result;
    }

    public function tampilProfile(){
        $helper = new Helper();
        $result = $helper->tampilProfile();
        return $result;
    }

    public function logout() {
        parent::logout();
    }

    // Fungsi Fitur
    public function getNamaById($id){
        return parent::getNamaById($id);
    }

    public function hitungTotalBarang(){
        $helper = new Helper();
        $result = $helper->hitungTotalBarang();
        return $result;
    }

    public function totalBarangDipinjam(){
        $helper = new Helper();
        $result = $helper->totalBarangDipinjam();
        return $result;
    }

    public function hitungTotalUser() {
        $helper = new Helper();
        $result = $helper->hitungTotalUser();
        return $result;
    }

    public function cariBarang(){
        $helper = new Helper();
        $result = $helper->cariBarang();
        return $result;
    }

    public function tambahDataBarang($data) {
        $helper = new Helper();
        $result = $helper->tambahDataBarang($data);
        return $result;
    }

    public function hapusDataBarang($id_barang) {
        $helper = new Helper();
        $result = $helper->hapusDataBarang($id_barang);
        return $result;
    }

    public function editProfile($data){
        $helper = new Helper();
        $result = $helper->editProfile($data);
        return $result;
    }

    public function tampilRincianRequestBarang($idBarang){
        $helper = new Helper();
        $result = $helper->tampilDataRequestBarang($idBarang);
        return $result;
    }

    public function tampilRincianBarang($idBarang){
        $helper = new Helper();
        $result = $helper->tampilDataBarangProgress($idBarang);
        return $result;
    }
    
    public function tampilDataBarangProgress($idBarang){
        $helper = new Helper();
        $result = $helper->tampilDataBarangProgress($idBarang);
        return $result;
    }

}