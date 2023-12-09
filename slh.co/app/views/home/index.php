<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="assets/custom/dashboard.css">
    
</head>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1>Selamat Datang <?= $data['level'] . $data['nama'] ?></h1>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Seluruh Barang</h5>
                                <p class="card-text"><?=$data['jumlahBarang']['nilai']?><p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Barang dipinjam</h5>
                                <p class="card-text"><?=$data['jumlahBarangDipinjam']['jumlahPinjam']?></p>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah User</h5>
                                <p class="card-text"><!-- Jangan lupa diganti -->0 orang.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Presentase Barang dipinjam</h5>
                                <p class="card-text"><?=$data['jumlahBarang']['nilai']/$data['jumlahBarangDipinjam']['jumlahPinjam']?>%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <a  href="<?= base_url; ?>/Data_Peminjaman" style="text-decoration: none; color:auto"><h1 class="">Request Info</h1> </a>
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
                                foreach ($data['peminjaman'] as $row) :
                                ?>
                                    <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['status'] ?></td>
                                        <td><?= $row['waktu'] ?></td>
                                        <td>
                                        <!-- buutton untuk menampilkan data peminjaman -->
                                        <button onclick="getRincian(this);" id="<?= $row['id'] ?>" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" data-bs-whatever="@mdo">
                                        Rincian
                                    </button>                                
                                    </td>
                                    </tr>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
            </main>
        </div>
    </div>