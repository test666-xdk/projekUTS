<?php
// Menghubungkan ke file konfigurasi database
include_once 'db-config.php';

class Kategori extends Database {

    // ===== 1️⃣ INPUT Produk BARU =====
    public function inputMenu($data){
        // Mengambil data dari form (array $data)
        $namaproduk     = $data['nama'];
        $kategori  = $data['kategori'];
        $deskripsi    = $data['deskripsi'];
        $harga = $data['harga'];
        $no_telp  = $data['no_telp'];
        $material = $data['material'];

        // ⚠️ Gunakan query INSERT untuk menambah data
        $query = "INSERT INTO tb_kategori (nama_produk, kategori, deskripsi, harga, no_telp, material ) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        // Cek apakah statement berhasil dibuat
        if(!$stmt){
            return false;
        }

        // Mengikat parameter ke query
        $stmt->bind_param("ssiss", $nama, $kategori, $deskripsi, $harga, $no_telp $material);

        // Eksekusi dan simpan hasilnya
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // ===== 2️⃣ MENGAMBIL SEMUA DATA MENU =====
    public function getAllMenu(){
        $query = "SELECT id_kategori, nama_kategori, deskripsi, harga, no_telp, material FROM tb_kategori";
        $result = $this->conn->query($query);
        $menu = [];

        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $menu[] = $row;
            }
        }
        return $menu;
    }

    // ===== 3️⃣ MENGAMBIL MENU BERDASARKAN ID (getUpdateMenu - lama) =====
    public function getUpdateMenu($id){
        $query = "SELECT * FROM tb_kategori WHERE id_kategori = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();

        return $data;
    }

    // ✅ ===== 3b️⃣ TAMBAHAN BARU: getMenuById() =====
    // (fungsi ini yang dipakai oleh data-edit.php)
    public function getMenuById($id){
        $query = "SELECT * FROM tb_kategori WHERE id_kategori = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();

        return $data;
    }

    // ===== 4️⃣ MENGEDIT MENU =====
    public function editMenu($data){
        $namaproduk     = $data['nama'];
        $kategori  = $data['kategori'];
        $deskripsi    = $data['deskripsi'];
        $harga = $data['harga'];
        $no_telp  = $data['no_telp'];
        $material = $data['material'];

        $query = "UPDATE tb_kategori SET nama_kategori = ?, kategori = ?, deskripsi = ?, harga  = ?, status = ? WHERE id_kategori = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }

        $stmt->bind_param("ssissi", $nama, $kategori, $harga, $deskripsi, $material, $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // ===== 5️⃣ MENGHAPUS MENU =====
    public function deleteMenu($id){
        $query = "DELETE FROM tb_kategori WHERE id_menu = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }

        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // ===== 6️⃣ MENCARI MENU BERDASARKAN NAMA ATAU KATEGORI =====
    public function searchMenu($kataKunci){
        $likeQuery = "%".$kataKunci."%";
        $query = "SELECT id_kategori, nama_kategori,harga, deskripsi, material
                  FROM tb_kategori
                  WHERE nama_kategori LIKE ? OR kategori LIKE ?";
        $stmt = $this->conn->prepare($query);

        if(!$stmt){
            return [];
        }

        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        $menu = [];

        while($row = $result->fetch_assoc()){
            $menu[] = $row;
        }

        $stmt->close();
        return $menu;
    }
}
?>