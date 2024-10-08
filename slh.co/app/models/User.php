<?php

require_once 'Aktor.php';
require_once 'Create_Delete.php';
abstract class User extends Aktor implements Create_Delete{

    public function __construct(){
        parent::__construct();
    }

    // Fungsi Inti
    public function Register($data) {
        $helper = new Helper();
        $result = $helper->tambahDataUser($data);
        return $result;
    }

    public function login() {
        return parent::login();
    }

    public function tampilSemuaBarang(){
        $helper = new Helper();
        $result = $helper->tampilSemuaBarang();
        return $result;
    }
    
    public function tampilRequestBarang(){
        $helper = new Helper();
        $result = $helper->tampilPeminjaman('request');
        return $result;
    }

    public function tampilPeminjaman(){
        $helper = new Helper();
        $result = $helper->tampilPeminjaman('progress');
        return $result;
    }

    public function tampilPengembalian(){
        $helper = new Helper();
        $result = $helper->tampilPeminjaman('return');
        return $result;
    }
    
    public function tampilPeminjamanSemuaStatus(){
        $helper = new Helper();
        $result = $helper->tampilPeminjamanSemuaStatus();
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

    public function cariBarang(){
        $helper = new Helper();
        $result = $helper->cariBarang();
        return $result;
    }

    public function tampilRincianRequestBarang($idBarang,$status){
        $helper = new Helper();
        $result = $helper->tampilDataBarang($idBarang,$status);
        return $result;
    }

    public function tampilRincianProgressBarang($idBarang,$status){
        $helper = new Helper();
        $result = $helper->tampilDataBarang($idBarang,$status);
        return $result;
    }

    public function tampilRincianReturnBarang($idBarang,$status){
        $helper = new Helper();
        $result = $helper->tampilDataBarang($idBarang,$status);
        return $result;
    }

    public function tampilRincianHistoryBarang($idBarang){
        $helper = new Helper();
        $result = $helper->tampilDataBarangHistory($idBarang);
        return $result;
    }

    public function tambahDataPeminjamanBarang($data){
        $helper = new Helper();
        $result = $helper->tambahDataPeminjamanBarang($data);
        return $result;
    }

    public function Return($id){
        $helper = new Helper();
        $result = $helper->Return($id);
        return $result;
    }
    
    public function hitungBarangDipinjamForUser(){
        $helper = new Helper();
        $result = $helper->hitungBarangDipinjamForUser();
        return $result;
    }
    
    public function tambahDataAdmin($data) {
        $password=$data['password'];
        $salt = bin2hex(random_bytes(16));
        $combined_password = $salt . $password;
        $hashed_password = password_hash($combined_password, PASSWORD_BCRYPT);
        $data['password']=$hashed_password;
        if($data['nama'] != null && $data['nip'] != null && $data['jenis_kelamin'] != "null" && $data['email'] != "null" 
        && $data['username'] != null && $data['password'] != null){
            $query = "INSERT INTO user VALUES ( '',:unicode, :email, :username, :password, :salt, :level)";
        }
    }

    public function deleteRequest($id){
        $helper = new Helper();
        $result = $helper->deleteRequest($id);
        return $result;        
    }
    
    public function cekKeterlambatan($id){
        $helper = new Helper();
        $result = $helper->Telat($id);
        return $result;        
    }

    // Implements Interface
    public function tambah($data){
        $this->Register($data);
    }

    public function hapus($data) {
        $this->hapusAkun($data);
    }
    
}