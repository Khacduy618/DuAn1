<?php
require_once("pdo.php");
class Model
{
    var $conn;
    function __construct()
    {
        $conn_obj = new pdo_get_connection();
        $this->conn = $conn_obj->conn;
    }

    function limit($a, $b)
    {
        $sql =  "SELECT * from products WHERE product_count > 0 ORDER BY product_id DESC limit $a,$b";

        return pdo_query($sql, $a, $b);
    }

    function categories()
    {
        $sql =  "SELECT * from categories where parent_id = NULL";
        return pdo_query($sql);
    }
    
    function product_byCategory($a, $b, $category)
    {
        $sql =   "SELECT * from products where product_cat = $category ORDER BY product_id DESC limit $a,$b";

       return pdo_query($sql, $a, $b, $category);
    }
}
