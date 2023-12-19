<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1>Data Peminjaman</h1>
        </div>
        <div class="row">
        <div class="col-lg-16">
                        <?php
                        // Menampilkan pesan flash jika ada
                        Flasher::Message();
                        ?>
                    </div>
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
                        $i = 0; // variabel untuk indeks array
                        while ($i < count($data['peminjaman'])) { // kondisi untuk menghentikan loop
                            $row = $data['peminjaman'][$i]; // mengakses elemen array dengan indeks
                            ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['status'] ?></td>
                                <td><?= $row['waktu'] ?></td>
                                <td><?= $row['keterangan'] ?></td>
                                <td>
                                    <!-- button untuk menampilkan data peminjaman -->
                                    <button type="button" class="btn btn-primary" onclick="window.location.href='<?= base_url; ?>/Admin_Side/Rincian_Peminjaman/<?= $row['id'] ?>'">
                                        Rincian
                                    </button>
                                </td>
                            </tr>
                            <?php
                            $i++; // menambahkan indeks
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
