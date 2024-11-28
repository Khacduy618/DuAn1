<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();
define("BASE_URL","http://localhost:8080/DuAn1/"); 
require_once 'MVC/Models/Privilege.php';


//check quyen
$select_act = new Privilege_act();
$user_email = $_SESSION['login']['user_email'];
if(isset($_SESSION['privilege']))unset($_SESSION['privilege']) ;
$list_privilege = $select_act->getPrivilegeAct($user_email);

foreach($list_privilege as $privilege){
     $_SESSION['privilege'][$privilege['name']][$privilege['privilege_act']] = 1 ; 
}

$mod = isset($_GET['mod']) ? $_GET['mod'] : "login";
$act = isset($_GET['act']) ? $_GET['act'] : "admin";

//1 mod cua switch, 1 act cuar switch con


if(isset($_SESSION['privilege']['blog']) && $mod == 'blog' ){
    require_once('MVC/controllers/AdminCuongController.php');
    $controller_obj = new AdminCuongController();
    if(isset($_SESSION['privilege']['blog'][$act]) && $act == 'edit' ){
         $controller_obj->edit();
    }
    else if(isset($_SESSION['privilege']['blog'][$act]) && $act == 'add' ){
         $controller_obj->add();
    }
    else if(isset($_SESSION['privilege']['blog'][$act]) && $act == 'soft_delete' ){
         $controller_obj->soft_delete();
    }
    else if(isset($_SESSION['privilege']['blog']['soft_delete']) && $act == 'recycle' ){
         $controller_obj->recycle_bin();
    }
    else if(isset($_SESSION['privilege']['blog']['soft_delete']) && $act == 'force_delete' ){
         $controller_obj->force_delete();
    }
    else if(isset($_SESSION['privilege']['blog']['soft_delete']) && $act == 'back_up' ){
         $controller_obj->back_up();
    }
    else{
          $controller_obj->list();
    }
}
///PRODUCT
// Trong AdminLongController
// các method product : list_product add_product insert_product delete_product edit_product update_product 
// các method category: list_category add_category insert_category delete_category edit_category update_category
// các method api: insert_product_ajax get_categories_product_ajax edit_product_ajax upload_file_ajax insert_product_ajax 
// get_categories_product_ajax edit_product_ajax upload_file_ajax upload_file_ajax_edit delete_product_ajax get_product_ajax
else if(isset($_SESSION['privilege']['product']) && $mod == 'product' ){
     spl_autoload_register(function($class){
          include_once('../libs/'.$class.'.php');
     });
     require_once('MVC/controllers/AdminLongController.php');
    $controller_obj = new AdminLongController();
    if(isset($_SESSION['privilege']['product'][$act])){
          $controller_obj->$action();  
    }else{
          $controller_obj->list_product(true);
    }

}

///CATEGORY 
else if(isset($_SESSION['privilege']['category']) && $mod == 'category' ){
     spl_autoload_register(function($class){
          include_once('../libs/'.$class.'.php');
     });
    require_once('MVC/controllers/AdminLongController.php');
    $controller_obj = new AdminLongController();
     if(isset($_SESSION['privilege']['category'][$act]) && $act == 'add_category' ){
         $controller_obj->add_category();
    }
    else if(isset($_SESSION['privilege']['category'][$act]) && $act == 'insert_category' ){
         $controller_obj->insert_category();
    }
    else if(isset($_SESSION['privilege']['category'][$act]) && $act == 'delete_category' ){
          $param = $_GET['param'];
         $controller_obj->delete_category($param);
    }
    else if(isset($_SESSION['privilege']['category'][$act]) && $act == 'edit_category' ){
          $param = $_GET['param'];
         $controller_obj->edit_category($param);
    }
    else if(isset($_SESSION['privilege']['category'][$act]) && $act == 'update_category' ){
          $param = $_GET['param'];
         $controller_obj->update_category($param);
    }
    else{
          $controller_obj->list_category();
    }
}

