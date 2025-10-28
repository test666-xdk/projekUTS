<?php

// Memasukkan file class-mahasiswa.php untuk mengakses class Mahasiswa
include '../config/class-mahasiswa.php';
// Membuat objek dari class Mahasiswa
$mahasiswa = new Pelanggan();
// Mengambil data mahasiswa dari form input menggunakan metode POST dan menyimpannya dalam array
$dataMahasiswa = [
    'nama' => $_POST['nim'],
    'nohp' => $_POST['nama'],
    'alamat' => $_POST['prodi'],
    'alamat' => $_POST['alamat'],
    'produkyangdipesan' => $_POST['provinsi'],
];
// Memanggil method inputMahasiswa untuk memasukkan data mahasiswa dengan parameter array $dataMahasiswa
$input = $mahasiswa->inputPelanggan($dataPelanggan);
// Mengecek apakah proses input berhasil atau tidak - true/false
if($input){
    // Jika berhasil, redirect ke halaman data-list.php dengan status inputsuccess
    header("Location: ../data-list.php?status=inputsuccess");
} else {
    // Jika gagal, redirect ke halaman data-input.php dengan status failed
    header("Location: ../data-input.php?status=failed");
}

?>