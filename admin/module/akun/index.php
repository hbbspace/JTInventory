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
                            $query = "SELECT t.nama_teknisi AS nama , t.nip, t.jk, u.username, u.email FROM user AS u 
                                    INNER JOIN teknisi AS t ON t.nip = u.unicode WHERE u.level = 'Teknisi' AND u.user_id = '$id'"; 
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
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <strong>Nama: </strong></tr><?= $row['nama'] ?><br><hr>
                                    <strong>unicode: </strong><?= $row['nip'] ?><br><hr>
                                    <strong>Username: </strong><?= $row['username'] ?><br><hr>
                                    <strong>Email: </strong><?= $row['email'] ?><br><hr>
                                    <strong>Jenis Kelamin: </strong><?= $row['jk'] ?><br><hr>

                                <?php } ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-body" style="text-align: center;">
                                            <a href="index.php?page=akun/edit" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>

                                            </div>
                                        </div>
                                    </div>
                               </div>
                       </tbody>
                </div>
        </main>
    </div>
</div>


