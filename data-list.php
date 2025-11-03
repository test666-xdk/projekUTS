<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'config/class-kategori.php';
$kategori = new MasterData("localhost", "root", "", "db_simebel");
$kategoriList = $kategori->getKategori();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kategori</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h3 class="mb-4">Daftar Kategori Produk</h3>
        <a href="data-input.php" class="btn btn-primary mb-3">+ Tambah Data</a>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
				    <th>harga</th>
                    <th>No. Telepon</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($kategoriList)): ?>
                    <?php foreach ($kategoriList as $item): ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><?= $item['nama'] ?></td>
                            <td><?= $item['deskripsi'] ?? '-' ?></td>
                            <td><?= $item['no_telp'] ?? '-' ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Belum ada data kategori.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>