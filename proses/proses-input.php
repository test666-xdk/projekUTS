<?php
include '../config/class-kategori.php';
$kategori = new MasterData("localhost", "root", "", "db_simebel");

$dataKategori = [
    'id'        => uniqid(),
    'nama'      => $_POST['nama'],
    'deskripsi' => $_POST['deskripsi'],
    'harga'     => 0,
    'no_telp'   => $_POST['no_telp'],
];

$input = $kategori->inputKategori($dataKategori);

if ($input) {
    header("Location: ../data-list.php?status=inputsuccess");
} else {
    header("Location: ../data-input.php?status=failed");
}
?>