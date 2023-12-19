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
<<<<<<< Updated upstream
    </style>
=======
<<<<<<< Updated upstream
        </style>
=======

        .peminjaman-kotak {
            width: 60px;
            
        }

    </style>
>>>>>>> Stashed changes
>>>>>>> Stashed changes
    <link rel="stylesheet" href="assets/custom/dashboard.css">
</head>

<body>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="col-lg-12 pt-3">
            <form action="<?= base_url; ?>/User_Side/cariBarang" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Barang" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" id="tombolCari">
                            <svg class="bi">
                                <use xlink:href="#search" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Data Barang</h1>
            </div>

            <div class="row">
                <div class="col-lg-16">
                    <?php
                    // Menampilkan pesan flash jika ada
                    Flasher::Message();
                    ?>
                </div>
                <form action="<?= base_url; ?>/User_Side/tambahDataBarang" method="post" id="pinjamForm" enctype="multipart/form-data">
                    <div class="table-responsive small" id="dataTable">
                        <!-- Menampilkan data admin dalam tabel -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Barang</th>
<<<<<<< Updated upstream
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Total Barang Tersedia</th>
=======
<<<<<<< Updated upstream
                                    <th scope="col">Nama Barang </th>
                                    <th scope="col">Maintener</th>
                                    <th scope="col">Total Barang</th>
=======
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Total Barang Tersedia</th>
                                    <th scope="col">Jumlah Peminjaman</th>
>>>>>>> Stashed changes
>>>>>>> Stashed changes
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data['barang'] as $row) :
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['id_barang'] ?></td> 
                                        <td><?= $row['nama_barang'] ?></td> 
                                        <td><?= $row['qty'] ?></td>
                                        <td>
<<<<<<< Updated upstream
                                            <!-- Kolom input untuk memasukkan jumlah yang dipinjam -->
                                            <input type="number" name="jumlah_pinjam[]" value="1" min="1" max="<?= $row['qty'] ?>" disabled>
=======
<<<<<<< Updated upstream
                                            <!-- Tombol untuk mengedit dan menghapus data barang -->
                                            <input type="checkbox" name="stok[]" value="<?= $row['id_barang'] ?>" <?php echo ($row['qty'] > 0) ? '' : 'checked'; ?>>
=======
                                            <!-- Kolom input untuk memasukkan jumlah yang dipinjam -->
                                            <input class="peminjaman-kotak" type="number" name="jumlah_pinjam[]" value="1" min="1" max="<?= $row['qty'] ?>" disabled>
>>>>>>> Stashed changes
                                        </td>
                                        <td>
                                            <!-- Input checkbox dengan atribut name yang berisi array -->

                                            <input type="checkbox" name="check[]" value="<?= $row['id_barang'] ?>" onchange="toggleJumlahPinjam(this)">
<<<<<<< Updated upstream
=======
>>>>>>> Stashed changes
>>>>>>> Stashed changes
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                            </tbody>

                        </table>
                        <div class="position-relative d-flex align-items-end justify-content-center" style="height: 50px;">
                            <div class="col-lg-2">
                                <!-- Tombol untuk membuka modal "Tambah Barang" -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pinjamModal" data-bs-whatever="@mdo">
                                    Pinjam Barang
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal untuk memasukkan tanggal pinjam dan tanggal kembali -->
                    <div class="modal fade" id="pinjamModal" tabindex="-1" aria-labelledby="pinjamModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="pinjamModalLabel">Pilih Tanggal Pinjam dan Kembali</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                                        <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" min="<?= date('Y-m-d') ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                                        <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" min="<?= date('Y-m-d') ?>" required>
                                    </div>

                                    <?php if ($_SESSION['level'] == 'Mahasiswa') : ?>
                                        <!-- Tambahkan input file untuk foto KTM jika level adalah Mahasiswa -->
                                        <div class="mb-3">
                                            <label for="foto_ktm" class="form-label">Upload Foto KTM</label>
                                            <input type="file" class="form-control" id="foto_ktm" name="foto_ktm" accept="image/*" required>
                                        </div>
                                    <?php endif; ?>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Pinjam</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </main>

    <script>
        function toggleJumlahPinjam(checkbox) {
            var jumlahInput = checkbox.parentNode.previousElementSibling.querySelector('input[type="number"]');
            jumlahInput.disabled = !checkbox.checked;
            if (!checkbox.checked) {
                jumlahInput.value = 0;
            }
        }

        function submitForm() {
        var checkboxes = document.querySelectorAll('input[name="stok[]"]:checked');
        checkboxes.forEach(function (checkbox) {
            var row = checkbox.closest('tr');
            var jumlahInput = row.querySelector('input[name^="jumlah_pinjam"]');
            jumlahInput.disabled = false;
        });

        document.getElementById('pinjamForm').submit();
    }
    </script>
</body>

</html>
