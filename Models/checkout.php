<?php
require_once("model.php");
class Checkout extends Model
{
   public function coupon($name){
    $sql = "SELECT * FROM coupons WHERE coupon_name = ? AND coupon_count > 0 AND coupon_expiredate >= NOW()";
    return pdo_query_one($sql, $name);
   }

   public function coupon_update($count, $name){
      $sql = "UPDATE coupons SET coupon_count = ? WHERE coupon_name =?";
      return pdo_execute($sql, $count, $name);
   }   

   
}