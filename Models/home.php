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
    
}