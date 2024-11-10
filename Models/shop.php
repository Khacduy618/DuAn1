<?php
require_once("model.php");

class Shop extends Model
{
    var $table = "products";
    var $contents = "product_id";

    function limit( $offset, $limit) 
    {
        $sql = "SELECT * FROM products ORDER BY product_id DESC LIMIT $offset, $limit";
        return pdo_query($sql); // Chỉ bind tham số cho product_cat
    }
}
?>