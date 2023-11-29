<?php
session_start();
if (!empty($_SESSION['username'])) {
    require '../config/koneksi.php';
    require '../fungsi/pesan_kilat.php';
    require '../fungsi/anti_injection.php';
    // Tambah Admin
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

            $querycek = "SELECT unicode FROM user WHERE unicode = '$nip'";
            if(mysqli_query($koneksi, $querycek) == null) {
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
            } else {
                pesan('warning', "Gagal Menambahkan Admin Karena nip sudah ada.");
            }

            
            header("Location: ../index.php?page=list_admin");
        
        header("Location: ../index.php?page=list_admin");
    // Tambah Barang    
    } elseif (!empty($_GET['barang'])) {
        $nama_barang = antiinjection($koneksi, $_POST['nama_barang']);
        $maintener = antiinjection($koneksi, $_POST['maintener']);
        $id = antiinjection($koneksi, $_POST['id_barang']);
        $qty = antiinjection($koneksi, $_POST['qty']);        

        $query = "INSERT INTO barang (id_barang ,nama_barang, maintener, qty) VALUES ('$id','$nama_barang', '$maintener', '$qty');";
        if (mysqli_query($koneksi, $query)) {
            pesan('succes',"Data vBarang baru Berhasil ditambahkan");

        } else {
            pesan('danger', "Gagal Menambahkan Anggota Karena: " . mysqli_error($koneksi));
        }
        header("Location: ../index.php?page=barang");
    } else if (!empty($_GET['data_peminjaman'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['quantity'], $_POST['date'], $_POST['file'])) {
            // Ambil data dari form
            $quantity = antiinjection($koneksi, $_POST['quantity']);
            $tgl_pinjam = antiinjection($koneksi, $_POST['date']);
            $tgl_kembali = antiinjection($koneksi, $_POST['date']); // Sesuaikan dengan pengisian tanggal kembali dari form
            // ...
        
            // Simpan informasi peminjaman ke dalam tabel peminjaman
            $id_user = $_SESSION['user_id'];
            $status = 'request'; // Set status menjadi 'request'
        
            $query_peminjaman = "INSERT INTO peminjaman (user_id, time, tgl_pinjam, tgl_kembali, status) VALUES ('$id_user', NOW(), '$tgl_pinjam', '$tgl_kembali', '$status')";
        
            if (mysqli_query($koneksi, $query_peminjaman)) {
                // Dapatkan ID peminjaman yang baru saja dimasukkan
                $id_peminjaman = mysqli_insert_id($koneksi);
                
        
                // Simpan barang yang dipilih ke dalam tabel list_barang
                if (isset($_POST['stok']) && is_array($_POST['stok'])) {
                    foreach ($_POST['stok'] as $id_barang) {
                        // Ambil qty dari masing-masing barang yang dipilih
                        // Pastikan untuk mengatur nilai qty sesuai kebutuhan dari form atau sumber lainnya
                        $qty_barang = 1; // Contoh: Set nilai qty sementara menjadi 1
        
                        // Masukkan setiap barang yang dipilih ke dalam tabel list_barang
                        $query_list_barang = "INSERT INTO list_barang (id_peminjaman, id_barang, qty) VALUES ('$id_peminjaman', '$id_barang', '$qty_barang')";
        
                        mysqli_query($koneksi, $query_list_barang);
                    }
                }
        
                pesan('success', "Data Peminjaman Berhasil Ditambahkan");
            } else {
                pesan('danger', "Gagal Menambahkan Data Peminjaman: " . mysqli_error($koneksi));
            }
            echo $id_peminjaman;
            header("Location: ../index.php?page=data_peminjaman");
        }
    }
} else {
    header("Location: ../index.php?page=login");
}
?>