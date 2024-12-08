<?php
require_once("Models/cart.php");
require_once("Models/address.php");
class CartController
{
        private $cartModel;
        private $addressModel;  

    public function __construct()
    {
        $this->cartModel = new Cart();
        $this->addressModel = new Address();
        
    }

    public function list_cart()
    {
    
           $userEmail = $_SESSION['login']['user_email'];
            $coupon_name = isset($_POST['coupon_name']) ? $_POST['coupon_name'] : '';
            $cartItems = $this->cartModel->getCartItems($userEmail);
            $address = $this->addressModel->getOneAddress($userEmail);
            $addresses = $this->addressModel->getAllAddresses($userEmail);
            $coupon = $this->cartModel->coupon($coupon_name);
            require_once 'Views/index.php';
        
    }

    public function add_cart()
    {
            // Kiểm tra dữ liệu đầu vào
            if (!isset($_GET['product_id']) || !is_numeric($_GET['product_id']) || !isset($_GET['quantity']) || !is_numeric($_GET['quantity'])) {
                header('location: ?act=cart&xuli=list');
                exit;
            }

            $userEmail = $_SESSION['login']['user_email'];
            $productId = $_GET['product_id'];
            $quantity = $_GET['quantity'];
            if($quantity < 1 ){
                header('location:?act=product&xuli=detail&id='. $productId);
                exit;
            }
            // Thêm sản phẩm vào giỏ hàng
            try {
                $this->cartModel->addToCart($userEmail, $productId, $quantity);
                header('location: ?act=cart&xuli=list');
            } catch (Exception $e) {
                // Xử lý lỗi khi thêm vào giỏ hàng
                echo "Lỗi: " . $e->getMessage();
            }
    }

    public function update_cart()
    {
            // Kiểm tra dữ liệu đầu vào
            if (!isset($_POST['product_id']) || !is_numeric($_POST['product_id']) || 
                !isset($_POST['quantity']) || !is_numeric($_POST['quantity'])) {
                header('location: ?act=cart&xuli=list');
                exit;
            }

            $userEmail = $_SESSION['login']['user_email'];
            $productId = $_POST['product_id'];
            $quantity = $_POST['quantity'];

            try {
                $this->cartModel->updateQuantity($userEmail, $productId, $quantity);
                header('location: ?act=cart&xuli=list');
            } catch (Exception $e) {
                // Xử lý lỗi
                echo "Lỗi: " . $e->getMessage();
            }
    }

    public function delete_cart()
    {
            $userEmail = $_SESSION['login']['user_email'];
            $productId = $_GET['product_id'];
            $this->cartModel->removeFromCart($userEmail, $productId);
            header('location: ?act=cart&xuli=list');
        
    }

    public function deleteall_cart()
    {
         
            $userEmail = $_SESSION['login']['user_email'];
            $this->cartModel->clearCart($userEmail);
            header('location: ?act=cart&xuli=list');
        
    }
}