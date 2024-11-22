<?php
if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) {
    $mod = isset($_GET['mod']) ? $_GET['mod'] : "login";
    $act = isset($_GET['act']) ? $_GET['act'] : "admin";
    switch ($mod) {
        case 'product':
            if ( isset($_GET['act']) && isset($_GET['param']) ){
                require_once('MVC/Views/product/'.$act.'.php');
            }
            elseif(isset($_GET['act'])){
                $act = $_GET['act'];
                require_once('MVC/Views/product/'.$act.'.php');
            }else{
                require_once('MVC/Views/product/list_product.php');
            }
        break;
        case 'category':
            if ( isset($_GET['act']) && isset($_GET['param']) ){
                require_once('MVC/Views/category/'.$act.'.php');
            }
            elseif(isset($_GET['act'])){
                $act = $_GET['act'];
                require_once('MVC/Views/category/'.$act.'.php');
            }else{
                require_once('MVC/Views/category/list_category.php');
            }
        break;
        case 'coupon':
            # code...
            break;
        case 'user':
            switch ($act) {
                case 'list':
                    require_once('MVC/Views/user/list.php');
                    break;
                case 'add':
                    require_once('MVC/Views/user/add.php');
                    break;
                case 'detail':
                    require_once('MVC/Views/user/detail.php');
                    break;
                case 'edit':
                    require_once('MVC/Views/user/edit.php');
                    break;
                default:
                    require_once('MVC/Views/user/list.php');
                    break;
            }
            break;
        case 'blog':
            switch ($act) {
                case 'list':
                    require_once('MVC/Views/blog/list.php');
                    break;
                case 'add':
                    require_once('MVC/Views/blog/add.php');
                    break;
                case 'detail':
                    require_once('MVC/Views/blog/detail.php');
                    break;
                case 'edit':
                    require_once('MVC/Views/blog/edit.php');
                    break;
                default:
                    require_once('MVC/Views/blog/list.php');
                    break;
            }
            break;
        case 'review' : 
            switch ($act) {
                case 'list':
                    require_once('MVC/Views/review/list.php');
                    break;
                case 'detail':
                    require_once('MVC/Views/review/detail.php');
                    break;
                default:
                    require_once('MVC/Views/review/list.php');
                    break;
                }
            break;
        
        case 'bill':
            switch ($act) {
                case 'list':
                    require_once('MVC/Views/bill/list.php');
                    break;
                case 'chitiet':
                    require_once('MVC/Views/bill/detail.php');
                    break;
                default:
                    require_once('MVC/Views/bill/list.php');
                    break;
                }
            break;
        
        case 'role':
            switch ($act) {
            case 'list':
                require_once('MVC/Views/role/list.php');
                break;
            case 'add':
                require_once('MVC/Views/role/add.php');
                break;
            case 'detail':
                require_once('MVC/Views/role/detail.php');
                break;
            case 'edit':
                require_once('MVC/Views/role/edit.php');
                break;
            default:
                require_once('MVC/Views/role/list.php');
                break;
            }
            break;
        case 'analytics':
            switch ($act) {
            case 'list':
                require_once('MVC/Views/analytics/list.php');
                break;
            case 'add':
                require_once('MVC/Views/analytics/add.php');
                break;
            case 'detail':
                require_once('MVC/Views/analytics/detail.php');
                break;
            case 'edit':
                require_once('MVC/Views/analytics/edit.php');
                break;
            default:
                require_once('MVC/Views/analytics/list.php');
                break;
            }
            break;
        case 'login':
            switch ($act) {
            case 'admin':
                require_once('MVC/Views/dashboard/admin.php');
                break;
            default:
                require_once('MVC/Views/dashboard/admin.php');
                break;
            }
            break;
       
        }
} else {
    if (isset($_SESSION['isLogin_Nhanvien']) && $_SESSION['isLogin_Nhanvien'] == true) {
    $mod = isset($_GET['mod']) ? $_GET['mod'] : "login";
    $act = isset($_GET['act']) ? $_GET['act'] : "admin";
    switch ($mod) {
         case 'product':
            if ( isset($_GET['act']) && isset($_GET['param']) ){
                require_once('MVC/Views/product/'.$act.'.php');
            }
            elseif(isset($_GET['act'])){
                $act = $_GET['act'];
                require_once('MVC/Views/product/'.$act.'.php');
            }else{
                require_once('MVC/Views/product/list_product.php');
            }
        break;
        case 'category':
            if ( isset($_GET['act']) && isset($_GET['param']) ){
                require_once('MVC/Views/category/'.$act.'.php');
            }
            elseif(isset($_GET['act'])){
                $act = $_GET['act'];
                require_once('MVC/Views/category/'.$act.'.php');
            }else{
                require_once('MVC/Views/category/list_category.php');
            }
        break;
        case 'coupon':
            # code...
            break;
        case 'user':
            switch ($act) {
                case 'list':
                    require_once('MVC/Views/user/list.php');
                    break;
                case 'add':
                    require_once('MVC/Views/user/add.php');
                    break;
                case 'detail':
                    require_once('MVC/Views/user/detail.php');
                    break;
                case 'edit':
                    require_once('MVC/Views/user/edit.php');
                    break;
                default:
                    require_once('MVC/Views/user/list.php');
                    break;
            }
            break;
        case 'blog':
            switch ($act) {
                case 'list':
                    require_once('MVC/Views/blog/list.php');
                    break;
                case 'add':
                    require_once('MVC/Views/blog/add.php');
                    break;
                case 'detail':
                    require_once('MVC/Views/blog/detail.php');
                    break;
                case 'edit':
                    require_once('MVC/Views/blog/edit.php');
                    break;
                default:
                    require_once('MVC/Views/blog/list.php');
                    break;
            }
            break;
        case 'review' : 
            switch ($act) {
                case 'list':
                    require_once('MVC/Views/review/list.php');
                    break;
                case 'detail':
                    require_once('MVC/Views/review/detail.php');
                    break;
                default:
                    require_once('MVC/Views/review/list.php');
                    break;
                }
            break;
        
        case 'bill':
            switch ($act) {
                case 'list':
                    require_once('MVC/Views/bill/list.php');
                    break;
                case 'chitiet':
                    require_once('MVC/Views/bill/detail.php');
                    break;
                default:
                    require_once('MVC/Views/bill/list.php');
                    break;
                }
            break;
        }
    }
}
?>