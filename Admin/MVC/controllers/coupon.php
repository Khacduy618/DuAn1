<?php
require_once  'MVC/Models/coupon.php';
class CouponController {
    public function list() {
        $coupons = CouponModel::getAllCoupons();
        require_once  'MVC/Views/admin/index.php';
    }

    public function detail() {
        $id = $_GET['id'];
        $coupon = CouponModel::getCouponById($id);
        require_once  'MVC/Views/admin/index.php';
    }

    public function add() {
      require_once  'MVC/Views/admin/index.php';
    }

    public function store() {
        $name = $_POST['coupon_name'];
        $count = $_POST['coupon_count'];
        $discount = $_POST['coupon_discount'];
        $expireDate = $_POST['coupon_expiredate'];
        CouponModel::addCoupon($name, $count, $discount, $expireDate);
        header('Location: index.php?mod=coupon&act=list');
    }

    public function edit() {
        $id = $_GET['id'];
        $coupon = CouponModel::getCouponById($id);
        require_once  'MVC/Views/admin/index.php';
    }

    public function update() {
        $id = $_POST['coupon_id'];
        $name = $_POST['coupon_name'];
        $count = $_POST['coupon_count'];
        $discount = $_POST['coupon_discount'];
        $expireDate = $_POST['coupon_expiredate'];
        CouponModel::updateCoupon($id, $name, $count, $discount, $expireDate);
        header('Location: index.php?mod=coupon&act=list');
    }

    public function delete() {
        $id = $_GET['id'];
        CouponModel::deleteCoupon($id);
        header('Location: index.php?mod=coupon&act=list');
    }
}