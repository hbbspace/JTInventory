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
        </div>
    </main>
</body>
</html>
