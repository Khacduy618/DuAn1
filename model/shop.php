<?php
require_once("model.php");
class Shop extends Model
{
    
    function categories($a,$b)
    {
        $sql = "SELECT * FROM categories WHERE category_id != NULL LIMIT $a, $b";
        return pdo_query($sql, $a, $b);
    }
    function keywork($a)
    {
        $a = "'%".$a."%'";
        $sql = "SELECT * FROM products WHERE product_name LIKE $a LIMIT 0,9";
        return pdo_query($sql, $a);
    }
    function price($a,$b)
    {
        if($a ==0 ){
            $a = "30000";
        }else{
            $a = $a."000000";
        }
        $b = $b."000000";
        $sql = "SELECT * FROM products WHERE  product_price > $a AND product_price < $b  LIMIT 0, 9";
        return pdo_query($sql, $a, $b);
    }
    function product_details($id)
    {
        $sql = "SELECT * FROM product_details WHERE  pro_id = '$id'";
        return pdo_query_one($sql, $id);
    }
    function product_top()
    {
        $sql = "SELECT * FROM products WHERE product_id = (SELECT pro_id sp FROM bill_details GROUP BY pro_id ORDER BY pro_count DESC LIMIT 10);";

        return pdo_query($sql);
    }
    // function count_sp()
    // {
    //     $sql = "SELECT COUNT(MaSP) as tong FROM sanpham";

    //     return $this->conn->sql($sql)->fetch_assoc();
    // }
    // function count_sp_dm($dm)
    // {
    //     $sql = "SELECT COUNT(MaSP) as tong FROM sanpham WHERE MaDM = $dm";

    //     return $this->conn->sql($sql)->fetch_assoc();
    // }
    // function count_sp_ctdm($dm,$ctdm)
    // {
    //     $sql = "SELECT COUNT(MaSP) as tong FROM sanpham WHERE MaDM = $dm And MaLSP = $ctdm";

    //     return $this->conn->sql($sql)->fetch_assoc();
    }
}