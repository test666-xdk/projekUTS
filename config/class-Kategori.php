<?php 

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class Kategori extends Database {

    // Method untuk input data mahasiswa
    public function inputMahasiswa($data){
        // Mengambil data dari parameter $data
        $prodi     = $data['id'];
        $nama     = $data['nama kategori'];
        $deskripsi    = $data['deskripsi'];
        // Menyiapkan query SQL untuk insert data menggunakan prepared statement
        $query = "INSERT INTO tb_mahasiswa (id_kategori, nama_kategori deskripsi) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        // Mengecek apakah statement berhasil disiapkan
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ssssssss", $id, $nama, $produk, );
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mengambil semua data mahasiswa
    public function getAllKategori(){
        // Menyiapkan query SQL untuk mengambil data mahasiswa beserta prodi dan provinsi
        $query = "SELECT id_kategori nama_kategori deskripsi
                  FROM tb_kategori
                  JOIN tb_produk ON produk_kategori = kode_produk
        $result = $this->conn->query($query);
        // Menyiapkan array kosong untuk menyimpan data Kategori
        $kategori = [];
        // Mengecek apakah ada data yang ditemukan
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                $kategori[] = [
                    'id' => $row['id_kategori'],
                    'nama' => $row['nama_kategori'],
                    'deskripsi' => $row['deskripsi'],
                ];
            }
        }
        // Mengembalikan array data kategori
        return $kategori;
    }

    // Method untuk mengambil data mahasiswa berdasarkan ID
    public function getUpdateMahasiswa($id){
        // Menyiapkan query SQL untuk mengambil data mahasiswa berdasarkan ID menggunakan prepared statement
        $query = "SELECT * FROM tb_kategori WHERE id_kategori= ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = false;
        if($result->num_rows > 0){
            // Mengambil data Kategori 
            $row = $result->fetch_assoc();
            // Menyimpan data dalam array
            $data = [
                'id' => $row['id_kategori'],
                'nama' => $row['nama_kategori'],
                'deskripsi' => $row['deskripsi'],
            ];
        }
        $stmt->close();
        // Mengembalikan data kategori
        return $data;
    }

    // Method untuk mengedit data mahasiswa
    public function editMahasiswa($data){
        // Mengambil data dari parameter $data
        $id       = $data['id'];
        $nim      = $data['nama'];
        $deskripsi     = $data['deskripsi'];
        // Menyiapkan query SQL untuk update data menggunakan prepared statement
        $query = "UPDATE tb_kategori SET id_kategori = ?, nama_kategori = ?, deskrpsi  = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ssssssssi", $id, $nama, $deskripsi,);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk menghapus data Kategori
    public function deleteMahasiswa($id){
        // Menyiapkan query SQL untuk delete data menggunakan prepared statement
        $query = "DELETE FROM tb_kategori WHERE id_kategori = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mencari data mahasiswa berdasarkan kata kunci
    public function searchMahasiswa($kataKunci){
        // Menyiapkan LIKE query untuk pencarian
        $likeQuery = "%".$kataKunci."%";
        // Menyiapkan query SQL untuk pencarian data mahasiswa menggunakan prepared statement
        $query = "SELECT id_kategori, nama_kategori
                  FROM tb_Kategori
                  JOIN tb_produk ON produk_kategori = kode_produk
                  WHERE id_kategori LIKE ? OR nama_kategori LIKE ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            // Mengembalikan array kosong jika statement gagal disiapkan
            return [];
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        // Menyiapkan array kosong untuk menyimpan data kategori
        $kategori= [];
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                // Menyimpan data kategori dalam array
                $kategori[] = [
                    'id' => $row['id_kategori'],
                    'nama' => $row['nama_kategori'],
                    'deskripsi' => $row['deskrpsi'],
                ];
            }
        }
        $stmt->close();
        // Mengembalikan array data kategori yang ditemukan
        return $kategori;
    }

}

?>