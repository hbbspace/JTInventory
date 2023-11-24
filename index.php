<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_SESSION['level'])) {
    require 'config/koneksi.php';
    require 'fungsi/pesan_kilat.php';
    if ($_SESSION['level'] == 'Mahasiswa' || $_SESSION['level'] == 'Dosen') {
        include 'user/template/header.php';
        if (!empty($_GET['page'])) {
            include 'user/module/' . $_GET['page'] . '/index.php';
        } else {
            include 'user/template/home.php';
        }
        include 'user/template/footer.php';
    } else {
        include 'admin/template/header.php';
        if (!empty($_GET['page'])) {
            include 'admin/module/' . $_GET['page'] . '/index.php';
        } else {
            include 'admin/template/home.php';
        }
        include 'admin/template/footer.php';
    }
} else {
    header("Location: login.php");
}
?>
