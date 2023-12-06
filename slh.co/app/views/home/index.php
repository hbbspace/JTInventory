<style>
    .card{
        background-color: #87C4FF;
    }
</style>
<div class="container-fluid">
    <div class="row">
    <?php include "menu.php";
    ?>
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