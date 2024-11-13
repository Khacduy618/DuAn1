<?php
require_once("model.php");
class Home extends Model
{
    var $table = "products";
    var $contents = "product_id";

    function pro_category($parent_id) {
        $sql = "SELECT p.*, c.category_name 
    FROM products p
    JOIN categories c ON p.product_cat = c.category_id
    WHERE c.parent_id = ?";
        return pdo_query($sql, $parent_id);
    }
    public function getSubCategories($parent_id)
{
    $sql = "SELECT * FROM categories WHERE parent_id = ?";
   return pdo_query_one($sql, $parent_id);
}
    function getsCategory(){
        $categorysql = "SELECT * FROM categories WHERE parent_id != ''";
        return pdo_query($categorysql);
    }
    function cateproducts($category_id) {
        $sqlcate = "SELECT p.*, c.category_name
            FROM products p
            JOIN categories c ON p.product_cat = c.category_id
            WHERE c.parent_id IS NOT NULL AND c.category_id = ?";
        return pdo_query($sqlcate, $category_id); 
    }
    function listproduct_trendingView($limt = 6,$ofset = 0,int $category_id = 4) {
        $sql = "SELECT products.*, categories.category_name
        FROM products
        JOIN categories ON products.product_cat = categories.category_id
        Where categories.category_id = $category_id
        ORDER BY products.view_count DESC
        LIMIT $limt OFFSET $ofset";
        return pdo_query($sql); // PDO đâng sida nè sao mà stmt đơn giản vậy được
    }

    function listproduct_trendingSell($limt = 6,$ofset = 0,int $category_id = 4) {
        $sql = "SELECT products.*, categories.category_name
        FROM products 
        JOIN categories ON products.product_cat = categories.category_id 
        Where categories.category_id = $category_id
        ORDER BY products.sell_count DESC
        LIMIT $limt OFFSET $ofset";
        // $params = [':limit' => $limt, ':ofset' => $ofset];
        // return pdo_query($sql,$params); // PDO đâng sida nè sao mà stmt đơn giản vậy được
        return pdo_query($sql); // PDO đâng sida nè sao mà stmt đơn giản vậy được
        
    }

    function listproduct_trendingSell_All($limit = 6, $offset = 0) {
    $sql = "SELECT products.*, categories.category_name
            FROM products 
            JOIN categories ON products.product_cat = categories.category_id 
            ORDER BY products.sell_count DESC
            LIMIT  $limit OFFSET $offset";
    
    return pdo_query($sql);
}

     public function takeHotSell($limit = 6, $offset = 0, int $category_id = 4) {
        $sql = "SELECT SP.*, SUM(DH.pro_count) AS SoLuongBan
                FROM products SP
                JOIN bill_details DH ON SP.product_id = DH.pro_id
                WHERE SP.product_cat = ? 
                GROUP BY SP.product_id
                ORDER BY SoLuongBan DESC
                LIMIT $limit OFFSET $offset
                ";
    
    return pdo_query($sql, $category_id );
}

}