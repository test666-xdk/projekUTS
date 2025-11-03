<?php 
include_once 'db-config.php';

class Kategori extends Database {

    public function inputKategori($data){
        $id         = $data['id_kategori'];
        $kategori   = $data['kategori'];
        $deskripsi  = $data['deskripsi'];
        $no_telepon = $data['no_telepon'];

        $query = "INSERT INTO tb_kategori (id_kategori, nama_kategori, deskripsi, no_telepon) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;

        $stmt->bind_param("ssss", $id, $kategori, $deskripsi, $no_telepon);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function getAllKategori(){
        $query = "SELECT id_kategori, nama_kategori, deskripsi, no_telepon FROM tb_kategori";
        $result = $this->conn->query($query);
        $kategori = [];

        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $kategori[] = [
                    'id'         => $row['id_kategori'],
                    'nama'       => $row['nama_kategori'],
                    'deskripsi'  => $row['deskripsi'],
                    'no_telepon' => $row['no_telepon'],
                ];
            }
        }
        return $kategori;
    }

    public function getKategoriById($id){
        $query = "SELECT * FROM tb_kategori WHERE id_kategori = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;

        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = false;

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $data = [
                'id'         => $row['id_kategori'],
                'kategori'   => $row['nama_kategori'],
                'deskripsi'  => $row['deskripsi'],
                'no_telepon' => $row['no_telepon'],
            ];
        }
        $stmt->close();
        return $data;
    }

    public function editKategori($data){
        $id         = $data['id_kategori'];
        $kategori   = $data['kategori'];
        $deskripsi  = $data['deskripsi'];
        $no_telepon = $data['no_telepon'];

        $query = "UPDATE tb_kategori SET nama_kategori = ?, deskripsi = ?, no_telepon = ? WHERE id_kategori = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;

        $stmt->bind_param("ssss", $kategori, $deskripsi, $no_telepon, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function deleteKategori($id){
        $query = "DELETE FROM tb_kategori WHERE id_kategori = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;

        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function searchKategori($kataKunci){
        $likeQuery = "%".$kataKunci."%";
        $query = "SELECT id_kategori, nama_kategori, deskripsi, no_telepon FROM tb_kategori 
                  WHERE id_kategori LIKE ? OR nama_kategori LIKE ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return [];

        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        $kategori = [];

        if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $kategori[] = [
            'id'         => $row['id_kategori'],
            'nama'       => $row['nama_kategori'],
            'deskripsi'  => $row['deskripsi'],
            'no_telepon' => $row['no_telepon'],
        ];
    }
}

}
}