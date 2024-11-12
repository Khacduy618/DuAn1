<?php
require_once("Models/cart.php");
class CartController
{
      private $cartModel;

    public function __construct()
    {
        $this->cartModel = new Cart();
    }

    public function list_cart()
    {
        if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true) {
           $userEmail = $_SESSION['login']['user_email'];
            $cartItems = $this->cartModel->getCartItems($userEmail);
            require_once 'Views/index.php';
        } else {
            header('location: ?act=taikhoan&xuli=login');
            }
    }

    public function add_cart()
    {
        if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true) {
            // Kiểm tra dữ liệu đầu vào
            if (!isset($_GET['product_id']) || !is_numeric($_GET['product_id']) || !isset($_GET['quantity']) || !is_numeric($_GET['quantity'])) {
                header('location: ?act=cart&xuli=list');
                exit;
            }

            $userEmail = $_SESSION['login']['user_email'];
            $productId = $_GET['product_id'];
            $quantity = $_GET['quantity'];

            // Thêm sản phẩm vào giỏ hàng
            try {
                $this->cartModel->addToCart($userEmail, $productId, $quantity);
                header('location: ?act=cart&xuli=list');
            } catch (Exception $e) {
                // Xử lý lỗi khi thêm vào giỏ hàng
                echo "Lỗi: " . $e->getMessage();
            }
        } else {
            header('location: ?act=taikhoan&xuli=login');
        }
    }


    public function delete_cart()
    {
        if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true) {
            $userEmail = $_SESSION['login']['user_email'];
            $productId = $_GET['product_id'];
            $this->cartModel->removeFromCart($userEmail, $productId);
            header('location: ?act=cart&xuli=list');
        } else {
            header('location: ?act=taikhoan&xuli=login');
        }
    }

    public function deleteall_cart()
    {
        if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true) {
            $userEmail = $_SESSION['login']['user_email'];
            $this->cartModel->clearCart($userEmail);
            header('location: ?act=cart&xuli=list');
        } else {
            header('location: ?act=taikhoan&xuli=login');
        }
    }
}