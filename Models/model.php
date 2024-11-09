<?php
require_once("pdo.php");

class Model
{
    private $conn;

    function __construct()
    {
        $this->conn = pdo_get_connection();
    }

    function limit($a, $b)
    {
        $sql = "SELECT * FROM products WHERE product_count > 0 ORDER BY product_id DESC LIMIT ?, ?";
        return pdo_query($sql, $a, $b);
    }

    function categories()
    {
        $sql = "SELECT * FROM categories WHERE parent_id IS NULL";
        return pdo_query($sql);
    }
    
    function product_byCategory($a, $b, $category)
    {
        $sql = "SELECT * FROM products WHERE product_cat = ? ORDER BY product_id DESC LIMIT ?, ?";
        return pdo_query($sql, $category, $a, $b);
    }
}
?>
