<div class="container-fluid">
    <div class="row">
        <?php
        require 'admin/template/menu.php';
        $id = $_GET['user_id'];
        $query = "SELECT * FROM user WHERE user_id = '$id'";
        $result = mysqli_query($koneksi, $query);
        $row = mysqli_fetch_assoc($result);
        $unicode = $_GET['unicode'];
        $querry2="SELECT t.jk AS jenis_kelamin FROM user AS u INNER JOIN teknisi AS t ON t.nip = u.unicode WHERE user_id = '$id';";
        $result2 = mysqli_query($koneksi, $query2);
        $row2 = mysqli_fetch_assoc($result2);
        ?>
        
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="card col-sm-6">
                <div class="card-header">
                    Form Edit Akun
                </div>
                <div class="card-body">
                    <form action="fungsi/edit.php?akun=edit" method="post">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama :</label>
                            <input type="text" name="nama" class="form-control" id="nama" value="<?= $row['nama'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">username :</label>
                            <input type="text" name="username" class="form-control" id="username" value="<?= $row['username'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Password:</label>
                            <input type="text" name="username" class="form-control" id="username" value="<?= $row['username'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">email :</label>
                            <input type="text" name="email" class="form-control" id="email" value="<?= $row['email'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Jenis Kelamin </label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="jenis_kelamin" value="L" <?= ($row['jenis_kelamin'] === 'L') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="jenis_kelamin" value="P" <?= ($row['jenis_kelamin'] === 'P') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>Ubah</button>
                    </form>
                </div>
            </div>
        </main>