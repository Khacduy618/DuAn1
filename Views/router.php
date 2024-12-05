<?php
$act = isset($_GET['act']) ? $_GET['act'] : "home";
switch ($act) {
    case "taikhoan":
        $act = isset($_GET['xuli']) ? $_GET['xuli'] : "login";
        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
            switch ($act) {
                case 'login':
                    require_once("login/login.php");
                    break;
                case 'account':
                    require_once("login/account.php");
                    break;
                default:
                    require_once("login/login.php");
                    break;
            }
        } else {
                switch ($act) {
                    case 'login':
                        require_once("login/login.php");
                        break;
                    default:
                        require_once("login/login.php");
                        break;
                }
            }
        break;
    case "home":
        require_once "home/home.php";
        break;
    case "shop":
        require_once("shop/shop.php");
        break;
    case "checkout":
        $act = isset($_GET['xuli']) ? $_GET['xuli'] : "list";
        switch ($act) {
            case 'list':
                require_once("checkout/checkout.php");
                break;
            case 'checkout_complete':
                require_once("checkout/checkout_complete.php");
                break;
            default:
                require_once("checkout/checkout.php");
                break;
        }
        break;
    case "product":
        require_once("product/product.php");
        break;
    case "product-review":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once("Controllers/ReviewControllers.php");
            $controller = new ReviewController();
            $controller->submitReview();
            // Sau khi xử lý xong, redirect về trang product
            $product_id = isset($_POST['id']) ? (int)$_POST['id'] : null;
            header("Location: index.php?act=product&id=" . $product_id);
            exit();
        } else {
            header("Location: index.php");
            exit();
        }
        break;
    case 'get-reviews':
        $reviewController = new ReviewController();
        $reviewController->getReviews();
        break;
    case "about":
        require_once("introduce/about.php");
        break;
    case "contact":
        require_once("introduce/contact.php");
        break;
    case "cart":
        require_once("cart/cart.php");
        break;
    case "blog": 
        require_once "blog/blog.php";
        break;
    case "blog_detail":
        require_once "blog/blog_detail.php";
        break;
    default:
        require_once("error-404.php");
        break;
}