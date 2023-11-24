<div class="container-fluid">
    <div class="row">
        <?php
        include "admin/template/menu.php";
        ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Data Peminjaman</h1>
            </div>
            <div class="row">
                <?php
                if (isset($_SESSION['_flashdata'])) {
                    echo "<br>";
                    foreach ($_SESSION['_flashdata'] as $key => $val) {
                        echo get_flashdata($key);
                    }
                }
                ?>

                <div class="table-responsive small">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Peminjam</th>
                                <th scope="col">Nama Barang </th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Tanggal Pinjam</th>
                                <th scope="col">Tanggal Pengembalian</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = "SELECT * FROM jabatan order by id desc";
                            $reqult = mysqli_query($koneksi, $query);
                            while ($row = mysqli_fetch_assoc($reqult)) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $row['jabatan'] ?></td>
                                    <td><?= $row['keterangan'] ?></td>
                                    <td>
                                    <!-- buutton untuk menampilkan data peminjaman -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Lihat Detail Peminjaman</button>
                                    <a href="fungsi/hapus.php?jabatan=hapus&id=<?= $row['id'] ?>" onclick="javascript:return confirm('Hapus Data Jabatan ?');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i>Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <!-- Header modal -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Detail Peminjaman</h5>
                        <!-- Tombol silang untuk menutup modal -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Body modal -->
                    <div class="modal-body">
                        <!-- Form untuk menampilkan data peminjaman -->
                        <form>
                        <div class="form-group">
                            <label for="nama">Nama Pemijam</label>
                            <input type="text" class="form-control" id="nama" value="Budi" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" id="nip" value="1234567890" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" value="budi@example.com" readonly>
                        </div>
                        <div class="form-group">
                            <label for="ktm">Upload KTM</label>
                            <!-- Button untuk melihat file KTM yang diupload -->
                            <button type="button" class="btn btn-secondary" id="ktm">Lihat</button>
                        </div>
                        <div class="form-group">
                            <label for="kode">Kode Item</label>
                            <input type="text" class="form-control" id="kode" value="A001" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_item">Nama Item</label>
                            <input type="text" class="form-control" id="nama_item" value="Laptop" readonly>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah Pinjam</label>
                            <input type="number" class="form-control" id="jumlah" value="1" readonly>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" rows="3" readonly>Peminjaman laptop untuk keperluan kuliah online</textarea>
                        </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <!-- Button untuk menerima peminjaman -->
                        <button type="button" class="btn btn-success">Accept</button>
                        <!-- Button untuk menolak peminjaman -->
                        <button type="button" class="btn btn-danger">Decline</button>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </main>
    </div>
</div>