<link rel="stylesheet" href="assets/custom/dashboard.css">
<style>
    ul li:hover{
        color: black;
        border-right: 5px solid blue;
    }
</style>
<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">SLH.CO</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3" aria-current="page" href="index.php">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 " href="index.php?page=list_admin">
                        Admin
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 " href="index.php?page=barang">
                        Data Barang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 " href="index.php?page=data_peminjaman">
                        Data Peminjaman
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 " href="index.php?page=data_pengembalian">
                        Data Pengembalian
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 " href="index.php?page=history">
                        History
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 " href="index.php?page=akun">
                        Akun
                    </a>
                </li>
            </ul>
            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 " href="logout.php">
                        Log out
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>