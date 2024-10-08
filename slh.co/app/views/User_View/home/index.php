<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="assets/custom/dashboard.css">
    
</head>

<style>
    .card {
        background-color: #77CFF2;
        height : 125px;
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
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1>Selamat Datang  <?=$_SESSION['level'] ." ". $data['nama']['nama']?></h1>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Seluruh Barang</h5>
                                <hr class="card-line">
                                <p class="card-text"><?=$data['jumlahBarang']['nilai']?><p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Barang Dipinjam</h5>
                                <hr class="card-line">
                                <p class="card-text"><?=$data['dipinjam']['jumlah']?></p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="">Request Info</h1>

                </div>
                <?php
                        // Menampilkan pesan flash jika ada
                        Flasher::Message();
                        ?>
                <div class="table-responsive small mt-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">ID peminjaman</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $no = 1;

                            // Periksa apakah $data['request'] tidak null dan memiliki elemen
                            if (!empty($data['request'])) {
                                foreach ($data['request'] as $row) :
                            ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= $row['jumlah'] ?></td>
                                    <td><?= $row['keterangan'] ?></td>
                                    <td><?= $row['status'] ?></td>
                                    <td>
                                        <!-- Tombol untuk menampilkan data peminjaman -->
                                        <button type="button" class="btn btn-primary" onclick="window.location.href='<?= base_url; ?>/User_Side/Rincian_Request/<?= $row['id'] ?>'">
                                            Rincian
                                        </button>
                                        <a href="<?= base_url;?>/User_Side/Delete_Request/<?=$row['id'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Hapus Data Request?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php
                                endforeach;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                    
            </main>
        </div>
    </div>

