<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your head content here -->
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
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <?php
        include "admin/template/menu.php";
        ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Data Barang</h1>
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
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Barang</th>
                                <th scope="col">Nama Barang </th>
                                <th scope="col">Maintener</th>
                                <th scope="col">Total Barang</th>
                                <!-- <th scope="col">Total Tersedia</th>
                                <th scope="col">Status</th>
                                <th scope="col">Keterangan</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Mengambil dan menampilkan data barang
                            $no = 1;
                            $query = "SELECT * FROM barang order by id_barang asc";
                            $reqult = mysqli_query($koneksi, $query);
                            while ($row = mysqli_fetch_assoc($reqult)) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $row['id_barang'] ?></td>
                                    <td><?= $row['nama_barang'] ?></td>
                                    <td><?= $row['maintener'] ?></td>
                                    <td><?= $row['qty'] ?></td>
                                    <td>
                                        <!-- Tombol untuk mengedit dan menghapus data barang -->
                                        <a href="index.php?page=barang/edit&id=<?= $row['id_barang'] ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
                                        <a href="fungsi/hapus.php?barang=hapus&id=<?= $row['id_barang'] ?>" onclick="javascript:return confirm('Hapus Data barang ?');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i>Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="position-relative d-flex align-items-end justify-content-center" style="height: 500px;">
                    <div class="col-lg-2">
                        <!-- Tombol untuk membuka modal "Tambah Barang" -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
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
                            <form action="fungsi/tambah.php?barang=tambah" method="post">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Nama Barang:</label>
                                        <input type="text" name="nama_barang" class="form-control" id="recipient-name">
                                    </div>
                                    <!-- <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Kode Barang:</label>
                                        <textarea class="form-control" name="Kode Barang" id="message-text"></textarea>
                                    </div> -->
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Maintener:</label>
                                        <input type="text" name="maintener" class="form-control" id="recipient-name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Total Barang:</label>
                                        <input class="form-control" name="qty" id="message-text"></input>
                                    </div>
                                    <!-- <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Status:</label>
                                        <textarea class="form-control" name="keterangan" id="message-text"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Keterangan:</label>
                                        <textarea class="form-control" name="keterangan" id="message-text"></textarea>
                                    </div> -->
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
</body>
