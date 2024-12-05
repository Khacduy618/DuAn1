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
            $userEmail = $_SESSION['login']['user_email'];

            if (isset($_POST['shipping'])) {
                $shipping = $_POST['shipping'];
            } else {
                setcookie('msg1', 'Vui lòng chọn phương thức vận chuyển', time() + 5);
                header('location: ?act=cart');
                return;
            }


            if (isset($_POST['address_id'])) {
                $address_id = $_POST['address_id'];
                $address = $this->addressModel->getOneAddressById($address_id);
            } else {
                setcookie('msg1', 'Vui lòng chọn địa chỉ giao hàng', time() + 5);
                header('location: ?act=cart');
                return;
            }

            if (isset($_POST['coupon_name'])) {
                $name = $_POST['coupon_name'];
                $coupon = $this->checkout_model->coupon($name);
            }

            if (isset($_POST['cart_items'])) {
                $cartItems = $this->cartModel->getCartItems($userEmail);
                $selectedItemIds = $_POST['cart_items'];
                $cartItems = array_filter($cartItems, function($item) use ($selectedItemIds) {
                    return in_array($item['cart_item_id'], $selectedItemIds);
                });
            } else {
                setcookie('msg1', 'Vui lòng chọn ít nhất 1 sản phẩm để thanh toán', time() + 5);
                header('location: ?act=cart');
                return;
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