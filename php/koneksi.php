<?php
/**
 * File Koneksi Database
 * Sanggar Tari Tatra KJD
 * 
 * @author Sanggar Tari Tatra KJD
 * @version 1.0
 * @created October 5, 2025
 */

// Konfigurasi Database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'sanggar_db');

// Set timezone untuk Indonesia
date_default_timezone_set('Asia/Jakarta');

// Set encoding untuk karakter Indonesia
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

class Database {
    private $host = DB_HOST;
    private $username = DB_USER;
    private $password = DB_PASS;
    private $database = DB_NAME;
    public $connection;
    
    /**
     * Constructor - Membuat koneksi database
     */
    public function __construct() {
        $this->connect();
    }
    
    /**
     * Membuat koneksi ke database MySQL
     */
    private function connect() {
        try {
            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
            $this->connection->set_charset("utf8");
            
            // Set timezone untuk MySQL
            $this->connection->query("SET time_zone = '+07:00'");
            
            if ($this->connection->connect_error) {
                throw new Exception("Koneksi database gagal: " . $this->connection->connect_error);
            }
            
        } catch (Exception $e) {
            $this->handleError("Koneksi Database", $e->getMessage());
        }
    }
    
    /**
     * Mendapatkan koneksi database
     */
    public function getConnection() {
        return $this->connection;
    }
    
    /**
     * Melakukan query SELECT
     */
    public function select($query, $params = []) {
        try {
            $stmt = $this->connection->prepare($query);
            
            if (!empty($params)) {
                $types = str_repeat('s', count($params));
                $stmt->bind_param($types, ...$params);
            }
            
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->fetch_all(MYSQLI_ASSOC);
            
        } catch (Exception $e) {
            $this->handleError("SELECT Query", $e->getMessage());
            return false;
        }
    }
    
    /**
     * Melakukan query INSERT
     */
    public function insert($query, $params = []) {
        try {
            $stmt = $this->connection->prepare($query);
            
            if (!empty($params)) {
                $types = str_repeat('s', count($params));
                $stmt->bind_param($types, ...$params);
            }
            
            $result = $stmt->execute();
            
            if ($result) {
                return $this->connection->insert_id;
            }
            
            return false;
            
        } catch (Exception $e) {
            $this->handleError("INSERT Query", $e->getMessage());
            return false;
        }
    }
    
    /**
     * Melakukan query UPDATE
     */
    public function update($query, $params = []) {
        try {
            $stmt = $this->connection->prepare($query);
            
            if (!empty($params)) {
                $types = str_repeat('s', count($params));
                $stmt->bind_param($types, ...$params);
            }
            
            $result = $stmt->execute();
            
            if ($result) {
                return $this->connection->affected_rows;
            }
            
            return false;
            
        } catch (Exception $e) {
            $this->handleError("UPDATE Query", $e->getMessage());
            return false;
        }
    }
    
    /**
     * Melakukan query DELETE
     */
    public function delete($query, $params = []) {
        try {
            $stmt = $this->connection->prepare($query);
            
            if (!empty($params)) {
                $types = str_repeat('s', count($params));
                $stmt->bind_param($types, ...$params);
            }
            
            $result = $stmt->execute();
            
            if ($result) {
                return $this->connection->affected_rows;
            }
            
            return false;
            
        } catch (Exception $e) {
            $this->handleError("DELETE Query", $e->getMessage());
            return false;
        }
    }
    
    /**
     * Menjalankan query custom
     */
    public function query($query) {
        try {
            $result = $this->connection->query($query);
            return $result;
        } catch (Exception $e) {
            $this->handleError("Custom Query", $e->getMessage());
            return false;
        }
    }
    
    /**
     * Memulai transaksi
     */
    public function beginTransaction() {
        $this->connection->autocommit(false);
    }
    
    /**
     * Commit transaksi
     */
    public function commit() {
        $this->connection->commit();
        $this->connection->autocommit(true);
    }
    
    /**
     * Rollback transaksi
     */
    public function rollback() {
        $this->connection->rollback();
        $this->connection->autocommit(true);
    }
    
    /**
     * Escape string untuk keamanan
     */
    public function escape($string) {
        return $this->connection->real_escape_string($string);
    }
    
