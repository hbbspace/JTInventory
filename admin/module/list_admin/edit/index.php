<div class="container-fluid">
    <div class="row">
        <?php
        require 'admin/template/menu.php';
        $id = $_SESSION['user_id'];
        $query = "SELECT t.nama_teknisi AS nama , t.nip as nip, t.jk, u.username, u.email FROM user AS u 
        INNER JOIN teknisi AS t ON t.nip = u.unicode WHERE u.level = 'Teknisi' AND NOT u.user_id = '$id'"; 
        $result = mysqli_query($koneksi, $query);
        $row = mysqli_fetch_assoc($result);
        ?>
        
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <form action="fungsi/edit.php?list_admin=edit" method="post">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                Form Edit Admin
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama :</label>
                                    <input type="text" name="nama" class="form-control" id="nama" value="<?= $row['nama'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="nip" class="form-label">nip :</label>
                                    <input type="text" name="nip" class="form-control" id="nip" value="<?= $row['nip'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" value="<?= $row['username'] ?>" id="username">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password:</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                    <div class="form-text">Kosongi password jika tidak ingin menggantinya.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email :</label>
                                    <input type="text" name="email" class="form-control" id="email" value="<?= $row['email'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin :</label>
                                    <br>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="jk" value="L" <?= ($row['jk'] === 'L') ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="jk" value="P" <?= ($row['jk'] === 'P') ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body" style="text-align: center;">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Ubah</button>
                                <a href="index.php?page=list_admin" class="btn btn-secondary"><i class="fa fa-times"></i> Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
           </form>
      </main>
   </div>
</div>


  


        