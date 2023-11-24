<div class="container-fluid">
    <div class="row">
        <?php
        // Include template menu
        include "admin/template/menu.php";
        ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Data Admin</h1>
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
                <div class="table-responsive small">
                    <!-- Menampilkan data admin dalam tabel -->
                    <table class="table table-striped">
                        <tbody>
                        <?php
                         // Mengambil dan menampilkan data admin
                        $id = antiinjection($koneksi, $_POST['user_id']);
                        $query = "SELECT t.nama_teknisi AS nama , t.nip AS nip,t.jk as jk, u.username AS username, u.email AS email FROM user AS u 
                                INNER JOIN teknisi AS t ON t.nip = u.unicode WHERE u.level = 'Teknisi' AND u.user_id = '$id';" ;
                        $reqult = mysqli_query($koneksi, $query);
                        while ($row = mysqli_fetch_assoc($reqult)) {
                        ?>
                            <li class="user-item">
                                <strong>Nama: </strong><?= $row['nama'] ?><br>
                                <strong>unicode: </strong><?= $row['nip'] ?><br>
                                <strong>Username: </strong><?= $row['username'] ?><br>
                                <strong>Email: </strong><?= $row['email'] ?><br>
                                <strong>Jenis Kelamin: </strong><?= $row['jk'] ?><br>
                                <button type="button" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</button>
                                <button type="button" class="btn btn-danger btn-xs" onclick="javascript:return confirm('Hapus Data Jabatan ?');"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus</button>
                                </li>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </main>


