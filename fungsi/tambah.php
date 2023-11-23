<?php
session_start();
if (!empty($_SESSION['username'])) {
    require '../config/koneksi.php';
    require '../fungsi/pesan_kilat.php';
    require '../fungsi/anti_injection.php';
    if (!empty($_GET['list_admin'])) {
            $nama = antiinjection($koneksi, $_POST['nama']);
            $nip = antiinjection($koneksi, $_POST['nip']);
            $jenis_kelamin = antiinjection($koneksi, $_POST['jenis_kelamin']);
            $email = antiinjection($koneksi, $_POST['email']);
            $username = antiinjection($koneksi, $_POST['username']);
            $password = antiinjection($koneksi, $_POST['password']);

            $salt = bin2hex(random_bytes(16));
            $combined_password = $salt . $password;
            $hashed_password = password_hash($combined_password, PASSWORD_BCRYPT);

            if($nama != null && $nip != null && $jenis_kelamin != "null" && $email != "null" 
            && $username != null && $password != null) {
                $last_id = mysqli_insert_id($koneksi);
                $query = "INSERT INTO user (user_id, unicode, email, username, password, salt, level) 
                    VALUES('$last_id', '$nip', '$email', '$username', '$hashed_password', '$salt', 'Teknisi');";
                
                if(mysqli_query($koneksi, $query)) {
                    $query2 = "INSERT INTO teknisi (nip, nama_teknisi, jk) VALUES('$nip', '$nama', '$jenis_kelamin');";

                    if (mysqli_query($koneksi, $query2)) {
                        pesan('success', "Admin Baru Ditambahkan.");
                    } else {
                        pesan('warning', "Gagal Menabahkan Admin Tetapi Data Login Tersimpan Karena: " . mysqli_error($koneksi));
                    }
                } else {
                    pesan('warning', "Gagal Menabahkan Admin Tetapi Data Login Tersimpan Karena: " . mysqli_error($koneksi));
                }
            } else {
                pesan('danger', "Gagal Menambahkan Admin Karena data tidak valid.");
            }
            header("Location: ../index.php?page=list_admin");
        
        header("Location: ../index.php?page=list_admin");
    } elseif (!empty($_GET['anggota'])) {
        
        $username = antiinjection($koneksi, $_POST['username']);
        $password = antiinjection($koneksi, $_POST['password']);
        $level = antiinjection($koneksi, $_POST['level']);
        $jabatan = antiinjection($koneksi, $_POST['jabatan']);
        $nama = antiinjection($koneksi, $_POST['nama']);
        $jenis_kelamin = antiinjection($koneksi, $_POST['jenis_kelamin']);
        $alamat = antiinjection($koneksi, $_POST['alamat']);
        $no_telp = antiinjection($koneksi, $_POST['no_telp']);
        
    
        $salt = bin2hex(random_bytes(16));
        $combined_password = $salt . $password;
        $hashed_password = password_hash($combined_password, PASSWORD_BCRYPT);

        $query = "INSERT INTO user (username, password, salt, level) VALUES ('$username', '$hashed_password', '$salt','$level')";
        if (mysqli_query($koneksi, $query)) {
            $last_id = mysqli_insert_id($koneksi);
            $query2 = "INSERT INTO anggota (nama, jenis_kelamin, alamat, no_telp, user_id, jabatan_id) VALUES ('$nama', '$jenis_kelamin', '$alamat', '$no_telp', '$last_id','$jabatan')";
            if (mysqli_query($koneksi, $query2)) {
                pesan('success', "Anggota Baru Ditambahkan.");
            } else {
                pesan('warning', "Gagal Menabahkan Anggota Tetapi Data Login Tersimpan Karena: " . mysqli_error($koneksi));
            }
        } else {
            pesan('danger', "Gagal Menambahkan Anggota Karena: " . mysqli_error($koneksi));
        }
        header("Location: ../index.php?page=anggota");
    }
} else {
    header("Location: ../index.php?page=login");
}
?>