<?php
require_once("model.php");

class Category extends Model {
    var $table = "categories";
    var $contents = "category_id";

    public function list() {
        $sql = "SELECT c.*,
                (SELECT COUNT(*) FROM products WHERE product_cat = c.category_id) as product_count
                FROM categories c
                ORDER BY 
                    IF(c.parent_id IS NULL, c.category_id, c.parent_id),
                    c.category_id";
        return pdo_query($sql);
    }
    
}