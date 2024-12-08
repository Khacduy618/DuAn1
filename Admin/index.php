<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();
define("BASE_URL","http://localhost/DuAn1/"); 
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
if($mod == 'login'){
     require_once('MVC/controllers/LoginController.php');
     $controller_obj = new LoginController();
     $controller_obj->admin();
 }
 // Kiểm tra session login trước khi xử lý các mod khác
 else if(!isset($_SESSION['login'])) {
     header('Location: ?mod=login');
     exit();
 }
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
 //COMMENT
 else if(isset($_SESSION['privilege']['comment']) && $mod == 'comment' ){
      require_once('MVC/controllers/AdminCuongController.php');
     $controller_obj = new Comment();
      if(isset($_SESSION['privilege']['comment'][$act]) && $act == 'list' ){
          $controller_obj->comment_index();
     }
     else if(isset($_SESSION['privilege']['comment'][$act]) && $act == 'soft_delete' ){
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
           $controller_obj->comment_index();
     }
 }
///PRODUCT
else if(isset($_SESSION['privilege']['product']) && $mod == 'product' ){
     require_once('MVC/controllers/ProductController.php');
     $controller_obj = new ProductController();
     if(isset($_SESSION['privilege']['product'][$act]) && $act == 'list'){
          $controller_obj->list();
     }
     elseif (isset($_SESSION['privilege']['product'][$act]) && $act == 'add'){
          $controller_obj->add();
     }
     elseif (isset($_SESSION['privilege']['product']['add']) && $act == 'store'){
          $controller_obj->store();
     }
     elseif (isset($_SESSION['privilege']['product'][$act]) && $act == 'delete'){
          $controller_obj->delete();
     }
     elseif (isset($_SESSION['privilege']['product'][$act]) && $act == 'details'){
          $controller_obj->details();
     }
     elseif (isset($_SESSION['privilege']['product'][$act]) && $act == 'edit'){
          $controller_obj->edit();
     }
     elseif (isset($_SESSION['privilege']['product']['edit']) && $act == 'update'){
          $controller_obj->update();
     }
     else{
          $controller_obj->list();
     }
}
///CATEGORY 
else if(isset($_SESSION['privilege']['category']) && $mod == 'category' ){
     require_once('MVC/controllers/CategoryController.php');
     $controller_obj = new CategoryController();
     if(isset($_SESSION['privilege']['category'][$act]) && $act == 'list'){
          $controller_obj->list();
     }
     elseif (isset($_SESSION['privilege']['category'][$act]) && $act == 'add'){
          $controller_obj->add();
     }
     elseif (isset($_SESSION['privilege']['category']['add']) && $act == 'store'){
          $controller_obj->store();
     }
     elseif (isset($_SESSION['privilege']['category'][$act]) && $act == 'delete'){
          $controller_obj->delete();
     }
     elseif (isset($_SESSION['privilege']['category'][$act]) && $act == 'edit'){
          $controller_obj->edit();
     }
     elseif (isset($_SESSION['privilege']['category']['edit']) && $act == 'update'){
          $controller_obj->update();
     }
     else{
          $controller_obj->list();
     }
}

elseif (isset($_SESSION['privilege']['coupon']) && $mod == 'coupon' ){
     require_once('MVC/controllers/coupon.php');
     $controller_obj = new CouponController();
     if(isset($_SESSION['privilege']['coupon'][$act]) && $act == 'list'){
          $controller_obj->list();
     }
     elseif (isset($_SESSION['privilege']['coupon'][$act]) && $act == 'add'){
          $controller_obj->add();
     }
     elseif (isset($_SESSION['privilege']['coupon']['add']) && $act == 'store'){
          $controller_obj->store();
     }
     elseif (isset($_SESSION['privilege']['coupon'][$act]) && $act == 'edit'){
          $controller_obj->edit();
     }
     elseif (isset($_SESSION['privilege']['coupon']['edit']) && $act == 'update'){
          $controller_obj->update();
     }
     elseif (isset($_SESSION['privilege']['coupon'][$act]) && $act == 'delete'){
          $controller_obj->delete();
     }
     else{
          $controller_obj->list();
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
     else if(isset($_SESSION['privilege']['user']['add']) && $act == 'store'){
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
     else if(isset($_SESSION['privilege']['user']['edit']) && $act == 'update'){
         $controller_obj->update();
     }
     else{
         $controller_obj->list();
     }
 }
 
 else if(isset($_SESSION['privilege']['address']) && $mod == 'address' ){
     require_once('MVC/controllers/AdminVyController.php');
     $controller_obj = new AdminVyController(); 
     if(isset($_SESSION['privilege']['address'][$act]) && $act == 'list'){
         $controller_obj->userAddress();
     }
     else if(isset($_SESSION['privilege']['address'][$act]) && $act == 'add'){
         $controller_obj->addAddress();
     }
     else if(isset($_SESSION['privilege']['address']['add']) && $act == 'store'){
         $controller_obj->storeAddress();
     }
     else if(isset($_SESSION['privilege']['address'][$act]) && $act == 'updateStatus'){
         $controller_obj->updateStatus();
     }
     else{
         $controller_obj->userAddress();
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
    else{
         $controller_obj->authorization_index();
    }
}
else{
     header('Location: ?mod=login');
     exit();
}

if($mod == 'bill' && $act == 'api' ){
     $controller_obj->edit_bill_status_ajax();
}