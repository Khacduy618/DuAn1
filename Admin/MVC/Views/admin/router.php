<?php
 $mod = isset($_GET['mod']) ? $_GET['mod'] : "login";
 $act = isset($_GET['act']) ? $_GET['act'] : "admin";
    switch ($mod) {
        case 'product':
            require_once('MVC/Views/product/list_product.php');   
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
                switch ($act) {
                    case 'list':
                        require_once('MVC/Views/coupon/list.php');
                        break;
                    case 'add':
                        require_once('MVC/Views/coupon/add.php');
                        break;
                    case 'detail':
                        require_once('MVC/Views/coupon/detail.php');
                        break;
                    case 'edit':
                        require_once('MVC/Views/coupon/edit.php');
                        break;
                    case 'delete':
                        require_once('MVC/Views/coupon/delete.php');
                        break;
                    default:
                        require_once('MVC/Views/coupon/list.php');
                        break;
                    }
            
            break;
        case 'user':
            switch ($act) {
                case 'list':
                    require_once('MVC/Views/user/list.php');
                    break;
                case 'add':
                    require_once('MVC/Views/user/add.php');
                    break;
                case 'listAddress':
                    require_once('MVC/Views/user/listAddress.php');
                    break;
                case 'updateStatus':
                    $controller_obj->updateStatus(); 
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
            require_once('MVC/controllers/AdminCuongController.php');
            $controller_obj = new AdminCuongController();
            switch ($act) {
                case 'list':
                    require_once('MVC/Views/blog/list.php');
                    break;
                case 'comments':
                    require_once('MVC/Views/blog/comment.php');
                    break;
                case 'add':
                    require_once('MVC/Views/blog/add.php');
                    break;
                case 'edit':
                    require_once('MVC/Views/blog/edit.php');
                    break;
                case 'soft_delete':
                    require_once('MVC/Views/blog/soft_delete.php');
                    break;
                case 'recycle':
                    require_once('MVC/Views/blog/recycle_bin.php');
                    break;
                case 'back_up':
                    break;
                default:
                    require_once('MVC/Views/blog/list.php');
                    break;
            }
            break;
        case 'comment':
            switch ($act) {
            case 'list':
                require_once('MVC/Views/comment/list.php');
                break;
            case 'add':
                require_once('MVC/Views/comment/add.php');
                break;
            case 'recycle':
                require_once('MVC/Views/comment/recycle_bin.php');
                break;
            default:
                require_once('MVC/Views/comment/list.php');
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
                    require_once('MVC/Views/bills/list.php');
                    break;
                case 'detail':
                    require_once('MVC/Views/bills/details.php');
                    break;
                case 'archived':
                    require_once('MVC/Views/bills/archived.php');
                    break;
                default:
                    require_once('MVC/Views/bills/list.php');
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
        case 'authorization':
            switch ($act) {
                case 'authorization_index':
                require_once('MVC/Views/authorization/index.php');
                break;
                case 'authorize':
                require_once('MVC/Views/authorization/authorize.php');
                break;
            }
            break;
        }
 ?>