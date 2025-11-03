<<?php

class Database {
    // Konfigurasi database
    private $db_host = "localhost";      // Host database
    private $db_user = "root";           // Username database
    private $db_pass = "";               // Password database
    private $db_name = "db_simplecrud";  // Nama database

    public $conn; // Properti koneksi database

    // Konstruktor: otomatis membuat koneksi saat class dipanggil
    public function __construct() {
        $this->connect();
    }

    // Method untuk membuat koneksi database
    private function connect() {
        $this->conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

        // Cek koneksi
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }
}

?>
