<?php
$mod = isset($_GET['act']) ? $_GET['act'] : "home";
switch ($mod) {
    case "forgot_password":
        $xuli = isset($_GET['xuli']) ? $_GET['xuli'] : "reset_pass";
        switch ($xuli) {
            case "reset_pass":
                require_once "forgot_password/reset_pass.php";
                break;
            case "reset_form":
                require_once "forgot_password/reset_form.php";
                break;
            default:
                require_once "forgot_password/reset_pass.php";
                break;
        }
        break;
    case "blog": 
        require_once "Views/blog/blog.php";
        break;
    case "blog_detail":
        require_once "blog/blog_detail.php";
        break;
    case "taikhoan":
        $act = isset($_GET['xuli']) ? $_GET['xuli'] : "login";
        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
            switch ($act) {
                case 'login':
                    require_once("login/login.php");
                    break;
                case 'account':
                    require_once("login/account.php");
                    break;
                default:
                    require_once("login/login.php");
                    break;
            }
        } else {
                switch ($act) {
                    case 'login':
                        require_once("login/login.php");
                        break;
                    default:
                        require_once("login/login.php");
                        break;
                }
            }
        break;
    case "home":
        require_once "home/home.php";
        break;
    case "shop":
        require_once("shop/shop.php");
        break;
    case "checkout":
        $act = isset($_GET['xuli']) ? $_GET['xuli'] : "list";
        switch ($act) {
            case 'list':
                require_once("checkout/checkout.php");
                break;
            case 'checkout_complete':
                require_once("checkout/checkout_complete.php");
                break;
            case 'order_history':
                require_once("checkout/order_history.php");
                break;
            default:
                require_once("checkout/checkout.php");
                break;
        }
        break;
    case "product":
        require_once("product/product.php");
        break;
    case "product-review":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once("Controllers/ReviewControllers.php");
            $controller = new ReviewController();
            $controller->submitReview();
            // Sau khi xử lý xong, redirect về trang product
            $product_id = isset($_POST['id']) ? (int)$_POST['id'] : null;
            header("Location: index.php?act=product&id=" . $product_id);
            exit();
        } else {
            header("Location: index.php");
            exit();
        }
        break;
    case 'get-reviews':
        $reviewController = new ReviewController();
        $reviewController->getReviews();
        break;
    case 'handle-review-vote':
        ob_clean();
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once("Controllers/ReviewControllers.php");
            $controller = new ReviewController();
            $controller->handleVote();
        } else {
            echo json_encode(['error' => 'Method not allowed']);
        }
        exit();
        break;
    case 'get-user-votes':
            require_once("Controllers/ReviewControllers.php");
            $controller = new ReviewController();
            $controller->getUserVotes();
        break;
    case "about":
        require_once("introduce/about.php");
        break;
    case "contact":
        require_once("introduce/contact.php");
        break;
    case "cart":
        require_once("cart/cart.php");
        break;
    case "favorite":
        $act = isset($_GET['xuli']) ? $_GET['xuli'] : "list";
        require_once("Controllers/FavoriteController.php");
        $controller = new FavoriteController();
        switch ($act) {
            case 'list':
                require_once("favorite/list.php");
                break;
            case 'add':
                $controller->add();
                break;
            case 'delete':
                $controller->delete();
                break;
            case 'count':
                $controller->count();
                break;
            default:
                require_once("favorite/list.php");
                break;
        }
        break;
    default:
        require_once("error-404.php");
        break;
}