    /**
     * Mendapatkan jumlah baris yang terpengaruh
     */
    public function getAffectedRows() {
        return $this->connection->affected_rows;
    }
    
    /**
     * Mendapatkan ID terakhir yang diinsert
     */
    public function getLastInsertId() {
        return $this->connection->insert_id;
    }
    
    /**
     * Cek apakah database terhubung
     */
    public function isConnected() {
        return ($this->connection && $this->connection->ping());
    }
    
    /**
     * Handle error dengan logging
     */
    private function handleError($type, $message) {
        $error_message = "[" . date('Y-m-d H:i:s') . "] $type Error: $message";
        
        // Log error ke file (opsional)
        error_log($error_message, 3, '../logs/database_error.log');
        
        // Untuk development, tampilkan error
        if (defined('DEBUG') && DEBUG) {
            die("Database Error: " . $message);
        }
        
        // Untuk production, tampilkan pesan umum
        die("Terjadi kesalahan pada sistem. Silakan coba lagi nanti.");
    }
    
    /**
     * Menutup koneksi database
     */
    public function close() {
        if ($this->connection) {
            $this->connection->close();
        }
    }
    
    /**
     * Destructor - Menutup koneksi saat objek dihancurkan
     */
    public function __destruct() {
        $this->close();
    }
}

/**
 * Fungsi helper untuk mendapatkan koneksi database
 */
function getDBConnection() {
    static $db = null;
    
    if ($db === null) {
        $db = new Database();
    }
    
    return $db;
}

/**
 * Fungsi helper untuk koneksi sederhana (backward compatibility)
 */
function connectDB() {
    try {
        $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if ($connection->connect_error) {
            throw new Exception("Koneksi gagal: " . $connection->connect_error);
        }
        
        $connection->set_charset("utf8");
        $connection->query("SET time_zone = '+07:00'");
        
        return $connection;
        
    } catch (Exception $e) {
        die("Error koneksi database: " . $e->getMessage());
    }
}

/**
 * Fungsi helper untuk format tanggal Indonesia
 */
function formatTanggal($date, $format = 'd/m/Y H:i') {
    return date($format, strtotime($date));
}

/**
 * Fungsi helper untuk format mata uang Rupiah
 */
function formatRupiah($amount) {
    return "Rp " . number_format($amount, 0, ',', '.');
}

/**
 * Fungsi helper untuk sanitasi input
 */
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

/**
 * Fungsi helper untuk validasi email
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Fungsi helper untuk validasi nomor telepon Indonesia
 */
function validatePhone($phone) {
    $phone = preg_replace('/[^0-9]/', '', $phone);
    return preg_match('/^(62|0)[0-9]{9,12}$/', $phone);
}

/**
 * Test koneksi database
 */
function testConnection() {
    try {
        $db = new Database();
        
        if ($db->isConnected()) {
            echo "<div style='background: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb; border-radius: 5px; margin: 10px;'>";
            echo "<strong>✅ Koneksi Database Berhasil!</strong><br>";
            echo "Host: " . DB_HOST . "<br>";
            echo "Database: " . DB_NAME . "<br>";
            echo "Waktu: " . date('Y-m-d H:i:s');
            echo "</div>";
            
            // Test query sederhana
            $result = $db->query("SELECT VERSION() as version");
            if ($result) {
                $version = $result->fetch_assoc();
                echo "<div style='background: #cce5ff; color: #0056b3; padding: 10px; border: 1px solid #99ccff; border-radius: 5px; margin: 10px;'>";
                echo "<strong>📊 Info Database:</strong><br>";
                echo "MySQL Version: " . $version['version'];
                echo "</div>";
            }
            
        } else {
            throw new Exception("Koneksi tidak aktif");
        }
        
    } catch (Exception $e) {
        echo "<div style='background: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f1aeb5; border-radius: 5px; margin: 10px;'>";
        echo "<strong>❌ Koneksi Database Gagal!</strong><br>";
        echo "Error: " . $e->getMessage();
        echo "</div>";
    }
}

// Set mode debug untuk development
define('DEBUG', true);

// Uncomment baris di bawah untuk test koneksi
// testConnection();

?>