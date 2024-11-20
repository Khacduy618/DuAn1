<?php
// Connect to the database using PDO
class Db {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "restful_php_api";
    private $conn;

    public function connect() {
        try {
            $this->conn = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->db, $this->username, $this->password);
            // Set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Kết nối thành công"; // Connection successful
        } catch (PDOException $e) {
            echo "Kết nối thất bại: " . $e->getMessage(); // Connection failed
        }
        return $this->conn;
    }
    public function getConn(){return $this->conn;}
}
?>
