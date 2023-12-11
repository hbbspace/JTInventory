<head>
    <style>

    </style>
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
                                <a class="nav-link d-flex align-items-center gap-3" aria-current="page" href="<?= base_url; ?>/Admin">
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-3 " href="<?= base_url; ?>/Admin/Akun">
                                    Data Admin
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
                                <a class="nav-link d-flex align-items-center gap-3 " href="<?= base_url; ?>/Admin/tampilProfile">
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