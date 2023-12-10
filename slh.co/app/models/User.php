<?php

abstract class User extends Aktor{
    protected $jenisKelamin;

    public function getJenisKelamin() {
        return $this->jenisKelamin;
    }

    public function setJenisKelamin($jenisKelamin) {
        $this->jenisKelamin = $jenisKelamin;
    }

    public function meminjamBarang() {

    }

    public function mengembalikanBarang() {

    }

    public function uploadKTM() {

    }

    public function mencariBarang() {

    }

    public function mengurutkanBarang() {

    }

    public function melihatStory() {

    }

    public function mengaturAkun() {

    }
}