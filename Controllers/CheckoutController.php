<?php
require_once("Models/checkout.php");
require_once 'Models/cart.php';
require_once("Models/address.php");
class CheckoutController
{
    private $checkout_model;
    private $cartModel;
    private $addressModel;  
    public function __construct()
    {
        $this->checkout_model = new Checkout();
        $this->cartModel = new Cart();
        $this->addressModel = new Address();
    }
    function list()
    {
      if (isset($_SESSION['login'])) {
            $shipping = $_GET['shipping'];
            $userEmail = $_SESSION['login']['user_email'];
            $address = $this->addressModel->getOneAddress($userEmail);
             if(isset($_POST['coupon_name'])){
                $name = $_POST['coupon_name'];
                $coupon = $this->checkout_model->coupon($name);
            };
            if (isset($_GET['cart_items'])) {
            $cartItems = $this->cartModel->getCartItems($userEmail);
            $selectedItemIds = $_GET['cart_items'];
            $cartItems = array_filter($cartItems, function($item) use ($selectedItemIds) {
                return in_array($item['cart_item_id'], $selectedItemIds);
            });
            }else{
                setcookie('msg1', 'Vui lòng chọn ít nhất 1 sản phẩm để thanh toán', time() + 5);
                header('location: ?act=cart');
            }
            require_once 'Views/index.php';
        } else {
            header('location: ?act=taikhoan');
        }
    }
    function  save()
    {
        if (isset($_SESSION['login'])) {
            $userEmail = $_SESSION['login']['user_email'];
            $name = isset($_GET['coupon_name'])? $_GET['coupon_name'] : '';
        }
        if (isset($coupon)) {
        }
    }
    function order_complete()
    {
       //
        require_once('Views/index.php');
    }
}