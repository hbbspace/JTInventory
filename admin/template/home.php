<style>
    .card{
        background-color: #87C4FF;
    }
</style>
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

        $barang = "SELECT sum(qty) as qty FROM barang";
        $jml_barang = mysqli_query($koneksi, $barang);
        $jumlah_barang=mysqli_fetch_assoc($jml_barang);

        $barang_dipinjam = "SELECT sum(qty) as qty2 FROM list_barang";
        $brg_dipinjam = mysqli_query($koneksi, $barang_dipinjam);
        $jumlah_barang_dipinjam=mysqli_fetch_assoc($brg_dipinjam);

        $jumlah_user= "SELECT sum(user_id) as jumlah_user FROM user where level != 'Teknisi'";
        $jml_user = mysqli_query($koneksi, $jumlah_user);
        $sum_user=mysqli_fetch_assoc($jml_user);

        $precentage=$jumlah_barang['qty']/$jumlah_barang_dipinjam['qty2'];
        ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1>Selamat Datang <?= $level . $ambil_nama['nama'] ?></h1>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Seluruh Barang</h5>
                            <p class="card-text"> <?= $jumlah_barang['qty'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Barang dipinjam</h5>
                            <p class="card-text"> <?= $jumlah_barang_dipinjam['qty2'] ?>.</p>
                        </div>
                    </div>
                </div>
            
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah User</h5>
                            <p class="card-text"><?= $sum_user['jumlah_user'] ?> orang.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Presentase Barang dipinjam</h5>
                            <p class="card-text"><?= $precentage ?>%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <a href="index.php?page=data_peminjaman" style="text-decoration: none; color:auto"><h1 class="">Request Info</h1> </a>
            </div>
            <div class="table-responsive small mt-3">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Peminjam</th>
                            <th scope="col">Status</th>
                            <th scope="col">Waktu Transaksi</th>
                            <th scope="col"> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = "SELECT m.nama_mhs AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id FROM peminjaman AS p
                                INNER JOIN user AS u ON u.user_id = p.user_id
                                INNER JOIN mahasiswa AS m ON m.nim = u.unicode
                                WHERE p.status = 'request'
                                UNION
                                SELECT d.nama_dosen AS nama, p.time AS waktu, u.level AS status, p.id_peminjaman AS id FROM peminjaman AS p
                                INNER JOIN user AS u ON u.user_id = p.user_id
                                INNER JOIN dosen AS d ON d.nidn = u.unicode
                                WHERE p.status = 'request'";
                        $result = mysqli_query($koneksi, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['status'] ?></td>
                                <td><?= $row['waktu'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
        </main>
    </div>
</div>