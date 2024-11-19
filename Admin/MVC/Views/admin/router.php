<?php
if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) {
    $mod = isset($_GET['mod']) ? $_GET['mod'] : "login";
    $act = isset($_GET['act']) ? $_GET['act'] : "admin";
    switch ($mod) {
    case 'khuyenmai':
        switch ($act) {
        case 'list':
            require_once('MVC/views/khuyenmai/list.php');
            break;
        case 'add':
            require_once('MVC/views/khuyenmai/add.php');
            break;
        case 'detail':
            require_once('MVC/views/khuyenmai/detail.php');
            break;
        case 'edit':
            require_once('MVC/views/khuyenmai/edit.php');
            break;
        default:
            require_once('MVC/views/khuyenmai/list.php');
            break;
        }
        break;
    case 'banner':
        switch ($act) {
        case 'list':
            require_once('MVC/views/banner/list.php');
            break;
        case 'add':
            require_once('MVC/views/banner/add.php');
            break;
        case 'detail':
            require_once('MVC/views/banner/detail.php');
            break;
        case 'edit':
            require_once('MVC/views/banner/edit.php');
            break;
        default:
            require_once('MVC/views/banner/list.php');
            break;
        }
        break;
    case 'nguoidung':
        switch ($act) {
        case 'list':
            require_once('MVC/views/nguoidung/list.php');
            break;
        case 'add':
            require_once('MVC/views/nguoidung/add.php');
            break;
        case 'detail':
            require_once('MVC/views/nguoidung/detail.php');
            break;
        case 'edit':
            require_once('MVC/views/nguoidung/edit.php');
            break;
        default:
            require_once('MVC/views/nguoidung/list.php');
            break;
        }
        break;
    case 'sanpham':
        switch ($act) {
        case 'list':
            require_once('MVC/views/sanpham/list.php');
            break;
        case 'add':
            require_once('MVC/views/sanpham/add.php');
            break;
        case 'edit':
            require_once('MVC/views/sanpham/edit.php');
            break;
        default:
            require_once('MVC/views/sanpham/list.php');
            break;
        }
        break;
    case 'loaisanpham':
        switch ($act) {
        case 'list':
            require_once('MVC/views/loaisanpham/list.php');
            break;
        case 'add':
            require_once('MVC/views/loaisanpham/add.php');
            break;
        case 'detail':
            require_once('MVC/views/loaisanpham/detail.php');
            break;
        case 'edit':
            require_once('MVC/views/loaisanpham/edit.php');
            break;
        default:
            require_once('MVC/views/loaisanpham/list.php');
            break;
        }
        break;
    case 'danhmuc':
        switch ($act) {
        case 'list':
            require_once('MVC/views/danhmuc/list.php');
            break;
        case 'add':
            require_once('MVC/views/danhmuc/add.php');
            break;
        case 'detail':
            require_once('MVC/views/danhmuc/detail.php');
            break;
        case 'edit':
            require_once('MVC/views/danhmuc/edit.php');
            break;
        default:
            require_once('MVC/views/danhmuc/list.php');
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
            require_once('MVC/views/loaisanpham/list.php');
            break;
            case 'detail':
            require_once('MVC/views/loaisanpham/detail.php');
            break;
            default:
            require_once('MVC/views/loaisanpham/list.php');
            break;
        }
        break;
        case 'danhmuc':
        switch ($act) {
            case 'list':
            require_once('MVC/views/danhmuc/list.php');
            break;
            case 'detail':
            require_once('MVC/views/danhmuc/detail.php');
            break;
            default:
            require_once('MVC/views/danhmuc/list.php');
            break;
        }
        break;
        case 'sanpham':
        switch ($act) {
            case 'list':
            require_once('MVC/views/sanpham/list.php');
            break;
            case 'detail':
            require_once('MVC/views/sanpham/detail.php');
            break;
            default:
            require_once('MVC/views/sanpham/list.php');
            break;
        }
        break;
        case 'khuyenmai':
        switch ($act) {
            case 'list':
            require_once('MVC/views/khuyenmai/list.php');
            break;
            case 'detail':
            require_once('MVC/views/khuyenmai/detail.php');
            break;
            default:
            require_once('MVC/views/khuyenmai/list.php');
            break;
        }
        break;
    }
    }
}
?>