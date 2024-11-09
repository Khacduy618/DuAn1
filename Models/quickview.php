<?php
require_once("model.php");
class Quickview extends Model
{
    function detail_sp($id)
    {
        $sql =  "SELECT * from product_details where pro_id = $id ";
        return pdo_query_one($sql, $id);
    }    
}