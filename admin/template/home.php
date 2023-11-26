<div class="container-fluid">
    <div class="row">
        <?php
        include "menu.php";

        // $query_anggota = "SELECT count(id_barang) as jml FROM barang";
        // $result_anggota = mysqli_query($koneksi, $query_anggota);
        // $row_anggota = mysqli_fetch_assoc($result_anggota);

        // $query_jabatan = "SELECT count(id_barang) as jml FROM barang";
        // $result_jabatan = mysqli_query($koneksi, $query_jabatan);
        // $row_jabatan = mysqli_fetch_assoc($result_jabatan);

        $id = $_SESSION['user_id'];
        $query_nama = "SELECT t.nama_teknisi AS nama FROM user AS u INNER JOIN teknisi AS t ON t.nip = u.unicode WHERE u.user_id = '$id'";
        $level = 'Teknisi ';
        $result_nama = mysqli_query($koneksi, $query_nama);
        $ambil_nama = mysqli_fetch_assoc($result_nama);
        ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Selamat Datang <?= $level . $ambil_nama['nama'] ?></h1>
            </div>
            <!-- <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Stok Barang</h5>
                            <p class="card-text">Total Stok Barang sejumlah <?= $row_anggota['jml'] ?> orang.</p>
                            <a href="index.php?page=anggota" class="btn btn-primary"><i class="fa fa-users" aria-hidden="true"></i>Kelola</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Barang</h5>
                            <p class="card-text">Total Barang sejumlah <?= $row_jabatan['jml'] ?>.</p>
                            <a href="index.php?page=jabatan" class="btn btn-primary"><i class="fa fa-puzzle-piece" aria-hidden="true"></i>Kelola</a>
                        </div>
                    </div>
                </div>
            </div> -->
        </main>
    </div>
</div>