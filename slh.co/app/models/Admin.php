<?php

require_once 'Aktor.php';
abstract class Admin extends Aktor {

    public function __construct(){
        parent::__construct();
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

    public function editProfile($data){
        $helper = new Helper();
        $result = $helper->editProfile($data);
        return $result;
    }

    public function hapusAkun($data){
        $helper = new Helper();
        $result = $helper->hapusUser($data);
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

    public function tampilRincianRequestBarang($idBarang,$status){
        $helper = new Helper();
        $result = $helper->tampilDataBarang($idBarang,$status);
        return $result;
    }

    public function tampilRincianBarangHistory($idBarang){
        $helper = new Helper();
        $result = $helper->tampilDataBarangHistory($idBarang);
        return $result;
    }
    
    public function tampilDataBarangProgress($idBarang,$status){
        $helper = new Helper();
        $result = $helper->tampilDataBarang($idBarang,$status);
        return $result;
    }
    
    public function AcceptedRequest($id){
        $helper = new Helper();
        $result = $helper->AcceptedRequest($id);
        return $result;
    }
    
    public function RejectRequest($id){
        $helper = new Helper();
        $result = $helper->RejectRequest($id);
        return $result;
    }

    public function AcceptedReturn($id){
        $helper = new Helper();
        $result = $helper->AcceptedReturn($id);
        return $result;
    }
    
    public function RejectReturn($id){
        $helper = new Helper();
        $result = $helper->RejectReturn($id);
        return $result;
    }
    
    public function UpdateStok($id,$status){
        $helper = new Helper();
        $result = $helper->UpdateStok($id,$status);
        return $result;
    }

    public function tampilRincianBarangReturn($id,$status){
        $helper = new Helper();
        $result = $helper->tampilDataBarang($id,$status);
        return $result;
    }

    public function tambahDataKeterangan($keterangan){
        $helper = new Helper();
        $result = $helper->tambahDataKeterangan($keterangan);
        return $result;
    }
    

}