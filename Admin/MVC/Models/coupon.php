<?php
require_once '../Models/pdo.php';
class CouponModel {
    public static function getAllCoupons() {
        $sql = "SELECT * FROM coupons ORDER BY coupon_expiredate DESC";
        return pdo_query($sql);
    }

    public static function getCouponById($id) {
        $sql = "SELECT * FROM coupons WHERE coupon_id = ?";
        return pdo_query_one($sql, $id);
    }

    public static function addCoupon($name, $count, $discount, $expireDate) {
        $sql = "INSERT INTO coupons (coupon_name, coupon_count, coupon_discount, coupon_expiredate) 
                VALUES (?, ?, ?, ?)";
        return pdo_execute($sql, $name, $count, $discount, $expireDate);
    }

    public static function updateCoupon($id, $name, $count, $discount, $expireDate) {
        $sql = "UPDATE coupons SET coupon_name = ?, coupon_count = ?, coupon_discount = ?, coupon_expiredate = ? 
                WHERE coupon_id = ?";
        return pdo_execute($sql, $name, $count, $discount, $expireDate, $id);
    }

    public static function deleteCoupon($id) {
        $sql = "DELETE FROM coupons WHERE coupon_id = ?";
        return pdo_execute($sql, $id);
    }
}
