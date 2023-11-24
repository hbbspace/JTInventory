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
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <?php
        // Include template menu
        include "admin/template/menu.php";
        ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Data Admin</h1>
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
                            <th scope="col">Nama</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                         // Mengambil dan menampilkan data admin
                        $no = 1;
                        $query = "SELECT t.nama_teknisi AS nama , t.nip AS nip, u.username AS username, u.email AS email FROM teknisi AS t INNER JOIN user AS u ON u.unicode = t.nip WHERE u.level = 'Teknisi' ORDER BY t.nama_teknisi desc;";
                        $reqult = mysqli_query($koneksi, $query);
                        while ($row = mysqli_fetch_assoc($reqult)) {
                        ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['nip'] ?></td>
                                    <td><?= $row['username'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td>
                                        <!-- Tombol untuk mengedit dan menghapus data admin -->
                                        <a href="index.php?page=jabatan/edit&id=<?= $row['nama'] ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
                                        <a href="fungsi/hapus.php?jabatan=hapus&id=<?= $row['nama'] ?>" onclick="javascript:return confirm('Hapus Data Jabatan ?');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i>Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <!-- Tombol untuk membuka modal "Tambah Admin" -->
                    <div class="position-relative d-flex align-items-end justify-content-center" style="height: 500px;">
                    <div class="col-lg-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                            <i class="fa fa-plus"></i>Tambah Admin
                        </button>
                    </div>
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
                            <form action="fungsi/tambah.php?list_admin=tambah" method="post">
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
</body>
