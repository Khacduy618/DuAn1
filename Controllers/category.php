<?php
require_once __DIR__ . '/../Models/pdo.php';

class Category {
    // Hàm lấy tất cả danh mục cha
    public function getCategories() {
        $sql = "SELECT * FROM categories WHERE parent_id IS NULL";
        return pdo_query($sql);
    }

    // Hàm lấy tất cả danh mục con theo parent_id
    public function getSubcategories($parentId) {
        $sql = "SELECT * FROM categories WHERE parent_id = ?";
        return pdo_query($sql, $parentId);
    }

    // Hàm lấy sản phẩm theo category_id
    public function getProductsByCategory($categoryId) {
        $sql = "SELECT * FROM products WHERE category_id = ?";
        return pdo_query($sql, $categoryId);
    }
}

?>
