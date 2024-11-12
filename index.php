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

    case 'register':
        require_once 'Controllers/AccountController.php';
        $controller_obj = new AccountController();
        $controller_obj->register();
        break;

    case 'login':
        require_once 'Controllers/AccountController.php';
        $controller_obj = new AccountController();
        $controller_obj->login();
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
    case 'cart':
        $act = isset($_GET['xuli']) ? $_GET['xuli'] : "list";
        require_once('Controllers/CartController.php');
        $controller_obj = new CartController();
        switch ($act) {
            case 'list':
                $controller_obj->list_cart();
                break;
            case 'update':
                $controller_obj->update_cart();
                break;
            case 'add':
                $controller_obj->add_cart();
                break;
            case 'delete':
                $controller_obj->delete_cart();
                break;
            case 'deleteall':
                $controller_obj->deleteall_cart();
                break;
            default:
                $controller_obj->list_cart();
                break;
        }
        break;
    default:
        require_once 'Controllers/HomeController.php';
        $controller_obj = new HomeController();
        $controller_obj->list();
        break;
}