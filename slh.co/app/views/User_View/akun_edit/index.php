 
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <form action="<?= base_url ?>/User_Side/editAkun" method="post">
                <div class="col-sm-12">
                    <div class="card-header mt-3 ">
                        <h1>Edit Akun</h1>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama :</label>
                            <input type="text" name="nama" class="form-control" id="nama" value="<?= $data['nama'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username :</label>
                            <input type="text" name="username" class="form-control" id="username" value="<?= $data['username'] ?>">
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
                    <div class="card-body" style="text-align: center;">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Ubah</button>
                        <a href="<?= base_url ?>/User_Side/Akun" class="btn btn-secondary"><i class="fa fa-times"></i> Batal</a>
                    </div>
                </div>
           </form>
        </main>