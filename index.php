<?php

require_once 'config.php';
spl_autoload_register(function($class){
    include_once('libs/'.$class.'.php');
}
);

$mod = isset($_GET['act']) ? $_GET['act'] : "home";
switch ($mod) {
    case 'home':
        require_once 'Controllers/HomeController.php';
        $controller_obj = new HomeController();
        $controller_obj->list();
        break;
    case 'login':
        require_once 'Controllers/Login.php';
        $controller_obj = new Login();
        $controller_obj->list();
        break;
    case 'controller':
        spl_autoload_register(function($class){
            include_once('Controllers/'.$class.'.php');
        }
        );
        $controller_obj = new $mod[0];
        $controller_obj->$mod[1]();
        break;
     case 'shop':
        require_once('Controllers/ShopController.php');
        $controller_obj = new ShopController();
        $controller_obj->list();
        break;
    default:
        require_once('Controllers/HomeController.php');
        $controller_obj = new Homecontroller();
        $controller_obj->list();
        break;
}