///BILL
else if(isset($_SESSION['privilege']['bill']) && $mod == 'bill' ){
    require_once('MVC/controllers/BillController.php');
    $controller_obj = new BillController();
      if(isset($_SESSION['privilege']['bill'][$act]) && $act == 'archived' ){
         $controller_obj->archivedBills();
    }
    else if(isset($_SESSION['privilege']['bill'][$act]) && $act == 'detail' ){
         $controller_obj->detail();
    }
    else if(isset($_SESSION['privilege']['bill'][$act]) && $act == 'status' ){
         $controller_obj->status();
    }
    else{
          $controller_obj->listBills();
    }
}
///REVIEW
else if(isset($_SESSION['privilege']['review']) && $mod == 'review' ){
    require_once('MVC/controllers/ReviewController.php');
    $controller_obj = new ReviewController();
    if(isset($_SESSION['privilege']['review'][$act]) && $act == 'detail' ){
         $controller_obj->detail();
    }
    else if(isset($_SESSION['privilege']['review'][$act]) && $act == 'delete' ){
         $controller_obj->delete();
    }
    else{
          $controller_obj->list();
    }
}
///USER
else if(isset($_SESSION['privilege']['user']) && $mod == 'user' ){
    require_once('MVC/controllers/AdminVyController.php');
    $controller_obj = new AdminVyController();
    if(isset($_SESSION['privilege']['user'][$act]) && $act == 'list'){
        $controller_obj->list();
    }
    else if(isset($_SESSION['privilege']['user'][$act]) && $act == 'add'){
        $controller_obj->add();
    }
    else if(isset($_SESSION['privilege']['user'][$act]) && $act == 'store'){
        $controller_obj->store();
    }
    else if(isset($_SESSION['privilege']['user'][$act]) && $act == 'detail'){
        $controller_obj->detail();
    }
    else if(isset($_SESSION['privilege']['user'][$act]) && $act == 'delete'){
        $controller_obj->delete();
    }
    else if(isset($_SESSION['privilege']['user'][$act]) && $act == 'edit'){
        $controller_obj->edit();
    }
    else if(isset($_SESSION['privilege']['user'][$act]) && $act == 'update'){
        $controller_obj->update();
    }
    else if(isset($_SESSION['privilege']['user'][$act]) && $act == 'listAddress'){
        $controller_obj->userAddress();
    }
    else if(isset($_SESSION['privilege']['user'][$act]) && $act == 'updateAddress'){
        $controller_obj->updateAddress();
    }
    else if(isset($_SESSION['privilege']['user'][$act]) && $act == 'updateStatus'){
        $controller_obj->updateStatus();
    }
    else{
        $controller_obj->list();
    }
}


//authorization
else if($_SESSION['login']['user_role'] == 1 || $mod=='authorization'){
    require_once('MVC/controllers/Authorization.php');
    $controller_obj = new Authorization_members();
    if($act == 'authorization_index'){
        $controller_obj->authorization_index();
    }
    else if($act=='authorize'){
        $controller_obj->authorize();
    }
    else if($act == 'save'){
         $controller_obj->save(); 
    }
}

else{
     echo "404 not found" ;
}
if($mod =='login'){
     require_once('MVC/controllers/LoginController.php');
     $controller_obj = new LoginController();
     $controller_obj->admin();
}

if($mod == 'bill' && $act == 'api' ){
     $controller_obj->edit_bill_status_ajax();
}

