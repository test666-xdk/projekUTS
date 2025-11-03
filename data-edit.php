<?php 

include_once 'config/class-master.php';
include_once 'config/class-mahasiswa.php';
$master = new MasterData();
$kategori = new Kategori();
// Mengambil daftar program studi, provinsi, dan status mahasiswa
$idkategoriList = $master->getKategori();
// Mengambil daftar provinsi
$namakategoriList = $master->getKategori();
// Mengambil daftar status mahasiswa
$deskripsisList = $master->getDeskripsi();
// Mengambil data mahasiswa yang akan diedit berdasarkan id dari parameter GET
$dataMahasiswa = $mahasiswa->getUpdateMahasiswa($_GET['id']);
if(isset($_GET['status'])){
    if($_GET['status'] == 'failed'){
        echo "<script>alert('Gagal mengubah data kategori. Silakan coba lagi.');</script>";
    }
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
								<h3 class="mb-0">Edit Kategori</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Edit Data</li>
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
                                    <form action="proses/proses-edit.php" method="POST">
									    <div class="card-body">
                                            <input type="hidden" name="id" value="<?php echo $dataKategori['id']; ?>">
                                            <div class="mb-3">
                                                <label for="id" class="form-label">id kategori (id)</label>
                                                <input type="number" class="form-control" id="id" name="id" placeholder="Masukkan id Kategori" value="<?php echo $dataKategori['id']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Kategori</label>
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama kategori" value="<?php echo $dataKategori['nama']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="deskripsi" class="form-label">deskripsi</label>
                                                <select class="form-select" id="prodi" name="deskripsi" required>
                                                    <option value="" selected disabled>Pilih Deskripsi</option>
                                                    <?php 
                                                    // Iterasi daftar program studi dan menandai yang sesuai dengan data mahasiswa yang dipilih
                                                    foreach ($kategoriList as $kategori){
                                                        // Menginisialisasi variabel kosong untuk menandai opsi yang dipilih
                                                        $selectedProdi = "";
                                                        // Mengecek apakah program studi saat ini sesuai dengan data mahasiswa
                                                        if($dataKategori['kategori'] == $kategpri['id']){
                                                            // Jika sesuai, tandai sebagai opsi yang dipilih
                                                            $selectekategori = "selected";
                                                        }
                                                        // Menampilkan opsi program studi dengan penanda yang sesuai
                                                        echo '<option value="'.$kategori['id'].'" '.$selectedkategori.'>'.$kategori['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="no telepon" class="form-label">no telepon</label>
                                                <textarea class="form-control" id="alamat" name="no" rows="3" placeholder="Masukkan no telepon" required><?php echo $dataMahasiswa['no']; ?></textarea>
                                            </div>
                                                    <?php
                                                    // Iterasi daftar provinsi dan menandai yang sesuai dengan data mahasiswa yang dipilih
                                                    foreach ($provinsiList as $provinsi){
                                                        // Menginisialisasi variabel kosong untuk menandai opsi yang dipilih
                                                        $selectedProvinsi = "";
                                                        // Mengecek apakah provinsi saat ini sesuai dengan data mahasiswa
                                                        if($dataMahasiswa['provinsi'] == $provinsi['id']){
                                                            // Jika sesuai, tandai sebagai opsi yang dipilih
                                                            $selectedProvinsi = "selected";
                                                        }
                                                        // Menampilkan opsi provinsi dengan penanda yang sesuai
                                                        echo '<option value="'.$provinsi['id'].'" '.$selectedProvinsi.'>'.$provinsi['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                                    <?php 
                                                    // Iterasi daftar status mahasiswa dan menandai yang sesuai dengan data mahasiswa yang dipilih
                                                    foreach ($statusList as $status){
                                                        // Menginisialisasi variabel kosong untuk menandai opsi yang dipilih
                                                        $selectedStatus = "";
                                                        // Mengecek apakah status saat ini sesuai dengan data mahasiswa
                                                        if($dataMahasiswa['status'] == $status['id']){
                                                            // Jika sesuai, tandai sebagai opsi yang dipilih
                                                            $selectedStatus = "selected";
                                                        }
                                                        // Menampilkan opsi status dengan penanda yang sesuai
                                                        echo '<option value="'.$status['id'].'" '.$selectedStatus.'>'.$status['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
									    <div class="card-footer">
                                            <button type="button" class="btn btn-danger me-2 float-start" onclick="window.location.href='data-list.php'">Batal</button>
                                            <button type="submit" class="btn btn-warning float-end">Update Data</button>
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