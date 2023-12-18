<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="assets/custom/dashboard.css">
</head>

<body>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Data Admin</h1>
        </div>
        <div class="row">
            <div class="col-lg-16">
                <?php
                // Menampilkan pesan flash jika ada
                Flasher::Message();
                ?>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive small">
                <!-- Menampilkan data admin dalam tabel -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Jenis Kelamin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Mengambil dan menampilkan data admin
                        $no = 1;
                        foreach ($data['Teknisi'] as $row) :
                        ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $row['nama_teknisi'] ?></td>
                                <td><?= $row['nip'] ?></td>
                                <td><?= $row['jk'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>
