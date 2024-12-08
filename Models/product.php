<?php
require_once("model.php");
class Product extends Model
{
    var $table = 'products';
    var $contents = 'product_id';

    function findById($id) {
        $sql = "SELECT p.product_id, p.product_name, p.product_price, p.product_img, p.product_status, p.product_cat, c.category_name
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

    function getDetailById($id) {
        $sql = "SELECT p.screen_cam, p.os, p.gpu, p.cpu, p.pin, p.colors, p.sizes, p.ram, p.rom, p.bluetooth FROM products p WHERE product_id = ?";
        return pdo_query_one($sql, $id);
    }
    
    function related_product($cat, $id) {
        $sql = "SELECT p.product_id, p.product_name, p.product_price, p.product_img, p.product_status, p.product_cat, c.category_name
                FROM products p
                JOIN categories c ON p.product_cat = c.category_id 
                WHERE product_cat = ? AND product_id != ?";
        return pdo_query($sql, $cat, $id);
    }
   
}