<?php
class Question {
    private $conn;

    // Question properties
    public $id_cauhoi;
    public $title;
    public $cau_a;
    public $cau_b;
    public $cau_c;
    public $cau_d;
    public $cau_dung;

    // Constructor to initialize database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to read data
    public function read() {
        $query = "SELECT * FROM cauhoi AS c ORDER BY c.id_cauhoi DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Show data
    public function show() {
        $query = "SELECT * FROM cauhoi WHERE id_cauhoi = ? LIMIT 1";
        
        $stmt = $this->conn->prepare($query); // Fixed assignment operator and syntax

        // Bind the ID parameter
        $stmt->bindParam(1, $this->id_cauhoi); // Corrected bind parameter position and variable name

        // Execute the query
        $stmt->execute();

        // Fetch the result
        $row = $stmt->fetch(PDO::FETCH_ASSOC); // Fetches the record into an associative array

        // Map result to object properties
        if ($row) {
            $this->title = $row['title'];    // Corrected assignment operator
            $this->cau_a = $row['cau_a'];   // Corrected assignment operator
            $this->cau_b = $row['cau_b'];   // Corrected assignment operator
            $this->cau_c = $row['cau_c'];   // Corrected assignment operator
            $this->cau_d = $row['cau_d'];   // Corrected field name and assignment operator
            $this->cau_dung = $row['cau_dung']; // Corrected assignment operator
        } else {
            // Handle the case where no record is found
            throw new Exception("No question found with the given ID.");
        }
    }

    public function create() {
        $query = "Insert into cauhoi set title = :title, cau_a = :cau_a, cau_b = :cau_b, cau_c = :cau_c, cau_d = :cau_d, cau_dung = :cau_dung";
        $stmt = $this->conn->prepare($query);
        // clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->cau_a = htmlspecialchars(strip_tags($this->cau_a));
        $this->cau_b = htmlspecialchars(strip_tags($this->cau_b));
        $this->cau_c = htmlspecialchars(strip_tags($this->cau_c));
        $this->cau_d = htmlspecialchars(strip_tags($this->cau_d));
        $this->cau_dung = htmlspecialchars(strip_tags($this->cau_dung));
        //bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':cau_a', $this->cau_a);
        $stmt->bindParam(':cau_b', $this->cau_b);
        $stmt->bindParam(':cau_c', $this->cau_c);
        $stmt->bindParam(':cau_d', $this->cau_d);
        $stmt->bindParam(':cau_dung', $this->cau_dung);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function update() {
        // Câu truy vấn SQL
        $query = "UPDATE cauhoi 
                  SET title = :title, 
                      cau_a = :cau_a, 
                      cau_b = :cau_b, 
                      cau_c = :cau_c, 
                      cau_d = :cau_d, 
                      cau_dung = :cau_dung 
                  WHERE id_cauhoi = :id_cauhoi";
    
        // Chuẩn bị truy vấn
        $stmt = $this->conn->prepare($query);
    
        // Làm sạch dữ liệu đầu vào
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->cau_a = htmlspecialchars(strip_tags($this->cau_a));
        $this->cau_b = htmlspecialchars(strip_tags($this->cau_b));
        $this->cau_c = htmlspecialchars(strip_tags($this->cau_c));
        $this->cau_d = htmlspecialchars(strip_tags($this->cau_d));
        $this->cau_dung = htmlspecialchars(strip_tags($this->cau_dung));
        $this->id_cauhoi = htmlspecialchars(strip_tags($this->id_cauhoi));
    
        // Gắn giá trị cho các tham số
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':cau_a', $this->cau_a);
        $stmt->bindParam(':cau_b', $this->cau_b);
        $stmt->bindParam(':cau_c', $this->cau_c);
        $stmt->bindParam(':cau_d', $this->cau_d);
        $stmt->bindParam(':cau_dung', $this->cau_dung);
        $stmt->bindParam(':id_cauhoi', $this->id_cauhoi);
    
        // Thực thi truy vấn
        if ($stmt->execute()) {
            return true;
        }
    
        // In lỗi nếu có
        printf("Error: %s.\n", $stmt->error);
    
        return false;
    }

    public function delete() {
        // Câu truy vấn xóa
        $query = "DELETE FROM cauhoi WHERE id_cauhoi = :id_cauhoi";
        $stmt = $this->conn->prepare($query);
    
        // Làm sạch dữ liệu
        $this->id_cauhoi = htmlspecialchars(strip_tags($this->id_cauhoi));
    
        // Gắn tham số
        $stmt->bindParam(':id_cauhoi', $this->id_cauhoi);
    
        // Thực thi truy vấn
        if ($stmt->execute()) {
            return true;
        }
    
        // Xử lý lỗi
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    
    

}
?>
