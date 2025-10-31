<?php

include_once 'config/class-Kategori.php';
$kategori = new Kategori();
// Menampilkan alert berdasarkan status yang diterima melalui parameter GET
if(isset($_GET['status'])){
	// Mengecek nilai parameter GET 'status' dan menampilkan alert yang sesuai menggunakan JavaScript
	if($_GET['status'] == 'inputsuccess'){
		echo "<script>alert('Data Produk berhasil ditambahkan.');</script>";
	} else if($_GET['status'] == 'editsuccess'){
		echo "<script>alert('Data Produk berhasil diubah.');</script>";
	} else if($_GET['status'] == 'deletesuccess'){
		echo "<script>alert('Data Produk berhasil dihapus.');</script>";
	} else if($_GET['status'] == 'deletefailed'){
		echo "<script>alert('Gagal menghapus data Produk. Silakan coba lagi.');</script>";
	}
}
$dataKategori = $kategori->getAllKategori();

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
								<h3 class="mb-0">Daftar Produk</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Beranda</li>
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
										<h3 class="card-title">Tabel Produk</h3>
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
									<div class="card-body p-0 table-responsive">
										<table class="table table-striped" role="table">
											<thead>
												<tr>
													<th>nama kategori</th>
													<th>Deskripsi</th>
												</tr>
											</thead>
											<tbody>
												<?php
													if(count($datakategori == 0){
												   $koneksi = new mysql("localhost", "root", "", "db_simplecrud");
                                                   $query = "SELECT * FROM kategori";
                                                   $result = $koneksi->query($query);
                                                      ?>

                                                   <table border="1" width="100%">
                                                   <tr>
                                                   <th>Nama Kategori</th>
												   <th>Deskripsi</th>
                                                </tr>

                                               <?php
                                              if ($result->num_rows > 0) {
                                                $no = 1;
                                             while ($row = $result->fetch_assoc()) {
                                             echo "<tr>";
                                             echo "<td>" . $no++ . "</td>";
                                             echo "<td>" . $row['nama_kategori'] . "</td>";
                                             echo "</tr>";
                                            }
                                          } else {
                                      echo "<tr><td colspan='2' class='text-center'>Tidak ada data kategori.</td></tr>";
                                         }
                                            ?>
                                       </table>
													} else {
														foreach ($dataPelanggan as $index => $Pelanggan){
															if($pelanggan['status'] == 1){
															    $pelanggan['status'] = '<span class="badge bg-success">tersedia</span>';
															} elseif($pelanggan['status'] == 2){
															    $pelanggan['status'] = '<span class="badge bg-danger">Tidak tersedia</span>';
															} 
															echo '<tr class="align-middle">
																<td>'.($index + 1).'</td>
																<td>'.$nama['nama'].'</td>
																<td>'.$deskripsi['deskripsi'].'</td>
																<td class="text-center">
																	<button type="button" class="btn btn-sm btn-warning me-1" onclick="window.location.href=\'data-edit.php?id='.$kategori['id'].'\'"><i class="bi bi-pencil-fill"></i> Edit</button>
																	<button type="button" class="btn btn-sm btn-danger" onclick="if(confirm(\'Yakin ingin menghapus data kategori ini?\')){window.location.href=\'proses/proses-delete.php?id='.$kategori['id'].'\'}"><i class="bi bi-trash-fill"></i> Hapus</button>
																</td>
															</tr>';
														}
													}
												?>
											</tbody>
										</table>
									</div>
									<div class="card-footer">
										<button type="button" class="btn btn-primary" onclick="window.location.href='data-input.php'"><i class="bi bi-plus-lg"></i> Tambah kategori</button>
									</div>
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