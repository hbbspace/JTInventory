<?php
session_start();
if (!empty($_SESSION['username'])) {
    require '../config/koneksi.php';
    require '../fungsi/pesan_kilat.php';
    require '../fungsi/anti_injection.php';
    if (!empty($_GET['list_admin'])) {
        $id = antiinjection($koneksi, $_GET['id']); 
        $queryDelAdmin = "DELETE FROM teknisi WHERE nip = '$id'";
        if (mysqli_query($koneksi, $queryDelAdmin)) {
            $queryDelTeknisi = "DELETE FROM user WHERE unicode = '$id'";
            if (mysqli_query($koneksi, $queryDelTeknisi)) {
                pesan('success', "Admin Telah Terhapus.");
            } else {
                pesan('warning', "Data User Terhapus Tetapi Data Teknisi Tidak Terhapus Karena: " . mysqli_error($koneksi));
            }
        } else {
            pesan('danger', "Teknisi Tidak Terhapus Karena" . mysqli_error($koneksi));
        }
        header("Location: ../index.php?page=list_admin");
    } elseif (!empty($_GET['barang'])) {
        $id = antiinjection($koneksi, $_GET['id']);
        $queryDelBar = "DELETE FROM barang WHERE id_barang = '$id'";
        if (mysqli_query($koneksi, $queryDelBar)) {
            pesan('success', "Barang Telah Terhapus.");
        } else {
            pesan('danger', "Barang Tidak Terhapus Karena: " . mysqli_error($koneksi));
        }
        header("Location: ../index.php?page=barang");
    }
}
?>