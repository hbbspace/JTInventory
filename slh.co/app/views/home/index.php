<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="assets/custom/dashboard.css">
    
</head>
<<<<<<< Updated upstream
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1>Selamat Datang  <?=$data['level'] ." ". $data['nama']['nama']?></h1>
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
                                <p class="card-text"><?=$data['jumlahUser']['jumlahUser']?> orang.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Presentase Barang dipinjam</h5>
                                <p class="card-text"><?=$data['jumlahBarangDipinjam']['jumlahPinjam']/$data['jumlahBarang']['nilai']*100?>%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <a  href="<?= base_url; ?>/Admin_Side/Data_Peminjaman" style="text-decoration: none; color:auto"><h1 class="">Request Info</h1> </a>
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
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRincian" data-bs-whatever="@mdo">
                                        Rincian
                                    </button>                                
                                    </td>
                                    </tr>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="modal fade" id="modalRincian" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Rincian Data Peminjaman</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- Form to add admin -->
                        <form action="" method="">
                            <div class="modal-body">
                                <?php
                                // ...
                                ?>
                                <div class="data-container">
                                    <div class="data-row">
                                        <p class="data-label"><strong>Nama:</strong></p>
                                        <p class="data-value">statis</p>
                                    </div>
                                </div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nama Barang</th>
                                            <th scope="col">Kode Barang</th>
                                            <th scope="col">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>statis</td>
                                            <td>statis</td>
                                            <td>statis</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="data-container">
                                <div class="data-row">
                                        <p class="data-label"><strong>Jumlah Barang Dipinjam:</strong></p>
                                        <p class="data-value">statis></p>
                                    </div>
                                    <div class="data-row">
                                        <p class="data-label"><strong>Maintener:</strong></p>
                                        <p class="data-value">atatis</p>
                                    </div>
                                    <div class="data-row">
                                        <p class="data-label"><strong>Tanggal Peminjaman:</strong></p>
                                        <p class="data-value">statis</p>
                                    </div>
                                    <div class="data-row">
                                        <p class="data-label"><strong>Tanggal Pengembalian:</strong></p>
                                        <p class="data-value">statis</p>
                                    </div>
                                    <div class="data-row">
                                        <p class="data-label"><strong>Upload KTM:</strong></p>
                                        <p class="data-value">statis</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" style="display: flex;">
                                <button type="submit" class="btn btn-primary" aria-hidden="true"> Accept</button>
                                <button type="submit" class="btn btn-danger" aria-hidden="true"> Decline</button>
                            </div>
                        </form>
=======

<style>
    .card {
        background-color: #77CFF2;
        height : 145px;
    }

    .card-title {
        font-size: 20px;
        font-weight: bold;
        padding-left: 1px;
        color: #200E3A;
    }
    
    .card-text {
        font-size: 18px;
        color: #200E3A;
    }
    
    .card-line {
        height: 2px;
        background-color: #fff;
        margin-bottom: 8px;
        background-color: #200E3A;
    }
</style>

<body>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1>Selamat Datang <?=$data['level'] ." ". $data['nama']['nama']?></h1>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Seluruh Barang</h5>
                        <hr class="card-line">
                        <p class="card-text"><?=$data['jumlahBarang']['nilai']?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Barang Dipinjam</h5>
                        <hr class="card-line">
                        <p class="card-text"><?=$data['jumlahBarangDipinjam']['jumlahPinjam']?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Pengguna</h5>
                        <hr class="card-line">
                        <p class="card-text"><?=$data['jumlahUser']['jumlahUser']?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Presentase Peminjaman</h5>
                        <hr class="card-line">
                        <p class="card-text"><?=number_format($data['jumlahBarangDipinjam']['jumlahPinjam']/$data['jumlahBarang']['nilai']*100, 3)?>%</p>
>>>>>>> Stashed changes
                    </div>
                </div>
            </div>
                    
            </main>
        </div>
    </div>