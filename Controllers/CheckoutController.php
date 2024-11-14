<?php
require_once 'Models/cart.php';
require_once("Models/address.php");
require_once("Models/checkout.php");
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
            $name = $_GET['coupon_name'];
            $coupon = $this->checkout_model->coupon($name);
            $cartItems = $this->cartModel->getCartItems($userEmail);
            $address = $this->addressModel->getOneAdress($userEmail);
            require_once 'Views/index.php';
        } else {
            header('location: ?act=taikhoan');
        }
    }
    function  save()
    {
       //
    }
    function order_complete()
    {
       //
        require_once('Views/index.php');
    }
}