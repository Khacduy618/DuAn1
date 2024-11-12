<?php
$act = isset($_GET['act']) ? $_GET['act'] : "home";
switch ($act) {
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
                require_once("order/checkout.php");
                break;
            case 'order_complete':
                require_once("order/order_complete.php");
                break;
            default:
                require_once("order/checkout.php");
                break;
        }
        break;
    case "detail":
        require_once("product-detail/product-detail.php");
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
    case "taikhoan":
        $act = isset($_GET['xuli']) ? $_GET['xuli'] : "login";

        if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true) {
            switch ($act) {
                case 'login':
                    require_once("Views/index.php");
                    break;
                case 'account':
                    require_once("Views/my-account.php");
                    break;
                default:
                    require_once("Views/index.php");
                    break;
            }
        } else {
            switch ($act) {
                case 'login':
                    require_once("Views/index.php");
                    break;
                case 'dangky':
                    require_once("Views/index.php");
                    break;
                default:
                    require_once("Views/index.php");
                    break;
            }
        }
        break;
}
