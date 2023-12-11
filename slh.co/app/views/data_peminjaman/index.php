<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* CSS to enable scrolling inside modal */
        .modal-dialog-scrollable {
            display: flex;
            flex-direction: column;
        }
        .modal-dialog-scrollable .modal-content {
            flex: 1;
            overflow-y: auto;
        }
        .modal-body {
            flex: 1;
            overflow-y: auto;
        }

        .data-container {
            margin: 10px;
            padding: 10px;
        }

        .data-row {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .data-label {
            font-weight: bold;
            width: 200px;
        }

        .data-value {
            width: 300px;
        }
    </style>
    <link rel="stylesheet" href="assets/custom/dashboard.css">
</head>
<body>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1>Data Peminjaman</h1>
        </div>
        <div class="row">
        <div class="col-lg-16">
                        <?php
                        // Menampilkan pesan flash jika ada
                        Flasher::Message();
                        ?>
                    </div>
            <div class="table-responsive small">
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
                                    <!-- button untuk menampilkan data peminjaman -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRincian" data-bs-whatever="@mdo">
                                        Rincian
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Modal -->
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
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
