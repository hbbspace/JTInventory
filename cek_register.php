<?php
session_start();
    require 'config/koneksi.php';
    require 'fungsi/pesan_kilat.php';
    require 'fungsi/anti_injection.php';
    if(isset($_POST['register'])){
        $nama = antiinjection($koneksi, $_POST['nama']);
        $unicode = antiinjection($koneksi, $_POST['unicode']);
        $email = antiinjection($koneksi, $_POST['email']);
        $username = antiinjection($koneksi, $_POST['username']);
        $password = antiinjection($koneksi, $_POST['password']);
        $jenis_kelamin = antiinjection($koneksi, $_POST['jenis_kelamin']);
        $level = antiinjection($koneksi, $_POST['level']);

        $salt = bin2hex(random_bytes(16));
        $combined_password = $salt . $password;
        $hashed_password = password_hash($combined_password, PASSWORD_BCRYPT);

        if($nama != null && $unicode != null && $email != null && $username != null && $password != null && $jenis_kelamin != "null" && $level != "Pilih Level") {
            $last_id = mysqli_insert_id($koneksi);
            $query = "INSERT INTO user (user_id, unicode, email, username, password, salt, level) 
                VALUES('$last_id', '$unicode', '$email', '$username', '$hashed_password', '$salt', '$level');";
            
            if(mysqli_query($koneksi, $query)) {
                switch($level){
                    case 'Mahasiswa':
                        $query2 = "INSERT INTO mahasiswa (nim, nama_mhs, jk) VALUES('$unicode', '$nama', '$jenis_kelamin');";
                        
                        break;
                    case 'Dosen':
                        $query2 = "INSERT INTO dosen (nidn, nama_dosen, jk) VALUES('$unicode', '$nama', '$jenis_kelamin');";
                        
                        break;
                    default:
                    pesan('danger', "Gagal Registrasi Karena data tidak valid.");
                    break;
                }
                if (mysqli_query($koneksi, $query2)) {
                    pesan('success', "Anggota Baru Ditambahkan.");
                } else {
                    pesan('warning', "Gagal Menabahkan Admin Tetapi Data Login Tersimpan Karena: " . mysqli_error($koneksi));
                }
            } else {
                pesan('warning', "Gagal Menabahkan Admin Tetapi Data Login Tersimpan Karena: " . mysqli_error($koneksi));
            }
        } else {
            pesan('danger', "Gagal Registrasi Karena data tidak valid.");
        }
        header("Location: register.php");
    }
?>