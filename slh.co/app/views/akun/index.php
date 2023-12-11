<head>
<style>

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
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Akun</h1>
    </div>
    <div class="row">
    <div class="col-lg-16">
                        <?php
                        // Menampilkan pesan flash jika ada
                        Flasher::Message();
                        ?>
                    </div>
        <div class="akun-section">
            <!-- Menampilkan data -->
            <tbody>
                    <div class="container">
                        <table class="table">
                            <tr>
                                <td><strong>Nama:</strong></td>
                                <td><?= $data["nama"] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td><?= $data['level'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>NIP:</strong></td>
                                <td><?= $data['nip'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Username:</strong></td>
                                <td><?= $data['username'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td><?= $data['email'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Kelamin:</strong></td>
                                <td><?= $data['jk'] ?></td>
                            </tr>
                        </table>
                    </div>
                    <div style="text-align:center">
  <button type="button" class="btn" style="background-color: #87C4FF; text-align:center; justify-content:center;" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
    Edit Akun
  </button>
</div>

                    <!-- <div class="card-body" style="text-align: center;">
                    <a data-bs-target="#exampleModal" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
                    </div> -->
            </tbody>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel" style="position: fixed;">Edit Akun</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="fungsi/tambah.php?barang=tambah" method="post">
                                <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama :</label>
                                    <input type="text" name="nama" class="form-control" id="nama" value="<?= $data['nama'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username :</label>
                                    <input type="text" name="username" class="form-control" id="username" value="<?= $data['username'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="username_login" class="form-label">Username Login</label>
                                    <input type="text" name="username_login" class="form-control" value="<?= $data['username'] ?>" id="username_login">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password:</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                    <div class="form-text">Kosongi password jika tidak ingin menggantinya.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email :</label>
                                    <input type="text" name="email" class="form-control" id="email" value="<?= $data['email'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin :</label>
                                    <br>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="jk" value="L" <?= ($data['jk'] === 'L') ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="jk" value="P" <?= ($data['jk'] === 'P') ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                    </div>
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
</main>