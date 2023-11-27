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
                                <th scope="col">Status</th>
                                <th scope="col">Waktu Transaksi</th>
                                <th scope="col">Tanggal Pinjam</th>
                                <th scope="col">Tanggal Pengembalian</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = "SELECT m.nama_mhs AS nama, p.time AS waktu, u.level AS status, p.tgl_pinjam AS tgl_pinjam, p.tgl_kembali AS tgl_kembali FROM peminjaman AS p
                                    INNER JOIN user AS u ON u.user_id = p.user_id
                                    INNER JOIN mahasiswa AS m ON m.nim = u.unicode
                                    WHERE p.status = 'request'
                                    UNION
                                    SELECT d.nama_dosen AS nama, p.time AS waktu, u.level AS status, p.tgl_pinjam AS tgl_pinjam, p.tgl_kembali AS tgl_kembali FROM peminjaman AS p
                                    INNER JOIN user AS u ON u.user_id = p.user_id
                                    INNER JOIN dosen AS d ON d.nidn = u.unicode
                                    WHERE p.status = 'request'";
                            $result = mysqli_query($koneksi, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['status'] ?></td>
                                    <td><?= $row['waktu'] ?></td>
                                    <td><?= $row['tgl_pinjam'] ?></td>
                                    <td><?= $row['tgl_kembali'] ?></td>
                                    <td>
                                    <!-- buutton untuk menampilkan data peminjaman -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-bs-target="#modalRincian" data-bs-whatever="@mdo">Lihat Detail Peminjaman</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                    <!-- Modal -->
                    <div class="modal fade" id="modalRincian" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Detail Peminjaman</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php
                                // Query the database to get the details of the peminjaman
                                $query = "SELECT mhs.nama_mhs as nama,lb.id_barang as id_barang,b.nama_barang as nama_barang,b.maintener as maintener,
                                lb.qty as jumlah_peminjaman, p.tgl_pinjam as tgl_pinjam, p.tgl_kembali as tgl_kembali, p.status as status FROM mahasiswa as mhs inner join user as u on mhs.nim=u.unicode
                                inner join peminjaman as p on p.user_id=u.user_id
                                inner join list_barang as lb on lb.id_peminjaman=p.id_peminjaman
                                inner join barang as b on b.id_barang=lb.id_barang
                                where 
                                order by mhs.nama_mhs asc;";
                                $result = mysqli_query($koneksi, $query);
                                $row = mysqli_fetch_assoc($result)
                                ?>
                                    <th scope="row"><?= $no++ ?></th>
                                    <p><strong>Nama Peminjam:</strong><?= $row['nama'] ?></p>
                                    <p><strong>Nama Barang:</strong><?= $row['nama_barang'] ?></p>
                                    <p><strong>Maintener:</strong><?= $row['maintner'] ?></p>
                                    <p><strong>jumlah Barang Dipinjam:</strong><?= $row['jumlah_peminjaman'] ?></p>
                                    <p><strong>Tanggal Peminjaman:</strong><?= $row['tgl_pinjam'] ?></p>
                                    <p><strong>Tanggal Pengembalian:</strong><?= $row['tgl_kembali'] ?></p>
                                    <p><strong>upload ktm:</strong><?= $row['nama'] ?></p>
                                <?php ?>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> decline</button>
                            <button type="submit" class="btn btn-primary" aria-hidden="true"><i class="fa fa-floppy-o"></i> accept</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
