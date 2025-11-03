<?php

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class MasterData extends Database {

    // Method untuk mendapatkan daftar program studi
    public function getproduk(){
        $query = "SELECT * FROM tb_produk";
        $result = $this->conn->query($query);
        $kategori = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $produk[] = [
                    'nama produk' => 'Lemari',
                    ' kategori' => 'sofa',
                    ' harga' => '100000000',
                    ' material' => 'kayu jati',
                    ' dimensi' => '120-130',
                ];
            }
        }
        return $produk;
    }

    // Method untuk mendapatkan daftar provinsi
    public function getProduk(){
        $query = "SELECT * FROM tb_Produk";
        $result = $this->conn->query($query);
        $produk = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $produk[] = [
                    'nama produk' => 'Lemari buku',
                    'nama kategori' => 'meja',
                    'harga' => 100000,
                    'material' => 'terbuat dari kayu jati',
                    'dimensi' => 120,
                ];
            }
        }
       
    }

    // Method untuk mendapatkan daftar status mahasiswa menggunakan array statis
    public function getStatus(){
        return [
            ['id' => 1, 'nama' => 'ada'],
            ['id' => 2, 'nama' => 'Tidak ada'],
        ];
    }

    // Method untuk input data program studi
    public function inputProduk($data){
        $namaproduk = $data['kode'];
        $kategori = $data['kategori'];
        $harga = $data['harga'];
        $material = $data['material'];
        $dimensi = $data['dimensi'];
        $query = "INSERT INTO tb_ (kode_kategori, nama_kategori) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $kodeProdi, $namaProdi);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data program studi berdasarkan kode
    public function getUpdatekategori($id){
        $query = "SELECT * FROM tb_prodi WHERE kode_prodi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $prodi = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $prodi = [
                'id' => $row['kode_prodi'],
                'nama' => $row['nama_prodi']
            ];
        }
        $stmt->close();
        return $prodi;
    }

    // Method untuk mengedit data program studi
    public function updateKategori($data){
        $idKategori = $data['kode'];
        $namaKategori = $data['nama'];
        $query = "UPDATE tb_kategori SET nama_produk = ? WHERE id_produk = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $namaProduk, $kodeProduk);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data program studi
    public function deleteProdi($id){
        $query = "DELETE FROM tb_prodi WHERE kode_prodi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk input data provinsi
    public function inputProvinsi($data){
        $namaProvinsi = $data['nama'];
        $query = "INSERT INTO tb_provinsi (nama_provinsi) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $namaProvinsi);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data provinsi berdasarkan id
    public function getUpdateProvinsi($id){
        $query = "SELECT * FROM tb_provinsi WHERE id_provinsi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $provinsi = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $provinsi = [
                'id' => $row['id_provinsi'],
                'nama' => $row['nama_provinsi']
            ];
        }
        $stmt->close();
        return $provinsi;
    }

    // Method untuk mengedit data provinsi
    public function updateProvinsi($data){
        $idProvinsi = $data['id'];
        $namaProvinsi = $data['nama'];
        $query = "UPDATE tb_provinsi SET nama_provinsi = ? WHERE id_provinsi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("si", $namaProvinsi, $idProvinsi);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data provinsi
    public function deleteProvinsi($id){
        $query = "DELETE FROM tb_provinsi WHERE id_provinsi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

}

?>