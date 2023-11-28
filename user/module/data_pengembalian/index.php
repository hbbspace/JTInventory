<div class="container-fluid">
    <div class="row">
        <?php
        include "user/template/menu.php";
        ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Data Pengembalian</h1>
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
                                <th scope="col">Status</th>
                                <th scope="col">Waktu Transaksi</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = "SELECT m.nama_mhs AS nama, p.time AS waktu, u.level AS status FROM peminjaman AS p
                                    INNER JOIN user AS u ON u.user_id = p.user_id
                                    INNER JOIN mahasiswa AS m ON m.nim = u.unicode
                                    WHERE p.status = 'progress'
                                    UNION
                                    SELECT d.nama_dosen AS nama, p.time AS waktu, u.level AS status FROM peminjaman AS p
                                    INNER JOIN user AS u ON u.user_id = p.user_id
                                    INNER JOIN dosen AS d ON d.nidn = u.unicode
                                    WHERE p.status = 'progress'";
                            $result = mysqli_query($koneksi, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['status'] ?></td>
                                    <td><?= $row['waktu'] ?></td>
                                    <td>
                                    <!-- buutton untuk menampilkan data peminjaman -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" data-bs-whatever="@mdo">
                                       Rincian
                                   </button>                                   
                                   </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Rincian Data Peminjaman</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Form to add admin -->
                                <form action="" method="">
                                    <div class="modal-body">
                                        <?php
                                        // Query the database to get the details of the peminjaman
                                        $query = "SELECT mhs.nama_mhs as nama,lb.id_barang as id_barang,b.nama_barang as nama_barang,b.maintener as maintener,
                                        sum(lb.qty) as jumlah_peminjaman, p.tgl_pinjam as tgl_pinjam, p.tgl_kembali as tgl_kembali, p.status as status FROM mahasiswa as mhs inner join user as u on mhs.nim=u.unicode
                                        inner join peminjaman as p on p.user_id=u.user_id
                                        inner join list_barang as lb on lb.id_peminjaman=p.id_peminjaman
                                        inner join barang as b on b.id_barang=lb.id_barang
                                        WHERE p.user_id = '11' AND p.status = 'progress'
                                        order by mhs.nama_mhs asc;";
                                        //WHERE p.id_peminjaman = '$id_peminjaman' (Ambil id peminjaman row ketika click Rincian)
                                        $result = mysqli_query($koneksi, $query);
                                        $row = mysqli_fetch_assoc($result);
                                        ?>
                                        <div class="data-container">
                                            <div class="data-row">
                                                <p class="data-label"><strong>Nama:</strong></p>
                                                <p class="data-value"><?= $row['nama'] ?></p>
                                            </div>
                                        </div>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Barang</th>
                                                    <th scope="col">Kode Barang</th>
                                                    <th scope="col">Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query2 = "SELECT b.nama_barang as nama, lb.id_barang as kode_barang, lb.qty AS jumlah from peminjaman as p 
                                                inner join list_barang as lb on lb.id_peminjaman = p.id_peminjaman
                                                inner join barang as b on b.id_barang=lb.id_barang
                                                WHERE p.user_id = '11' AND p.status = 'progress'
                                                order by b.nama_barang";
                                                //WHERE p.id_peminjaman = '$id_peminjaman' (Ambil id peminjaman row ketika click Rincian)
                                                $result2 = mysqli_query($koneksi, $query2);
                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $row2['nama'] ?></td>
                                                        <td><?= $row2['kode_barang'] ?></td>
                                                        <td><?= $row2['jumlah'] ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <div class="data-container">
                                            <div class="data-row">
                                                <p class="data-label"><strong>Jumlah Barang Dipinjam:</strong></p>
                                                <p class="data-value"><?= $row['jumlah_peminjaman'] ?></p>
                                            </div>
                                            <div class="data-row">
                                                <p class="data-label"><strong>Maintener:</strong></p>
                                                <p class="data-value"><?= $row['maintener'] ?></p>
                                            </div>
                                            <div class="data-row">
                                                <p class="data-label"><strong>Tanggal Peminjaman:</strong></p>
                                                <p class="data-value"><?= $row['tgl_pinjam'] ?></p>
                                            </div>
                                            <div class="data-row">
                                                <p class="data-label"><strong>Tanggal Pengembalian:</strong></p>
                                                <p class="data-value"><?= $row['tgl_kembali'] ?></p>
                                            </div>
                                            <div class="data-row">
                                                <p class="data-label"><strong>Upload KTM:</strong></p>
                                                <p class="data-value"><?= $row['nama'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer" style="display: flex;">
                                        <button type="submit" class="btn btn-primary" aria-hidden="true"> Accept</button>
                                        <button type="submit" class="btn btn-danger" aria-hidden="true"> Decline</button>
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