<?php 
include_once __DIR__ . '/config/class-kategori.php';
$kategori = new Kategori("localhost", "root", "", "db_simplecrud");

// Mengambil daftar kategori dan status
$kategoriList = $kategori->getKategori();
$statusList = $kategori->getStatus();

// Menampilkan alert jika gagal
if (isset($_GET['status']) && $_GET['status'] == 'failed') {
    echo "<script>alert('Gagal menambahkan data produk. Silakan coba lagi.');</script>";
}
?>

<!doctype html>
<html lang="en">
<head>
    <?php include 'template/header.php'; ?>
</head>
<body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg sidebar-open bg-body-tertiary">
    <div class="app-wrapper">
        <?php include 'template/navbar.php'; ?>
        <?php include 'template/sidebar.php'; ?>

        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Input Produk</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Input Data</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="app-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Formulir Kategori</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse">
                                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                </div>

                                <form action="proses/proses-input.php" method="POST">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="id_kategori" class="form-label">ID Kategori</label>
                                            <input type="number" class="form-control" id="id_kategori" name="id_kategori" placeholder="Masukkan ID Kategori" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="kategori" class="form-label">Kategori</label>
                                            <select class="form-select" id="kategori" name="kategori" required>
                                                <option value="" selected disabled>Pilih Kategori</option>
                                                <?php 
                                                foreach ($kategoriList as $item){
                                                    echo '<option value="'.$item['id'].'">'.$item['nama'].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi" required></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="no_telepon" class="form-label">Nomor Telepon</label>
                                            <input type="tel" class="form-control" id="no_telepon" name="no_telepon" placeholder="Masukkan Nomor Telepon/HP" pattern="[0-9+\-\s()]{6,20}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="status" class="form-label">Ketersediaan Kayu</label>
                                            <select class="form-select" id="status" name="status" required>
                                                <option value="" selected disabled>Pilih Status</option>
                                                <?php 
                                                foreach ($statusList as $item){
                                                    echo '<option value="'.$item['id'].'">'.$item['nama'].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="button" class="btn btn-danger me-2 float-start" onclick="window.location.href='data-list.php'">Batal</button>
                                        <button type="reset" class="btn btn-secondary me-2 float-start">Reset</button>
                                        <button type="submit" class="btn btn-primary float-end">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php include 'template/footer.php'; ?>
    </div>

    <?php include 'template/script.php'; ?>
</body>
</html>
