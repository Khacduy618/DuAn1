<?php
require_once("model.php");
class Product extends Model
{
    var $table = 'products';
    var $contents = 'product_id';

    function findById($id) {
        $sql = "SELECT p.*, c.category_name
                FROM products p
                JOIN categories c ON p.product_cat = c.category_id 
                WHERE p.product_id = ? AND c.parent_id != 0";
        return pdo_query_one($sql, $id);
    }
    function detail_sp($id)
    {
        $sql =  "SELECT * from product_details where pro_id = ? ";
        return pdo_query_one($sql, $id);
    }
   
   
}