// if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) {
//     $mod = isset($_GET['mod']) ? $_GET['mod'] : "login";
//     $act = isset($_GET['act']) ? $_GET['act'] : "admin";
//     switch ($mod) {
//         case 'product':
//                 spl_autoload_register(function($class){
//                     include_once __DIR__.'/../libs/'.$class.'.php';
//                 });
//                 if ( isset($_GET['act']) && isset($_GET['param']) ){
//                     require_once __DIR__.'/MVC/controllers/'.'AdminLongController'.'.php';
//                     $controller_obj = new AdminLongController();
//                     $action = $_GET['act'];
//                     $param = $_GET['param'];
//                     $controller_obj->$action($param);
//                 }
//                 else{
//                     require_once __DIR__.'/MVC/controllers/'.'AdminLongController'.'.php';
//                     $controller_obj = new AdminLongController();
//                     // $action = $_GET['act'];
//                     $action = 'list_product';
//                     $controller_obj->$action();
//                 }
//                 break;
//         case 'category':
//             spl_autoload_register(function($class){
//                 include_once __DIR__.'/../libs/'.$class.'.php';
//             });
//             if ( isset($_GET['act']) && isset($_GET['param']) ){
//                 require_once __DIR__.'/MVC/controllers/'.'AdminLongController'.'.php';
//                 $controller_obj = new AdminLongController();
//                 $action = $_GET['act'];
//                 $param = $_GET['param'];
//                 $controller_obj->$action($param);
//             }
//             else{
//                 require_once __DIR__.'/MVC/controllers/'.'AdminLongController'.'.php';
//                 $controller_obj = new AdminLongController();
//                 // $action = $_GET['act'];
//                 $action = 'list_category';
//                 $controller_obj->$action();
//             }
//             break;
//         case 'review':
//             require_once('MVC/controllers/ReviewController.php');
//             $controller_obj = new ReviewController();
//             switch ($act) {
//                 case 'list':
//                     $controller_obj->list();
//                     break;
//                 case 'detail':
//                     $controller_obj->detail();
//                     break;
//                 case 'delete':
//                     $controller_obj->delete();
//                     break;
//                 default:
//                     $controller_obj->list();
//                     break;
//             }
//             break;
//          case 'coupon':
//                 require_once('MVC/controllers/coupon.php');
//                 $controller_obj = new CouponController();
//                 switch ($act) {
//                     case 'list':
//                         $controller_obj->list();
//                         break;
//                     case 'detail':
//                         $controller_obj->detail();
//                         break;
//                     case 'add':
//                         $controller_obj->add();
//                         break;
//                     case 'store':
//                         $controller_obj->store();
//                         break;
//                     case 'edit':
//                         $controller_obj->edit();
//                         break;
//                     case 'update':
//                         $controller_obj->update();
//                         break;
//                     case 'delete':
//                         $controller_obj->delete();
//                         break;
//                     default:
//                         $controller_obj->list();
//                         break;
//                 }
//                 break;
//             case 'user':
//                 require_once('MVC/controllers/AdminVyController.php');
//                 $controller_obj = new AdminVyController();
//                 switch ($act) {
//                     case 'list':
//                         $controller_obj->list();
//                         break;
//                     case 'add':
//                         $controller_obj->add();
//                         break;
//                     case 'store':
//                         $controller_obj->store();
//                         break;
//                     case 'detail':
//                         $controller_obj->detail();
//                         break; // Sửa từ `store` thành `detail`
//                     case 'delete':
//                         $controller_obj->delete();
//                         break;
//                     case 'edit':
//                         $controller_obj->edit();
//                         break;
//                     case 'update':
//                         $controller_obj->update();
//                         break;
//                     case 'listAddress':
//                         $controller_obj->userAddress(); 
//                         break;
//                     case 'updateAddress':
//                         $controller_obj->updateAddress(); 
//                         break;
//                     default:
//                         $controller_obj->list();
//                         break;
//                 }
//                 break;
//             case 'blog':
//                 require_once('MVC/controllers/AdminCuongController.php');
//                 $controller_obj = new AdminCuongController();
//                 switch ($act){
//                     case 'list':
//                         $controller_obj->list();
//                         break;
//                     case 'detail':
//                         $controller_obj->detail();
//                         break;
//                     case 'add':
//                         $controller_obj->add();
//                         break;
//                     case 'edit':
//                         $controller_obj->edit();
//                         break;
//                     case 'soft_delete':
//                         $controller_obj->soft_delete();
//                         break;
//                     case 'recycle':
//                         $controller_obj->recycle_bin();
//                         break;
//                     case 'back_up':
//                         $controller_obj->back_up();
//                         break;
//                     case  'force_delete':
//                         $controller_obj->force_delete();
//                         break;
//                     default:
//                         $controller_obj->list();
//                         break;
//                 }
//                 break;
//             case 'comment':
//                 require_once('MVC/controllers/AdminCuongController.php');
//                 $controller_obj = new Comment();
//                  switch ($act){
//                     case 'list':
//                         $controller_obj->comment_index();
//                         break;
//                     case 'soft_delete':
//                         $controller_obj->soft_delete();
//                         break;
//                     case 'recycle':
//                         $controller_obj->recycle_bin();
//                         break;
//                     case 'back_up':
//                         $controller_obj->back_up();
//                         break;
//                     case 'force_delete':
//                         $controller_obj->force_delete();
//                         break;
//                     default:
//                         $controller_obj->list();
//                         break;
//                 }
//             break;
//          case 'bills':
//              require_once('MVC/controllers/BillController.php');
//              $controller_obj = new BillController();
//              switch ($act) {
//                  case 'list':
//                      $controller_obj->listBills();
//                      break;
//                  case 'api':
//                      $controller_obj->edit_bill_status_ajax();
//                      break;
//                  case 'detail':
//                      $controller_obj->detail();
//                      break;
//                  case 'archived':
//                      $controller_obj->archivedBills();
//                      break;
//                  case 'status':
//                      $controller_obj->status();
//                      break;
//                  default:
//                      $controller_obj->listBills();
//                      break;
//              }
//              break;

