<?php
require_once './Models/pdo.php';?>
<?php require_once '../DuAn1/Controllers/category.php';?>
<?php require_once './Controllers/getcategory.php';?>
<?php

// // Kết nối đến cơ sở dữ liệu (PDO object)
// $pdo = pdo_get_connection(); // Đây là kết nối PDO

// if (!$pdo) {
//     echo json_encode(['error' => 'Không thể kết nối đến cơ sở dữ liệu']);
//     exit();
// }

// // Thực hiện truy vấn SQL để lấy dữ liệu
// $sql = "SELECT * FROM products"; // Thay đổi tên bảng phù hợp
// $stmt = $pdo->query($sql); // Thực thi truy vấn

// $data = $stmt->fetchAll(PDO::FETCH_ASSOC); // Lấy tất cả dữ liệu

// if (empty($data)) {
//     echo json_encode(['error' => 'Không có dữ liệu']);
// } else {
//     echo json_encode($data); // Trả về dữ liệu dưới dạng JSON
// }

// var_dump($data); // Kiểm tra kết quả
var_dump($categories);  // Kiểm tra dữ liệu danh mục
var_dump($subcategories);  // Kiểm tra danh mục con
?>
