<?php
include_once 'db-simebel.php';

class MasterData extends Database {

    public function __construct($host, $user, $pass, $db) {
        parent::__construct($host, $user, $pass, $db);
    }

    // Ambil semua data kategori
    public function getKategori() {
        $query = "SELECT id_kategori AS nama_kategori AS nama, deskripsi, harga, no_telp, status FROM tb_kategori";
        $result = $this->conn->query($query);
        $kategori = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $kategori[] = $row;
            }
        }

        return $kategori;
    }

    // Input data kategori
    public function inputKategori($data) {
        $query = "INSERT INTO tb_kategori (id_kategori, nama_kategori, deskripsi, harga, no_telp, status) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) return false;

        $stmt->bind_param("sssdis", 
            $data['id_kategori'], 
            $data['nama_kategori'], 
            $data['deskripsi'], 
            $data['harga'], 
            $data['no_telp'], 
        );

        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Ambil daftar status
    public function getStatus() {
        return [
            ['id' => 1, 'nama' => 'Tersedia'],
            ['id' => 2, 'nama' => 'Tidak tersedia'],
        ];
    }
}
?>