<?php

class List_Barang {
    private $barang;

    public function __construct((Barang)$barang) {
        $this->barang = $barang();
    }

    public function getBarang() {
        return $this->barang;
    }
}