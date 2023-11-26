<div class="container-fluid">
    <div class="row">
        <?php
        require 'admin/template/menu.php';
        $query = "SELECT * FROM barang order by id_barang asc";
        $result = mysqli_query($koneksi, $query);
        $row = mysqli_fetch_assoc($result);
        ?>
        
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <form action="fungsi/edit.php?barang=edit" method="post">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                Form Edit Barang
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="id_barang" class="form-label">id Barang :</label>
                                    <input type="text" name="id_barang" class="form-control" id="id_barang" value="<?= $row['id_barang'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Barang :</label>
                                    <input type="text" name="nama_barang" class="form-control" id="nama_barang" value="<?= $row['nama_barang'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="maintener" class="form-label">Maintener</label>
                                    <input type="text" name="maintener" class="form-control" value="<?= $row['maintener'] ?>" id="maintener">
                                </div>
                                <div class="mb-3">
                                    <label for="qty" class="form-label">qty</label>
                                    <input type="text" name="qty" class="form-control" value="<?= $row['qty'] ?>" id="qty">
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body" style="text-align: center;">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Ubah</button>
                                <a href="index.php?page=akun" class="btn btn-secondary"><i class="fa fa-times"></i> Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
           </form>
      </main>
   </div>
</div>


  


        