//             case 'login':
//                 require_once('MVC/controllers/LoginController.php');
//                 $controller_obj = new LoginController();
//                 switch ($act) {
//                     case 'admin':
//                         $controller_obj->admin();
//                         break;
//                     default:
//                         $controller_obj->admin();
//                         break;
//                 }
//                 break;
//         default:
//             header('location: ?mod=login');
//             // require_once('MVC/controllers/LoginController.php');
//             // $controller_obj = new LoginController();
//             // $controller_obj->admin();
//             // break;
//     }
// } else {
//     if (isset($_SESSION['isLogin_Nhanvien']) && $_SESSION['isLogin_Nhanvien'] == true) {
//         $mod = isset($_GET['mod']) ? $_GET['mod'] : "login";
//         $act = isset($_GET['act']) ? $_GET['act'] : "admin";
//         switch ($mod) {
//             case 'blog':
//                 require_once('MVC/controllers/AdminCuongController.php');
//                 $controller_obj = new AdminCuongController();
//                 switch ($act){
//                     case 'list':
//                         $controller_obj->list();
//                         break;
//                     case 'detail':
//                         $controller_obj->detail();
//                         break;
//                     case 'add':
//                         $controller_obj->add();
//                         break;
//                     case 'edit':
//                         $controller_obj->edit();
//                         break;
//                     case 'soft_delete':
//                         $controller_obj->soft_delete();
//                         break;
//                     case 'recycle':
//                         $controller_obj->recycle_bin();
//                         break;
//                     case 'back_up':
//                         $controller_obj->back_up();
//                         break;
//                     case  'force_delete':
//                         $controller_obj->force_delete();
//                         break;
//                     default:
//                         $controller_obj->list();
//                         break;
//                 }
//                 break;
//             case 'comment':
//                 require_once('MVC/controllers/AdminCuongController.php');
//                 $controller_obj = new Comment();
//                  switch ($act){
//                     case 'list':
//                         $controller_obj->comment_index();
//                         break;
//                     case 'soft_delete':
//                         $controller_obj->soft_delete();
//                         break;
//                     case 'recycle':
//                         $controller_obj->recycle_bin();
//                         break;
//                     case 'back_up':
//                         $controller_obj->back_up();
//                         break;
//                     case 'force_delete':
//                         $controller_obj->force_delete();
//                         break;
//                     default:
//                         $controller_obj->list();
//                         break;
//                 }
//             break;
//            case 'product':
//                 spl_autoload_register(function($class){
//                     include_once __DIR__.'/../libs/'.$class.'.php';
//                 });
//                 if ( isset($_GET['act']) && isset($_GET['param']) ){
//                     require_once __DIR__.'/MVC/controllers/'.'AdminLongController'.'.php';
//                     $controller_obj = new AdminLongController();
//                     $action = $_GET['act'];
//                     $param = $_GET['param'];
//                     $controller_obj->$action($param);
//                 }
//                 else{
//                     require_once __DIR__.'/MVC/controllers/'.'AdminLongController'.'.php';
//                     $controller_obj = new AdminLongController();
//                     // $action = $_GET['act'];
//                     $action = 'list_product';
//                     $controller_obj->$action();
//                 }
//                 break;
//             case 'category':
//                 spl_autoload_register(function($class){
//                     include_once __DIR__.'/../libs/'.$class.'.php';
//                 });
//                 if ( isset($_GET['act']) && isset($_GET['param']) ){
//                     require_once __DIR__.'/MVC/controllers/'.'AdminLongController'.'.php';
//                     $controller_obj = new AdminLongController();
//                     $action = $_GET['act'];
//                     $param = $_GET['param'];
//                     $controller_obj->$action($param);
//                 }
//                 else{
//                     require_once __DIR__.'/MVC/controllers/'.'AdminLongController'.'.php';
//                     $controller_obj = new AdminLongController();
//                     // $action = $_GET['act'];
//                     $action = 'list_category';
//                     $controller_obj->$action();
//                 }
//                 break;
//                 case 'login':
//                     require_once('MVC/controllers/LoginController.php');
//                     $controller_obj = new LoginController();
//                     switch ($act) {
//                         case 'admin':
//                             $controller_obj->admin();
//                             break;
//                         default:
//                             $controller_obj->admin();
//                             break;
//                     }
//                     break;
//                 case 'user':
//                     require_once('MVC/controllers/AdminVyController.php');
//                     $controller_obj = new AdminVyController();
//                     switch ($act) {
//                         case 'list':
//                             $controller_obj->list();
//                             break;
//                         case 'add':
//                             $controller_obj->add();
//                             break;
//                         case 'store':
//                             $controller_obj->store();
//                             break;
//                         case 'detail':
//                             $controller_obj->detail();
//                             break; // Sửa từ `store` thành `detail`
//                         case 'delete':
//                             $controller_obj->delete();
//                             break;
//                         case 'edit':
//                             $controller_obj->edit();
//                             break;
//                         case 'update':
//                             $controller_obj->update();
//                             break;
//                         case 'listAddress':
//                             $controller_obj->userAddress(); 
//                             break;
//                         case 'updateAddress':
//                             $controller_obj->updateAddress(); 
//                             break;
//                         default:
//                             $controller_obj->list();
//                             break;
//                     }
//                     break;
//                 case 'coupon':
//                 require_once('MVC/controllers/coupon.php');
//                 $controller_obj = new AdminCouponController();
//                 switch ($act) {
//                     case 'list':
//                         $controller_obj->list();
//                         break;
//                     case 'detail':
//                         $controller_obj->detail();
//                         break;
//                     case 'add':
//                         $controller_obj->add();
//                         break;
//                     case 'store':
//                         $controller_obj->store();
//                         break;
//                     case 'edit':
//                         $controller_obj->edit();
//                         break;
//                     case 'update':
//                         $controller_obj->update();
//                         break;
//                     case 'delete':
//                         $controller_obj->delete();
//                         break;
//                     default:
//                         $controller_obj->list();
//                         break;
//                 }
//                 break;
//             default:
//             header('location: ?mod=login');
//                 // require_once('MVC/controllers/LoginController.php');
//                 // $controller_obj = new LoginController();
//                 // $controller_obj->admin();
//                 // break;
//         }
//     } else {
//         // $mod = isset($_GET['mod']) ? $_GET['mod'] : "login";
//         // $act = isset($_GET['act']) ? $_GET['act'] : "login";
//         // require_once('MVC/controllers/LoginController.php');
//         // $controller_obj = new LoginController();
//         // switch ($mod) {
//         //     case 'login':
//         //         switch ($act) {
//         //             case 'login':
//         //                 $controller_obj->login();
//         //                 break;
//         //             case 'login_action':
//         //                 $controller_obj->login_action();
//         //                 break;
//         //             default:
//         //                 $controller_obj->login();
//         //                 break;
//         //         }
//         //     default:
//         //         $controller_obj->login();
//         //         break;
//         // }
//         header('location: ../?act=taikhoan');
//     }
// }