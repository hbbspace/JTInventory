<!DOCTYPE html>
<html lang="en">

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1>Data Request Peminjaman</h1>
                </div>
                <div class="row">
                <div class="col-lg-6">
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
                                    <th scope="col"> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data['request'] as $row) :
                                ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['status'] ?></td>
                                        <td><?= $row['waktu'] ?></td>
                                        <td>
                                        <!-- buutton untuk menampilkan data peminjaman -->
                                        <button type="button" class="btn btn-primary" onclick="window.location.href='<?= base_url; ?>/Admin_Side/Rincian_Request/<?= $row['id'] ?>'">
                                        Rincian
                                    </button>                                                              
                                    </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>