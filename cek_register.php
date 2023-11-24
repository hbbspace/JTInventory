<?php
session_start();
    require '../config/koneksi.php';
    require '../fungsi/pesan_kilat.php';
    require '../fungsi/anti_injection.php';
    if(isset($_POST['register'])){
        $nama = antiinjection($koneksi, $_POST['nama']);
        $nip = antiinjection($koneksi, $_POST['nip']);
        $jenis_kelamin = antiinjection($koneksi, $_POST['jenis_kelamin']);
        $email = antiinjection($koneksi, $_POST['email']);
        $username = antiinjection($koneksi, $_POST['username']);
        $password = antiinjection($koneksi, $_POST['password']);
        $level = antiinjection($koneksi, $_POST['level']);

        $salt = bin2hex(random_bytes(16));
        $combined_password = $salt . $password;
        $hashed_password = password_hash($combined_password, PASSWORD_BCRYPT);

        if(isset($nama) && isset($nip) && isset($jenis_kelamin) && isset($email)
        && isset($username) && isset($password)) {
            $last_id = mysqli_insert_id($koneksi);
            $query = "INSERT INTO user (user_id, unicode, email, username, password, salt, level) 
                VALUES('$last_id', '$nip', '$email', '$username', '$hashed_password', '$salt', '$level');";
            
            if(mysqli_query($koneksi, $query)) {
                switch($level){
                    case "mahasiswa":
                        $query2 = "INSERT INTO mahasiswa (nip, nama_mahasiswa, jk) VALUES('$nip', '$nama', '$jenis_kelamin');";
                        if (mysqli_query($koneksi, $query2)) {
                            pesan('success', "Anggota Baru Ditambahkan.");
                        }
                        break;
                    case "dosen":
                        $query2 = "INSERT INTO dosen (nip, nama_dosen, jk) VALUES('$nip', '$nama', '$jenis_kelamin');";
                        if (mysqli_query($koneksi, $query2)) {
                            pesan('success', "Anggota Baru Ditambahkan.");
                        }
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