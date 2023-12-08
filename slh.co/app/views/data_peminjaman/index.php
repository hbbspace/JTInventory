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
    
        .data-container {
            margin: 10px; 
            padding: 10px; 
        }

        .data-row {
            display: flex; 
            align-items: center; 
            margin-bottom: 5px; 
        }

        .data-label {
            font-weight: bold; 
            width: 200px; 
        }

        .data-value {
            width: 300px; 
        }

</style>
<link rel="stylesheet" href="assets/custom/dashboard.css">
    
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
                <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="sidebarMenuLabel">SLH.CO</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-3" aria-current="page" href="<?= base_url; ?>/Home">
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-3 " href="<?= base_url; ?>/Admin">
                                    Admin
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-3 " href="<?= base_url; ?>/Data_Barang">
                                    Data Barang
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-3 " href="<?= base_url; ?>/Data_Peminjaman">
                                    Data Peminjaman
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-3 " href="<?= base_url; ?>/Data_Pengembalian">
                                    Data Pengembalian
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-3 " href="<?= base_url; ?>/History">
                                    History
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-3 " href="/Akun">
                                    Akun
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-3 " href="/Logout">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1>Data Peminjaman</h1>
            </div>
            <div class="row">
            <?php
                 // Menampilkan pesan flash jika ada
                 Flasher::Message();
                ?>
                <div class="table-responsive small">
                    <table class="table table-striped">
                        <thead>
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
                            foreach ($data['peminjaman'] as $row) :
                            ?>
                                <tr>
                                <th scope="row"><?= $no++ ?></th>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['status'] ?></td>
                                    <td><?= $row['waktu'] ?></td>
                                    <td>
                                    <!-- buutton untuk menampilkan data peminjaman -->
                                    <button onclick="getRincian(this);" id="<?= $row['id'] ?>" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" data-bs-whatever="@mdo">
                                       Rincian
                                   </button>                                
                                   </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                    <!-- Modal -->
                    <div class="modal fade" id="modalRincian" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>