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
    public function pro_discount() {
        $sql ="SELECT 
    products.*, 
    categories.category_name FROM products JOIN categories ON 
    products.product_cat = categories.category_id WHERE  products.product_discount > 20";
        return pdo_query($sql);
    }
    public function favorite_reviews(){
        $sql = "SELECT p.product_id, p.product_name, p.product_price, p.product_img, AVG(r.helpful - r.unhelpful)
         AS average_rating, COUNT(r.review_id) AS total_reviews, c.category_name FROM products p JOIN reviews r ON 
         p.product_id = r.pro_id JOIN categories c ON p.product_cat = c.category_id JOIN review_categories rc ON 
         rc.review_categoryId = r.review_category GROUP BY p.product_id ORDER BY average_rating DESC, total_reviews 
         DESC LIMIT 10";
         return pdo_query($sql);
    }
    public function Selling_product(){
        $sql = "SELECT  p.product_id, p.product_name, p.product_price, p.product_img, SUM(bd.pro_count) AS total_sold,
    c.category_name FROM bill_details bd JOIN products p ON bd.pro_id = p.product_id JOIN categories c ON 
    p.product_cat = c.category_id GROUP BY p.product_id ORDER BY  total_sold DESC LIMIT 10";
    return pdo_query($sql);
    }
    public function New_Product(){
        $sql = "SELECT p.product_id, p.product_name, p.product_price, p.product_img, p.created_at, c.category_name
    FROM products p JOIN categories c ON p.product_cat = c.category_id WHERE p.product_status = 1 AND p.product_count > 0
    ORDER BY p.created_at DESC LIMIT 10";
    return pdo_query($sql);
    }
}