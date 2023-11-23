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
                                <th scope="col">Kode Barang</th>
                                <th scope="col">Nama Barang </th>
                                <th scope="col">Maintener</th>
                                <th scope="col">Total Barang</th>
                                <th scope="col">Total Tersedia</th>
                                <th scope="col">Status</th>
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
                                        <a href="index.php?page=jabatan/edit&id=<?= $row['id'] ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
                                        <a href="fungsi/hapus.php?jabatan=hapus&id=<?= $row['id'] ?>" onclick="javascript:return confirm('Hapus Data Jabatan ?');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i>Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>