<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your head content here -->
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

        btn{
            margin-top: 50px;
        }

        p {
            color: gray;
        }

    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <?php
        include "user/template/menu.php";
        ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Data Barang</h1>
            </div>
            <div class="row">

                <?php
                // Menampilkan pesan flash jika ada
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

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Mengambil dan menampilkan data barang
                            $no = 1;
                            $query = "SELECT * FROM barang order by id_barang asc";
                            $reqult = mysqli_query($koneksi, $query);
                            while ($row = mysqli_fetch_assoc($reqult)) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $row['id_barang'] ?></td>
                                    <td><?= $row['nama_barang'] ?></td>
                                    <td><?= $row['maintener'] ?></td>
                                    <td><?= $row['qty'] ?></td>
                                    <td>
                                        <input type="checkbox" name="stok[]" value="<?= $row['id_barang'] ?>" <?php echo ($row['qty'] > 0) ? '' : 'checked'; ?>>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="position-relative d-flex align-items-end justify-content-center" style="height: 50px;">
                        <div class="col-lg-2">
                            <!-- Tombol untuk membuka modal "Tambah Barang" -->
                            <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" id="pinjamButton">
                                Pinjam Barang
                            </button>
                        </div>
                    </div>
                </div>
                    <!-- Modal untuk menambahkan data barang -->
                <div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Pinjam Barang</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="fungsi/tambah.php?data_peminjaman=tambah" method="post">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="user-name" class="col-form-label">Nama Peminjam:</label>
                                        <?php 
                                        $id = $_SESSION['user_id'];
                                        $userLevel = $_SESSION['level'];
                                        if ($userLevel === 'Mahasiswa') {
                                            $query = "SELECT m.nama_mhs AS nama , m.nim, m.jk, u.username, u.email 
                                                    FROM user AS u 
                                                    INNER JOIN mahasiswa AS m ON m.nim = u.unicode 
                                                    WHERE u.level = 'Mahasiswa' AND u.user_id = '$id'";
                                        } elseif ($userLevel === 'Dosen') {
                                            $query = "SELECT d.nama_dosen AS nama, d.nidn, d.jk, u.username, u.email 
                                                    FROM user AS u 
                                                    INNER JOIN dosen AS d ON d.nidn = u.unicode 
                                                    WHERE u.level = 'Dosen' AND u.user_id = '$id'";
                                        }
                                        $result_nama = mysqli_query($koneksi, $query);
                                        $ambil_nama = mysqli_fetch_assoc($result_nama);
                                        ?>
                                        <p> <?= $ambil_nama['nama'] ?></p>
                                    </div>
                                    <div class="mb-3" id="barangPilihan">
                                        <label for="pil-bar">Barang Pilihan</label>
                                    </div>
                                    <div class="mb-3">
                                        <label for="quantity" class="col-form-label">Jumlah Pinjam:</label>
                                        <input type="number" name="quantity" class="form-control" id="quantity" min="1" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="date" class="col-form-label">Tanggal Pinjam:</label>
                                        <input type="date" name="date" class="form-control" id="date" min="<?= date('Y-m-d') ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="date" class="col-form-label">Tanggal Pengembalian:</label>
                                        <input type="date" name="date" class="form-control" id="date" min="<?= date('Y-m-d') ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="file" class="col-form-label">Upload Foto:</label>
                                        <input type="file" name="file" class="form-control" id="file" accept="image/*" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> Close</button>
                                    <button type="submit" class="btn btn-primary" aria-hidden="true"><i class="fa fa-floppy-o"></i> Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<script>
    document.getElementById('pinjamButton').addEventListener('click', function() {
        // Menyiapkan tempat untuk menampilkan barang yang dipilih di dalam modal
        let barangPilihan = document.getElementById('barangPilihan');
        barangPilihan.innerHTML = ''; // Bersihkan isi sebelum menambahkan data baru

        // Mendapatkan daftar checkbox yang dipilih
        let checkboxes = document.querySelectorAll('input[name="stok[]"]:checked');

        // Periksa apakah ada checkbox yang dipilih
        if (checkboxes.length === 0) {
            alert('Pilih barang terlebih dahulu');
            return;
        }

        checkboxes.forEach(function(checkbox) {
            // Membuat elemen untuk setiap barang yang dipilih
            let id_barang = checkbox.value;
            let nama_barang = checkbox.parentNode.nextElementSibling.textContent;

            // Menambahkan informasi barang ke dalam modal
            let divBarang = document.createElement('div');
            divBarang.innerHTML = `
                <div class="mb-3">
                    <label for="qty_${id_barang}" class="col-form-label">${nama_barang}:</label>
                    <input type="number" name="qty_${id_barang}" class="form-control" id="qty_${id_barang}" min="1" required>
                    <input type="hidden" name="barang_pilihan[]" value="${id_barang}">
                </div>
            `;
            barangPilihan.appendChild(divBarang);
        });
    });
</script>
</body>
