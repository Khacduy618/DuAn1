<?php
require_once("model.php");
class Cart extends Model
{
    function detail_sp($id)
    {
        $sql =  "SELECT * from products where product_id = ? ";
        return pdo_query_one($sql, $id);
    }
    
    function get_cart_by_user($userEmail)
    {
        $sql = "SELECT * FROM cart WHERE cart_userEmail = ?";
        return pdo_query_one($sql, $userEmail);
    }

}