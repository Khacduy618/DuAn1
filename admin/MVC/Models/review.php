<?php
require("model.php");
class Review extends Model
{
    public function getReviews() {
        $sql = "SELECT p.product_id, p.product_name, COUNT(r.review_id) AS review_quantity, 
                       MIN(r.review_dateTime) AS oldest_review, 
                       MAX(r.review_dateTime) AS latest_review
                FROM reviews r
                JOIN products p ON r.pro_id = p.product_id
                GROUP BY r.pro_id";
        return pdo_query($sql); 
    }
   
    public function commentFindByProId($id) {
        $sql = "SELECT r.review_id AS id, r.review_content AS content, 
                    r.review_dateTime AS date, r.review_userEmail AS user,
                    r.review_category AS rating
                FROM reviews r
                WHERE r.pro_id = ?";
        return pdo_query($sql, $id); 
    }

    public function delComment($id) {
        $sql = "DELETE FROM reviews WHERE review_id = ?";
         pdo_execute($sql, $id); 
    }

     public function findProductByID($id) {
        $sql = "SELECT * FROM products WHERE product_id = ?";
        return pdo_query_one($sql, $id);
    }
}