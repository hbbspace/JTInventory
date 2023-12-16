<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="col-lg-12 pt-3">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1>Rincian Peminjaman</h1>
        </div>
        <div class="row">
            <div class="col-lg-16"></div>
            <div class="table-responsive small" id="dataTable">
                <div class="modal-body">
                    <div class="data-container">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data['rincian'] as $row) :
                                ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $row['nama_barang'] ?></td>
                                        <td><?= $row['id_barang'] ?></td>
                                        <td><?= $row['jumlah'] ?></td>
                                        <td></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="data-container">
                        <div class="data-row">
                            <div class="data-row">
                                <p class="data-label"><strong>Nama:</strong></p>
                                <p class="data-value"><?= $row['nama'] ?></p>
                            </div>
                            <div class="data-row">
                                <p class="data-label"><strong>Tanggal Peminjaman:</strong></p>
                                <p class="data-value"><?= $row['tanggal_pinjam'] ?></p>
                            </div>
                            <div class="data-row">
                                <p class="data-label"><strong>Tanggal Pengembalian:</strong></p>
                                <p class="data-value"><?= $row['tanggal_kembali'] ?></p>
                            </div>
                            <div class="data-row">
                                <p class="data-label"><strong>Keterangan:</strong></p>
                                <p class="data-value"><?= $row['keterangan'] ?></p>
                            </div>
                            <?php
                            // Menampilkan pesan flash jika ada
                            Flasher::Message();
                            ?>
                            <form action="<?= base_url ?>/Admin_Side/tambahDataKeterangan" method="post">
                                <div class="data-row">
                                    <p class="data-label"><strong>Keterangan:</strong></p>
                                    <input type="text" name="keterangan" class="form-control" id="keterangan" value="<?= $row['keterangan'] ?>">
                                    <input type="hidden" name="row_id" value="<?= $row['id'] ?>">
                                    <button type="submit" class="btn btn-primary mt-3">Kirim</button>
                                </div>
                            </form>
                            <div class="data-row">
                                <p class="data-label"><strong>Upload KTM:</strong></p>
                                <p class="data-value"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
