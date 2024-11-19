<?php
if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) {
    $mod = isset($_GET['mod']) ? $_GET['mod'] : "login";
    $act = isset($_GET['act']) ? $_GET['act'] : "admin";
    switch ($mod) {
    case 'khuyenmai':
        switch ($act) {
        case 'list':
            require_once('MVC/Views/khuyenmai/list.php');
            break;
        case 'add':
            require_once('MVC/Views/khuyenmai/add.php');
            break;
        case 'detail':
            require_once('MVC/Views/khuyenmai/detail.php');
            break;
        case 'edit':
            require_once('MVC/Views/khuyenmai/edit.php');
            break;
        default:
            require_once('MVC/Views/khuyenmai/list.php');
            break;
        }
        break;
    case 'banner':
        switch ($act) {
        case 'list':
            require_once('MVC/Views/banner/list.php');
            break;
        case 'add':
            require_once('MVC/Views/banner/add.php');
            break;
        case 'detail':
            require_once('MVC/Views/banner/detail.php');
            break;
        case 'edit':
            require_once('MVC/Views/banner/edit.php');
            break;
        default:
            require_once('MVC/Views/banner/list.php');
            break;
        }
        break;
    case 'nguoidung':
        switch ($act) {
        case 'list':
            require_once('MVC/Views/nguoidung/list.php');
            break;
        case 'add':
            require_once('MVC/Views/nguoidung/add.php');
            break;
        case 'detail':
            require_once('MVC/Views/nguoidung/detail.php');
            break;
        case 'edit':
            require_once('MVC/Views/nguoidung/edit.php');
            break;
        default:
            require_once('MVC/Views/nguoidung/list.php');
            break;
        }
        break;
    case 'product':
        switch ($act) {
        case 'list':
            require_once('MVC/Views/product/list.php');
            break;
        case 'add':
            require_once('MVC/Views/product/add.php');
            break;
        case 'edit':
            require_once('MVC/Views/product/edit.php');
            break;
        default:
            require_once('MVC/Views/product/list.php');
            break;
        }
        break;
    case 'loaisanpham':
        switch ($act) {
        case 'list':
            require_once('MVC/Views/loaisanpham/list.php');
            break;
        case 'add':
            require_once('MVC/Views/loaisanpham/add.php');
            break;
        case 'detail':
            require_once('MVC/Views/loaisanpham/detail.php');
            break;
        case 'edit':
            require_once('MVC/Views/loaisanpham/edit.php');
            break;
        default:
            require_once('MVC/Views/loaisanpham/list.php');
            break;
        }
        break;
    case 'danhmuc':
        switch ($act) {
        case 'list':
            require_once('MVC/Views/danhmuc/list.php');
            break;
        case 'add':
            require_once('MVC/Views/danhmuc/add.php');
            break;
        case 'detail':
            require_once('MVC/Views/danhmuc/detail.php');
            break;
        case 'edit':
            require_once('MVC/Views/danhmuc/edit.php');
            break;
        default:
            require_once('MVC/Views/danhmuc/list.php');
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
    case 'hoadon':
        switch ($act) {
        case 'list':
            require_once('MVC/Views/hoadon/list.php');
            break;
        case 'chitiet':
            require_once('MVC/Views/hoadon/detail.php');
            break;
        default:
            require_once('MVC/Views/hoadon/list.php');
            break;
        }
        break;
    }
} else {
    if (isset($_SESSION['isLogin_Nhanvien']) && $_SESSION['isLogin_Nhanvien'] == true) {
    $mod = isset($_GET['mod']) ? $_GET['mod'] : "login";
    $act = isset($_GET['act']) ? $_GET['act'] : "admin";
    switch ($mod) {
        case 'hoadon':
        switch ($act) {
            case 'list':
            require_once('MVC/Views/hoadon/list.php');
            break;
            case 'chitiet':
            require_once('MVC/Views/hoadon/detail.php');
            break;
            default:
            require_once('MVC/Views/hoadon/list.php');
            break;
        }
        break;
        case 'loaisanpham':
        switch ($act) {
            case 'list':
            require_once('MVC/Views/loaisanpham/list.php');
            break;
            case 'detail':
            require_once('MVC/Views/loaisanpham/detail.php');
            break;
            default:
            require_once('MVC/Views/loaisanpham/list.php');
            break;
        }
        break;
        case 'danhmuc':
        switch ($act) {
            case 'list':
            require_once('MVC/Views/danhmuc/list.php');
            break;
            case 'detail':
            require_once('MVC/Views/danhmuc/detail.php');
            break;
            default:
            require_once('MVC/Views/danhmuc/list.php');
            break;
        }
        break;
        case 'product':
        switch ($act) {
            case 'list':
            require_once('MVC/Views/product/list.php');
            break;
            case 'detail':
            require_once('MVC/Views/product/detail.php');
            break;
            default:
            require_once('MVC/Views/product/list.php');
            break;
        }
        break;
        case 'khuyenmai':
        switch ($act) {
            case 'list':
            require_once('MVC/Views/khuyenmai/list.php');
            break;
            case 'detail':
            require_once('MVC/Views/khuyenmai/detail.php');
            break;
            default:
            require_once('MVC/Views/khuyenmai/list.php');
            break;
        }
        break;
    }
    }
}
?>