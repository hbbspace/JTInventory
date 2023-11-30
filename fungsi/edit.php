<?php
session_start();
if (!empty($_SESSION['username'])) {
    require '../config/koneksi.php';
    require '../fungsi/pesan_kilat.php';
    require '../fungsi/anti_injection.php';
    // Edit Akun
    if (!empty($_GET['akun'])) {
        $nama = antiinjection($koneksi, $_POST['nama']);
        $jenis_kelamin = antiinjection($koneksi, $_POST['jk']);
        $email = antiinjection($koneksi, $_POST['email']);
        $username = antiinjection($koneksi, $_POST['username']);
        $password = antiinjection($koneksi, $_POST['password']);
        // $level = antiinjection($koneksi, $_POST['level']);
        $id=$_SESSION['user_id'];
        $unicode=$_SESSION['unicode'];

        $salt = bin2hex(random_bytes(16));
        $combined_password = $salt . $password;
        $hashed_password = password_hash($combined_password, PASSWORD_BCRYPT);

        $query = "UPDATE user SET email = '$email', username = '$username', password = '$hashed_password', salt = '$salt' WHERE user_id = '$id';";
        mysqli_query($koneksi, $query);
        if ($_SESSION['level'] === 'Teknisi') {
            $query2 = "UPDATE teknisi SET nama_teknisi = '$nama', jk = '$jenis_kelamin' WHERE nip = '$unicode';";
        } else if ($_SESSION['level'] === 'Mahasiswa') {
            $query2 = "UPDATE mahasiswa SET nama_mhs = '$nama', jk = '$jenis_kelamin' WHERE nim = '$unicode';";
        } else if ($_SESSION['level'] === 'Dosen') {
            $query2 = "UPDATE dosen SET nama_dosen = '$nama', jk = '$jenis_kelamin' WHERE nidn = '$unicode';";
        }

        if (mysqli_query($koneksi, $query2)) {
            pesan('success', "Data Telah Diubah.");
        } else {
            pesan('danger', "Gagal Mengubah Data Karena: " . mysqli_error($koneksi));
        }
        header("Location: ../index.php?page=akun");
    //edit admin
    } elseif (!empty($_GET['list_admin'])) {
        $nama = antiinjection($koneksi, $_POST['nama']);
        $jenis_kelamin = antiinjection($koneksi, $_POST['jk']);
        $email = antiinjection($koneksi, $_POST['email']);
        $username = antiinjection($koneksi, $_POST['username']);
        $password = antiinjection($koneksi, $_POST['password']);
        $unicode = antiinjection($koneksi, $_POST['unicode']);
        $id = $_GET['id'];

        $salt = bin2hex(random_bytes(16));
        $combined_password = $salt . $password;
        $hashed_password = password_hash($combined_password, PASSWORD_BCRYPT);

        $query = "UPDATE user SET email = '$email', username = '$username', password = '$hashed_password', salt = '$salt' WHERE unicode = '$unicode';";
        mysqli_query($koneksi, $query);
        $query2 = "UPDATE teknisi SET nama_teknisi = '$nama', jk = '$jenis_kelamin' WHERE nip = '$unicode';";

        if (mysqli_query($koneksi, $query2)) {
            pesan('success', "Data Telah Diubah.");
        } else {
            pesan('danger', "Gagal Mengubah Data Karena: " . mysqli_error($koneksi));
        }
        header("Location: ../index.php?page=list_admin");
    //edit barang
    } else if(!empty($_GET['barang'])){
        $id_barang = antiinjection($koneksi, $_POST['id_barang']);
        $nama_barang = antiinjection($koneksi, $_POST['nama_barang']);
        $maintener = antiinjection($koneksi, $_POST['maintener']);
        $qty = antiinjection($koneksi, $_POST['qty']);
        //belum bisa edit id_barang, karena id barang digunakan sebagai parameter.
        
        $query = "UPDATE barang SET nama_barang = '$nama_barang', maintener = '$maintener', qty = '$qty' where id_barang=$id_barang";
        if (mysqli_query($koneksi, $query)) {
            pesan('success', "Data Barang Telah Diubah.");
        } else {
            pesan('danger', "Gagal Mengubah Data Barang Karena: " . mysqli_error($koneksi));
        }
        header("Location: ../index.php?page=barang");
    }
}
?>