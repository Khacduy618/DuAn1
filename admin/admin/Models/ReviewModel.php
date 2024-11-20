<?php
require_once __DIR__ . '/../../Models/pdo.php';

class ReviewModel {
    public function getReviews() {
        $sql = "SELECT p.product_id, p.product_name, COUNT(r.review_id) AS review_count, 
                       MIN(r.review_dateTime) AS oldest_review, 
                       MAX(r.review_dateTime) AS latest_review
                FROM reviews r
                JOIN products p ON r.pro_id = p.product_id
                GROUP BY r.pro_id";
        return pdo_query($sql); 
    }
    
public function getCommentsByProductId($productId) {
    $sql = "SELECT r.review_id AS id, r.review_content AS content, 
                   r.review_dateTime AS date, r.review_userEmail AS user,
                   r.review_category AS rating
            FROM reviews r
            WHERE r.pro_id = ?";
    return pdo_query($sql, $productId); 
}

    public function deleteCommentById($commentId) {
        $sql = "DELETE FROM reviews WHERE review_id = ?";
        return pdo_execute($sql, $commentId); 
    }
}
class ReviewCategoryModel {
    public function getCategories() {
        $sql = "SELECT * FROM review_categories";
        return pdo_query($sql); 
    }
}
class ProductModel {
    public function getProductById($productId) {
        $sql = "SELECT * FROM products WHERE product_id = ?";
        return pdo_query_one($sql, $productId);
    }
}
?>
