<!DOCTYPE html>
<html lang="en">
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
        </style>
    <link rel="stylesheet" href="assets/custom/dashboard.css">
</head>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                  </form>


                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1>Data Pengembalian</h1>
                </div>

                <div class="row">
                <div class="col-lg-16">
                        <?php
                        // Menampilkan pesan flash jika ada
                        Flasher::Message();
                        ?>
                    </div>
                    <div class="table-responsive small" id="dataTable">
                        <!-- Menampilkan data admin dalam tabel -->
                        <table class="table table-striped">
                        <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Id Peminjaman</th>
                                    <th scope="col">Waktu</th>
                                    <th scope="col">Jumlah </th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Mengambil dan menampilkan data barang
                                $no = 1;
                                foreach ($data['barang'] as $row) :
                                ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['waktu'] ?></td>
                                        <td><?= $row['jumlah'] ?></td>
                                        <td><?= $row['status'] ?></td>
                                        <td><?= $row['keterangan'] ?></td>
                                        <td>
                                        <button type="button" class="btn btn-primary" onclick="window.location.href='<?= base_url; ?>/User_Side/Rincian_Return/<?= $row['id'] ?>'">
                                            Rincian
                                        </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    </div>

            </main>
        </div>
    </div>