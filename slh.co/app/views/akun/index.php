<head>

</head>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Data Akun</h1>
            </div>
            <div class="row">
                <?php
                 // Menampilkan pesan flash jika ada

                ?>
                <div class="akun-section">
                    <!-- Menampilkan data -->
                        <tbody>
                                <div class="container">
                                    <table class="table">
                                        <tr>
                                            <td><strong>Nama:</strong></td>
                                            <td><?= $data["nama"] ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td><?= $data['level'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>NIP:</strong></td>
                                            <td><?= $data['nip'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Username:</strong></td>
                                            <td><?= $data['username'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email:</strong></td>
                                            <td><?= $data['email'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jenis Kelamin:</strong></td>
                                            <td><?= $data['jk'] ?></td>
                                        </tr>
                                    </table>
                                </div>

                                            <div class="card-body" style="text-align: center;">
                                            <a href="index.php?page=akun/edit" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
                                            </div>
                       </tbody>
                </div>
        </main>