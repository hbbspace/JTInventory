<?php

Class Koneksi {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "inventorydb";
    private $conn;

    public function koneksi();
}
date_default_timezone_set("Asia/Jakarta");
$koneksi = mysqli_connect("localhost", "root", "", "inventorydb");

if(mysqli_connect_errno()){
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>