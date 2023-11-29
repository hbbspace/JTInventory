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
                        <svg class="bi">
                            <use xlink:href="#house-fill" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 " href="index.php?page=list_admin">
                        <svg class="bi">
                            <use xlink:href="#people" />
                        </svg>
                        Admin
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 " href="index.php?page=barang">
                        <svg class="bi">
                            <use xlink:href="#puzzle" />
                        </svg>
                        Data Barang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 " href="index.php?page=data_peminjaman">
                        <svg class="bi">
                            <use xlink:href="#puzzle" />
                        </svg>
                        Data Peminjaman
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 " href="index.php?page=data_pengembalian">
                        <svg class="bi">
                            <use xlink:href="#puzzle" />
                        </svg>
                        Data Pengembalian
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 " href="index.php?page=history">
                        <svg class="bi">
                            <use xlink:href="#puzzle" />
                        </svg>
                        History
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 " href="index.php?page=akun">
                        <svg class="bi">
                            <use xlink:href="#puzzle" />
                        </svg>
                        Akun
                    </a>
                </li>
            </ul>
            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 " href="logout.php">
                        <svg class="bi">
                            <use xlink:href="#door-closed" />
                        </svg>
                        Log out
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>