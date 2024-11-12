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
        require_once("blog/blog.php");
        break;
    default:
        require_once("error-404.php");
        break;
}