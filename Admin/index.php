<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

define("BASE_URL","http://localhost/DuAn1/"); 

//1 mod cua switch, 1 act cuar switch con
if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) {
    $mod = isset($_GET['mod']) ? $_GET['mod'] : "login";
    $act = isset($_GET['act']) ? $_GET['act'] : "admin";
    switch ($mod) {
        case 'product':
                spl_autoload_register(function($class){
                    include_once __DIR__.'/../libs/'.$class.'.php';
                });
                if ( isset($_GET['act']) && isset($_GET['param']) ){
                    require_once __DIR__.'/MVC/Controllers/'.'AdminLongController'.'.php';
                    $controller_obj = new AdminLongController();
                    $action = $_GET['act'];
                    $param = $_GET['param'];
                    $controller_obj->$action($param);
                }
                else{
                    require_once __DIR__.'/MVC/Controllers/'.'AdminLongController'.'.php';
                    $controller_obj = new AdminLongController();
                    // $action = $_GET['act'];
                    $action = 'list_product';
                    $controller_obj->$action();
                }
                break;
        case 'category':
            spl_autoload_register(function($class){
                include_once __DIR__.'/../libs/'.$class.'.php';
            });
            if ( isset($_GET['act']) && isset($_GET['param']) ){
                require_once __DIR__.'/MVC/Controllers/'.'AdminLongController'.'.php';
                $controller_obj = new AdminLongController();
                $action = $_GET['act'];
                $param = $_GET['param'];
                $controller_obj->$action($param);
            }
            else{
                require_once __DIR__.'/MVC/Controllers/'.'AdminLongController'.'.php';
                $controller_obj = new AdminLongController();
                // $action = $_GET['act'];
                $action = 'list_category';
                $controller_obj->$action();
            }
            break;
        case 'review':
            require_once('MVC/controllers/ReviewController.php');
            $controller_obj = new ReviewController();
            switch ($act) {
                case 'list':
                    $controller_obj->list();
                    break;
                case 'detail':
                    $controller_obj->detail();
                    break;
                case 'delete':
                    $controller_obj->delete();
                    break;
                default:
                    $controller_obj->list();
                    break;
            }
            break;
        
        case 'user':
            require_once('MVC/controllers/AdminVyController.php');
            $controller_obj = new AdminVyController();
            switch ($act) {
                case 'list':
                    $controller_obj->list();
                    break;
                case 'detail':
                    $controller_obj->detail();
                    break;
                case 'add':
                    $controller_obj->add();
                    break;
                case 'store':
                    $controller_obj->store();
                    break;
                case 'delete':
                    $controller_obj->delete();
                    break;
                case 'edit':
                    $controller_obj->edit();
                    break;
                case 'update':
                    $controller_obj->update();
                    break;
                default:
                    $controller_obj->list();
                    break;
            }
            break;
        
        // case 'khuyenmai':
        //     require_once('MVC/controllers/KhuyenmaiController.php');
        //     $controller_obj = new KhuyenmaiController();
        //     switch ($act) {
        //         case 'list':
        //             $controller_obj->list();
        //             break;
        //         case 'detail':
        //             $controller_obj->detail();
        //             break;
        //         case 'add':
        //             $controller_obj->add();
        //             break;
        //         case 'store':
        //             $controller_obj->store();
        //             break;
        //         case 'delete':
        //             $controller_obj->delete();
        //             break;
        //         case 'edit':
        //             $controller_obj->edit();
        //             break;
        //         case 'update':
        //             $controller_obj->update();
        //             break;
        //         default:
        //             $controller_obj->list();
        //             break;
        //     }
        //     break;
        // case 'loaisanpham':
        //     require_once('MVC/controllers/LoaisanphamController.php');
        //     $controller_obj = new LoaisanphamController();
        //     switch ($act) {
        //         case 'list':
        //             $controller_obj->list();
        //             break;
        //         case 'detail':
        //             $controller_obj->detail();
        //             break;
        //         case 'add':
        //             $controller_obj->add();
        //             break;
        //         case 'store':
        //             $controller_obj->store();
        //             break;
        //         case 'delete':
        //             $controller_obj->delete();
        //             break;
        //         case 'edit':
        //             $controller_obj->edit();
        //             break;
        //         case 'update':
        //             $controller_obj->update();
        //             break;
        //         default:
        //             $controller_obj->list();
        //             break;
        //     }
        //     break;
         case 'bills':
             require_once('MVC/controllers/BillController.php');
             $controller_obj = new BillController();
             switch ($act) {
                 case 'list':
                     $controller_obj->listBills();
                     break;
                 case 'detail':
                     $controller_obj->detail();
                     break;
                 case 'archived':
                     $controller_obj->archivedBills();
                     break;
                 case 'delete':
                     $controller_obj->deleteBill();
                     break;
                 case 'deleted':
                     $controller_obj->listDeletedBills();
                     break;
                 case 'status':
                     $controller_obj->status();
                     break;
                 case 'restore_deleted':
                     $controller_obj->restoreBillDeleted();
                     break;
                 case 'restore_archived':
                     $controller_obj->restoreBillArchived();
                     break;
                 default:
                     $controller_obj->listBills();
                     break;
             }
             break;
            case 'login':
                require_once('MVC/controllers/LoginController.php');
                $controller_obj = new LoginController();
                switch ($act) {
                    case 'admin':
                        $controller_obj->admin();
                        break;
                    default:
                        $controller_obj->admin();
                        break;
                }
                break;
        default:
            header('location: ?mod=login');
            // require_once('MVC/controllers/LoginController.php');
            // $controller_obj = new LoginController();
            // $controller_obj->admin();
            // break;
    }
} else {
    if (isset($_SESSION['isLogin_Nhanvien']) && $_SESSION['isLogin_Nhanvien'] == true) {
        $mod = isset($_GET['mod']) ? $_GET['mod'] : "login";
        $act = isset($_GET['act']) ? $_GET['act'] : "admin";
        switch ($mod) {
           case 'product':
                spl_autoload_register(function($class){
                    include_once __DIR__.'/../libs/'.$class.'.php';
                });
                if ( isset($_GET['act']) && isset($_GET['param']) ){
                    require_once __DIR__.'/MVC/Controllers/'.'AdminLongController'.'.php';
                    $controller_obj = new AdminLongController();
                    $action = $_GET['act'];
                    $param = $_GET['param'];
                    $controller_obj->$action($param);
                }
                else{
                    require_once __DIR__.'/MVC/Controllers/'.'AdminLongController'.'.php';
                    $controller_obj = new AdminLongController();
                    // $action = $_GET['act'];
                    $action = 'list_product';
                    $controller_obj->$action();
                }
                break;
            case 'category':
                spl_autoload_register(function($class){
                    include_once __DIR__.'/../libs/'.$class.'.php';
                });
                if ( isset($_GET['act']) && isset($_GET['param']) ){
                    require_once __DIR__.'/MVC/Controllers/'.'AdminLongController'.'.php';
                    $controller_obj = new AdminLongController();
                    $action = $_GET['act'];
                    $param = $_GET['param'];
                    $controller_obj->$action($param);
                }
                else{
                    require_once __DIR__.'/MVC/Controllers/'.'AdminLongController'.'.php';
                    $controller_obj = new AdminLongController();
                    // $action = $_GET['act'];
                    $action = 'list_category';
                    $controller_obj->$action();
                }
                break;
                case 'login':
                    require_once('MVC/controllers/LoginController.php');
                    $controller_obj = new LoginController();
                    switch ($act) {
                        case 'admin':
                            $controller_obj->admin();
                            break;
                        default:
                            $controller_obj->admin();
                            break;
                    }
                    break;
            default:
            header('location: ?mod=login');
                // require_once('MVC/controllers/LoginController.php');
                // $controller_obj = new LoginController();
                // $controller_obj->admin();
                // break;
        }
    } else {
        // $mod = isset($_GET['mod']) ? $_GET['mod'] : "login";
        // $act = isset($_GET['act']) ? $_GET['act'] : "login";
        // require_once('MVC/controllers/LoginController.php');
        // $controller_obj = new LoginController();
        // switch ($mod) {
        //     case 'login':
        //         switch ($act) {
        //             case 'login':
        //                 $controller_obj->login();
        //                 break;
        //             case 'login_action':
        //                 $controller_obj->login_action();
        //                 break;
        //             default:
        //                 $controller_obj->login();
        //                 break;
        //         }
        //     default:
        //         $controller_obj->login();
        //         break;
        // }
        header('location: ../?act=taikhoan');
    }
}