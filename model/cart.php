<?php
require_once("model.php");
class Cart extends Model
{
    function detail_sp($id)
    {
        $sql =  "SELECT * from products where product_id = $id ";
        return pdo_query_one($sql, $id);
    }
}