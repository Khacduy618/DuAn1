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

    default:
        require_once 'Controllers/HomeController.php';
        $controller_obj = new HomeController();
        $controller_obj->list();
        break;
}
