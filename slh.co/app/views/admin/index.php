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
    </style>
    <link rel="stylesheet" href="assets/custom/dashboard.css">
</head>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Data Admin</h1>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <?php
                        // Menampilkan pesan flash jika ada
                        Flasher::Message();
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive small">
                        <!-- Menampilkan data admin dalam tabel -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">NIP</th>
                                <th scope="col">Jenis Kelamin</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            // Mengambil dan menampilkan data admin
                            $no = 1;
                            foreach ($data['admin'] as $row) :
                            ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $row['nama_teknisi'] ?></td>
                                        <td><?= $row['nip'] ?></td>
                                        <td><?= $row['jk'] ?></td>
                                        <td>
                                            <!-- Tombol untuk mengedit dan menghapus data admin -->
                                            <a href="index.php?page=list_admin/edit&id=<?= $row['nip'] ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
                                            <a href="<?= base_url; ?>/Admin/hapusAdmin/<?= $row['nip'] ?>" onclick="javascript:return confirm('Hapus Data Admin ?');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i>Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- Tombol untuk membuka modal "Tambah Admin" -->
                        <div class="position-relative d-flex align-items-end justify-content-center" style="height: 50px;">
                        <div class="col-lg-2">
                            <button type="button" class="btn" style="background-color:  #87C4FF;" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                                <i class="fa fa-plus"></i>Tambah Admin
                            </button>
                        </div>
                    </div>
                    <!-- Modal untuk menambahkan admin -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Admin</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Form untuk menambahkan admin -->
                                <form action="<?= base_url; ?>/Admin/tambahAdmin" method="post">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Nama:</label>
                                            <input type="text" name="nama" class="form-control" id="recipient-name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label">NIP:</label>
                                            <textarea class="form-control" name="nip" id="message-text"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Jenis Kelamin :</label>
                                            <br>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" name="jenis_kelamin" value="L">
                                                <label class="form-check-label" for="inlineRadio1">Laki-laki:</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" name="jenis_kelamin" value="P">
                                                <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label">Email:</label>
                                            <textarea class="form-control" name="email" id="message-text"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Username:</label>
                                            <input type="text" name="username" class="form-control" id="recipient-name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label">Password:</label>
                                            <textarea class="form-control" name="password" id="message-text"></textarea>
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