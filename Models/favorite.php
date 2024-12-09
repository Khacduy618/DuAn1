<?php
require_once('model.php');
class Favorite extends Model
{
    var $table = 'favorites';
    
    function add($userEmail, $productId){
        $sql = "INSERT INTO $this->table (favorite_userEmail, favorite_proid) VALUES (?, ?)";
        return pdo_execute($sql, $userEmail, $productId);
    }

    function delete($id){
        $sql = "DELETE FROM $this->table WHERE favorite_id = ?";
        return pdo_execute($sql, $id);
    }

    function findByUser($userEmail){
        $sql = "SELECT f.favorite_id, f.favorite_userEmail, f.favorite_proid,
                p.product_id, p.product_name, p.product_price, p.product_img, p.product_count 
                FROM $this->table f 
                JOIN products p ON f.favorite_proid = p.product_id 
                WHERE f.favorite_userEmail = ?";
        return pdo_query($sql, $userEmail);
    }

    function findByUserAndProduct($userEmail, $productId){
        $sql = "SELECT * FROM $this->table 
                WHERE favorite_userEmail = ? AND favorite_proid = ?";
        return pdo_query_one($sql, $userEmail, $productId);
    }

    function getRecentFavorites($userEmail, $limit = 3) {
        $sql = "SELECT f.*, p.* FROM $this->table f 
                JOIN products p ON f.favorite_proid = p.product_id 
                WHERE f.favorite_userEmail = ? 
                ORDER BY f.favorite_id DESC 
                LIMIT $limit";
        return pdo_query($sql, $userEmail);
    }

    function countFavorites($userEmail) {
        $sql = "SELECT COUNT(*) as total FROM $this->table WHERE favorite_userEmail = ?";
        $result = pdo_query_one($sql, $userEmail);
        return $result['total'];
    }
    function isProductFavorited($userEmail, $productId) {
    $sql = "SELECT COUNT(*) as count FROM $this->table 
            WHERE favorite_userEmail = ? AND favorite_proid = ?";
    $result = pdo_query_one($sql, $userEmail, $productId);
    return $result['count'] > 0;
}
}
?>