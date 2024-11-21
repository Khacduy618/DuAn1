<?php
// Connect to the database using PDO
class Db {
    private $servername = "localhost"; 
    private $db = "Tede_Shop";

    private $username = "dichvun3";
    private $password = "3VwORS+87-jl4d";
    private $dbs = "mysql:host=s103d190-u2.interdata.vn;port=3306;dbname=Tede_Shop;charset=utf8";
    
    private $conn;

    public function connect() {
        try {
            $this->conn = new PDO($this->dbs, $this->username, $this->password);
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
