<?php
session_start();
ob_start();
$mod = isset($_GET['act']) ? $_GET['act'] : "home";
switch ($mod) {
    case 'home':
        require_once 'Controllers/HomeController.php';
        $controller_obj = new HomeController();
        $controller_obj->list();
        break;
     case 'shop':
        require_once('Controllers/ShopController.php');
        $controller_obj = new ShopController();
        $controller_obj->list();
        break;
    case 'product':
        require_once('Controllers/ProductController.php');
        $controller_obj = new ProductController();
        $controller_obj->list();
        break;
    // case 'checkout':
    //     require_once('Controllers/CheckoutController.php');
    //     $controller_obj = new CheckoutController();
    //     $controller_obj->list();
    //     break;
    default:
        require_once('Controllers/HomeController.php');
        $controller_obj = new Homecontroller();
        $controller_obj->list();
        break;
}