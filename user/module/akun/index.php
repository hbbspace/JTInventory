<head>
    <style>
strong{
  font-size: large;
  line-height: 12px;
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
        include "user/template/menu.php";
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
                            $userLevel = $_SESSION['level'];
                            if ($userLevel === 'Mahasiswa') {
                                $query = "SELECT m.nama_mhs AS nama , m.nim, m.jk, u.username, u.email 
                                          FROM user AS u 
                                          INNER JOIN mahasiswa AS m ON m.nim = u.unicode 
                                          WHERE u.level = 'Mahasiswa' AND u.user_id = '$id'";
                            } elseif ($userLevel === 'Dosen') {
                                $query = "SELECT d.nama_dosen AS nama, d.nidn, d.jk, u.username, u.email 
                                          FROM user AS u 
                                          INNER JOIN dosen AS d ON d.nidn = u.unicode 
                                          WHERE u.level = 'Dosen' AND u.user_id = '$id'";
                            }
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
                                <div class="container">
                                    <table class="table">
                                        <tr>
                                            <td><strong>Nama:</strong></td>
                                            <td><?= $row['nama'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td><?= $userLevel ?></td>
                                        </tr>
                                        <?php if ($userLevel === 'Mahasiswa') : ?>
                                            <tr>
                                                <td><strong>NIM:</strong></td>
                                                <td><?= $row['nim'] ?></td>
                                            </tr>
                                        <?php elseif ($userLevel === 'Dosen') : ?>
                                            <tr>
                                                <td><strong>NIDN:</strong></td>
                                                <td><?= $row['nidn'] ?></td>
                                            </tr>
                                        <?php endif; ?>
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

                            <?php } ?>
                                <div class="card-body" style="text-align: center;">
                                <a href="index.php?page=akun/edit" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
                            </div>        
                       </tbody>
                </div>
        </main>
    </div>
</div>


