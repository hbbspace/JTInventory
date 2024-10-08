<head>
    <style>
strong{
  font-size: large;
  line-height: 12px; /* Mengatur text-align menjadi right untuk span kedua */
  margin-right: 40px;
}

tr{
    padding-top: 90px;
}

    </style>
</head>
<div class="container-fluid">
    <div class="row">
        <?php
        // Include template menu
        include "admin/template/menu.php";
        ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Data Akun</h1>
            </div>
            <div class="row">
                <?php
                 // Menampilkan pesan flash jika ada
                if (isset($_SESSION['_flashdata'])) {
                    echo "<br>";
                    foreach ($_SESSION['_flashdata'] as $key => $val) {
                        echo get_flashdata($key);
                    }
                }
                ?>
                <div class="akun-section">
                    <!-- Menampilkan data -->
                        <tbody>
                            <?php
                            //mengambil id dengan mengguakan session user_id
                            $id = $_SESSION['user_id'];
                            $query = "SELECT t.nama_teknisi AS nama , t.nip AS nip, t.jk AS jk, u.username AS username, u.email AS email FROM user AS u 
                                    INNER JOIN teknisi AS t ON t.nip = u.unicode WHERE u.level = 'Teknisi' AND u.user_id = '$id'";
                            $level = 'Teknisi';
                            // Mengambil id dengan menggunakan session username
                            // $username = $_SESSION['username'];
                            // $id = "SELECT user_id FROM user where username='$username'";
                            // $id_result = mysqli_query($koneksi, $id);
                            // // Mengambil nilai user_id dari objek mysqli_result
                            // $id_row = mysqli_fetch_assoc($id_result);
                            // $id_session = $id_row['user_id'];
                            // $query = "SELECT t.nama_teknisi AS nama , t.nip, t.jk, u.username, u.email FROM user AS u 
                            //           INNER JOIN teknisi AS t ON t.nip = u.unicode WHERE u.level = 'Teknisi' AND u.user_id = $id_session;" ;
                            $result = mysqli_query($koneksi, $query);
                            $row = mysqli_fetch_assoc($result);
                            ?>
                                <div class="container">
                                    <table class="table">
                                        <tr>
                                            <td><strong>Nama:</strong></td>
                                            <td><?= $row['nama'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td><?= $level ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>NIP:</strong></td>
                                            <td><?= $row['nip'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Username:</strong></td>
                                            <td><?= $row['username'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email:</strong></td>
                                            <td><?= $row['email'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jenis Kelamin:</strong></td>
                                            <td><?= $row['jk'] ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="card-body" style="text-align: center;">
                                <a href="index.php?page=akun/edit" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
                                </div>

                       </tbody>
                </div>
        </main>
    </div>
</div>


