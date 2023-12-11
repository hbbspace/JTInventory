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
                    <div class="col-lg-16">
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
                                            <!-- <a href="index.php?page=list_admin/edit&id=<?= $row['nip'] ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
                                            <a href="<?= base_url; ?>/Admin/hapusAdmin/<?= $row['nip'] ?>" onclick="javascript:return confirm('Hapus Data Admin ?');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i>Hapus</a> -->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                </div>
            </main>
        </div>
    </div>