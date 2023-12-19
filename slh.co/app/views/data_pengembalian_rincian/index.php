<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="col-lg-12 pt-3">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Rincian Peminjaman</h1>
        </div>
        <div class="row">
            <div class="col-lg-16">
            </div>
            <div class="table-responsive small" id="dataTable">
                <!-- Menampilkan data admin dalam tabel -->
                <div class="modal-body">
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
                    <div class="data-container">
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
                        <form action="<?= base_url ?>/Admin_Side/tambahDataKeterangan" method="post">
                            <div class="data-row">
                                <p class="data-label"><strong>Keterangan:</strong></p>
                                <input type="text" name="keterangan" class="form-control" id="keterangan" value="<?= $row['keterangan'] ?>">
                                <input type="hidden" name="row_id" value="<?= $row['id'] ?>">
                                <button type="submit" class="btn btn-primary mt-3">Kirim</button>
                            </div>
                        </form>
                        <div class="data-row">
                            <?php 
                            if ($row['nama_file'] !=null) : ?>
                                <p class="data-label"><strong>Upload KTM:</strong></p>
                                <p class="data-value">
                                    <img src="<?= base_url ?>/img/<?= $row['nama_file'] ?>" width="300px"alt="Foto KTM">
                                </p>                                                    
                                    <?php endif; ?>
                            </div>
                    </div>
                </div>
                <?php
                // Menampilkan pesan flash jika ada
                Flasher::Message();
                ?>
                <div class="text-center mt-5">
                    <a href="<?= base_url; ?>/Admin_Side/Data_Pengembalian" class="btn btn-warning btn-xs" style="margin-right: 25px;">Kembali</a>
                    <a href="<?= base_url; ?>/Admin_Side/AcceptedReturn/<?= $row['id'] ?>" class="btn btn-primary btn-xs" style="margin-right: 25px;">Accepted</a>
                    <a href="<?= base_url; ?>/Admin_Side/RejectedReturn/<?= $row['id'] ?>" class="btn btn-danger btn-xs">Reject</a>
                </div>
            </div>
        </div>
    </div>
</main>
