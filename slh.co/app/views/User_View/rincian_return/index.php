<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="col-lg-12 pt-3">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1>Rincian Return</h1>
                </div>
                <div class="row">
                <div class="col-lg-16">
                    </div>
                    <div class="table-responsive small" id="dataTable">
                        <!-- Menampilkan data admin dalam tabel -->
                        <form>
                            <div class="modal-body">
                                <div class="data-container">
                                    <div class="data-row">
                                        <p class="data-label"><strong>Nama:</strong></p>
                                        <p class="data-value"><?=$data['nama']['nama']?></p>
                                    </div>
                                </div>
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
                                        <td>
                                    </td>
                                    </tr>
                                <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="data-container">
                                <div class="data-row">
                                    <div class="data-row">
                                        <p class="data-label"><strong>Tanggal Peminjaman:</strong></p>
                                        <p class="data-value"><?=$row['tanggal_pinjam']?></p>
                                    </div>
                                    <div class="data-row">
                                        <p class="data-label"><strong>Tanggal Pengembalian:</strong></p>
                                        <p class="data-value"><?=$row['tanggal_kembali']?></p>
                                    </div>
                                    <div class="data-row">
                                        <p class="data-label"><strong>Upload KTM:</strong></p>
                                        <p class="data-value">statis</p>
                                    </div>
                                    <div class="data-row">
                                        <p class="data-label"><strong>Upload Bukti Pengembalian:</strong></p>
                                        <p class="data-value">statis</p>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="text-center mt-5">
    <a href="<?= base_url; ?>/User_Side" class="btn btn-warning btn-xs">kembali</a>
</div>

                    </div>
                        
                </div>
                </div>
            </main>