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
                <div class="col-lg-12 pt-3">
                    <form action="<?=base_url;?>/Admin_Side/cariBarang" method="post">
                    <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Barang" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" id="tombolCari">                    <svg class="bi">
                        <use xlink:href="#search" />
                    </svg></button>
                    </div>
                </div>
                  </form>


                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Data Barang</h1>
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
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">Nama Barang </th>
                                    <th scope="col">Maintener</th>
                                    <th scope="col">Total Barang</th>
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
                                        <td><?= $row['id_barang'] ?></td>
                                        <td><?= $row['nama_barang'] ?></td>
                                        <td><?= $row['maintener'] ?></td>
                                        <td><?= $row['qty'] ?></td>
                                        <td>
                                            <!-- Tombol untuk mengedit dan menghapus data barang -->
                                            <a href="<?= $row['id_barang'] ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
                                            <a href="<?= base_url;?>/Admin_Side/hapusBarang/<?=$row['id_barang'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Hapus Data Barang?');"><i class="fa fa-trash-o" aria-hidden="true"></i>Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="position-relative d-flex align-items-end justify-content-center" style="height: 90px;">
                        <div class="col-lg-2">
                            <!-- Tombol untuk membuka modal "Tambah Barang" -->
                            <button type="button" class="btn" style="background-color: #87C4FF;" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                                <i class="fa fa-plus"></i>Tambah Barang
                            </button>
                        </div>
                        </div>
                    </div>
                        <!-- Modal untuk menambahkan data barang -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Barang</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="<?= base_url; ?>/Admin_Side/tambahBarang" method="post">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Nama Barang:</label>
                                            <input type="text" name="nama_barang" class="form-control" id="recipient-name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="form-control" class="col-form-label">Kode Barang:</label>
                                            <input class="form-control" name="id_barang" id="form-control"></input>
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Maintener:</label>
                                            <input type="text" name="maintener" class="form-control" id="recipient-name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label">Total Barang:</label>
                                            <input class="form-control" name="qty" id="message-text"></input>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> Close</button>
                                        <button type="submit" class="btn btn-primary" aria-hidden="true"><i class="fa fa-floppy-o"></i> Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>