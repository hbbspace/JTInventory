<?php

require_once 'Aktor.php';
class User extends Aktor {

    public function __construct(){
        parent::__construct();
    }

    // Fungsi Inti
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

    public function cariBarang(){
        $helper = new Helper();
        $result = $helper->cariBarang();
        return $result;
    }

    public function tampilRincianRequestBarang($idBarang){
        $helper = new Helper();
        $result = $helper->tampilDataRequestBarang($idBarang);
        return $result;
    }

    public function editProfile(){

    }
}