<!DOCTYPE html>
<html lang="en">
<head>
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
                                <a class="nav-link d-flex align-items-center gap-3 " href="<?= base_url; ?>/Admin/Data_Barang">
                                    Data Barang
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-3 " href="<?= base_url; ?>/Admin/Data_Peminjaman">
                                    Data Peminjaman
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-3 " href="<?= base_url; ?>/Admin/Data_Pengembalian">
                                    Data Pengembalian
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-3 " href="<?= base_url; ?>/Admin/History">
                                    History
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-3 " href="/Admin/Akun">
                                    Akun
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-3 " href="/Admin/Logout">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1>Selamat Datang <?= $data['level'] . $data['nama'] ?></h1>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Seluruh Barang</h5>
                                <p class="card-text"><!-- Jangan lupa diganti -->10</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Barang dipinjam</h5>
                                <p class="card-text"><!-- Jangan lupa diganti -->10</p>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah User</h5>
                                <p class="card-text"><!-- Jangan lupa diganti -->0 orang.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Presentase Barang dipinjam</h5>
                                <p class="card-text"><!-- Jangan lupa diganti -->100%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <a href="index.php?page=data_peminjaman" style="text-decoration: none; color:auto"><h1 class="">Request Info</h1> </a>
                </div>
                <div class="table-responsive small mt-3">
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
                            
                        </tbody>
                    </table>
            </main>
        </div>
    </div>
