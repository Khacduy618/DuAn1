<?php
session_start();
ob_start();

define("UPLOAD_DIR","http://localhost/DuAn1/uploaded/");

define("BASE_URL","http://localhost/DuAn1/");

$mod = isset($_GET['act']) ? $_GET['act'] : "home";


switch ($mod) {
    case 'home':
        require_once 'Controllers/HomeController.php';
        $controller_obj = new HomeController();
        $controller_obj->list();
        break;
    case 'taikhoan':
        $act = isset($_GET['xuli']) ? $_GET['xuli'] : "taikhoan";
        require_once('Controllers/LoginController.php');
        $controller_obj = new LoginController();
        if ((isset($_SESSION['login']) && $_SESSION['login'] == true)) {
            switch ($act) {
                case 'dangxuat':
                    $controller_obj->dangxuat();
                    break;
                case 'account':
                    $controller_obj->account();
                    break;
                case 'update':
                    $controller_obj->update();
                    break;
                default:
                    header('location: ?act=error');
                    break;
            }
            break;
        } else {
                switch ($act) {
                    case 'login':
                        $controller_obj->login();
                        break;
                    case 'dangnhap':
                        $controller_obj->login_action();
                        break;
                    case 'dangky':
                        $controller_obj->dangky();
                        break;
                    default:
                        $controller_obj->login();
                        break;
                }
                break;
            }
    case 'shop':
        require_once('Controllers/ShopController.php');
        $controller_obj = new ShopController();
        $controller_obj->list();
        break;
    case 'product':
        require_once('Controllers/ProductController.php');
        $controller_obj = new ProductController();
        $controller_obj->list();
        break;
    case 'cart':
        $act = isset($_GET['xuli']) ? $_GET['xuli'] : "list";
        require_once('Controllers/CartController.php');
        $controller_obj = new CartController();
        switch ($act) {
            case 'list':
                $controller_obj->list_cart();
                break;
            case 'update':
                $controller_obj->add_cart();
                break;
            case 'add':
                $controller_obj->add_cart();
                break;
            case 'update':
                $controller_obj->update_cart();
                break;
            case 'delete':
                $controller_obj->delete_cart();
                break;
            case 'deleteall':
                $controller_obj->deleteall_cart();
                break;
            default:
                $controller_obj->list_cart();
                break;
        }
        break;
    
    case 'googleCallBack':
        //Client ID 923806569998-96n53k9bp5832dpnvu97bobigosk5h09.apps.googleusercontent.com
        //Client secret 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
        //Redirect http://localhost/DuAn1/?act=googleCallBack long
        //Redirect http://localhost/DuAn1/?act=googleCallBack hosting
        //DIR ('vendor/google/apiclient/src')
        //DIR ('vendor/google/apiclient-services/src')
        //DIR ('libs/credentials.json') key cua tui á mấy bro nhớ xóa kia lên hosting
        //google_id 114374951914294437080
        require __DIR__ . '/vendor/autoload.php';

        try {
            $client = new Google\Client();
            
            // Cấu hình cơ bản
            $client->setClientId('923806569998-96n53k9bp5832dpnvu97bobigosk5h09.apps.googleusercontent.com');
            $client->setClientSecret('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');
            $client->setRedirectUri('http://localhost/DuAn1/?act=googleCallBack');
            
            // Scope cơ bản
            $client->addScope('https://www.googleapis.com/auth/userinfo.email');
            $client->addScope('https://www.googleapis.com/auth/userinfo.profile');
            
            if (isset($_GET['code'])) {
                $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                $client->setAccessToken($token);
                
                $oauth2 = new Google\Service\Oauth2($client);
                $userInfo = $oauth2->userinfo->get();
                
                // Lấy thông tin cần thiết
                $google_id = $userInfo->id;
                $email = $userInfo->email;
                $name = $userInfo->givenName;
                $user_full_name = $userInfo->familyName.' '.$userInfo->givenName;
                $picture = $userInfo->picture;
                
                // Kiểm tra xem email đã tồn tại trong DB chưa
                require_once('Models/login.php');
                $loginModel = new Login();
                $user = $loginModel->checkEmail($email);
                if(isset($user)) {
                    // Nếu email đã tồn tại, kiểm tra role và đăng nhập
                    if($user['user_role'] == 1) {
                        $_SESSION['isLogin_Admin'] = true;
                        $_SESSION['login'] = $user;
                        header('Location: /DuAn1/Admin');
                        exit();
                    } else if($user['user_role'] >= 2) {
                        $_SESSION['isLogin_Nhanvien'] = true;
                        $_SESSION['login'] = $user;
                        header('Location: /DuAn1/Admin');
                        exit();
                        
                    } else {
                        $_SESSION['isLogin'] = true;
                        $_SESSION['login'] = $user;
                        header('Location: ?act=home');
                    }
                } else {
                    // Nếu email chưa tồn tại, tạo tài khoản mới với role = 0
                    $data = array(
                        'google_id' => $google_id,
                        'user_name' => $name,  // Có thể tách name thành Họ và Tên
                        'user_full_name' => $user_full_name,
                        'user_email' => $email,
                        // 'user_images' => $picture,
                        'user_images' => 'user.png',
                        'user_password' => '', // Tài khoản Google không cần mật khẩu
                    );
                    $user_id = $loginModel->dangky_google(
                        $data['google_id'],
                        $data['user_name'],
                        $data['user_full_name'],
                        $data['user_email'],
                        $data['user_images'],
                        $data['user_password']
                    );

                    if($user_id) {
                        $_SESSION['isLogin'] = true;
                        $_SESSION['login'] = $loginModel->checkEmail($email);
                        header('Location: ?act=home');
                    }
                }
                // Chuyển hướng về trang chủ
                header('Location: ?act=home');
                exit;
            } else {
                $authUrl = $client->createAuthUrl();
                header('Location: ' . $authUrl);
                exit;
            }
            
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
        break;
    case 'checkout':
        $act = isset($_GET['xuli']) ? $_GET['xuli'] : "list";
        require_once('Controllers/CheckoutController.php');
        $controller_obj = new CheckoutController();
        switch ($act) {
            case 'list':
                $controller_obj->list();
                break;
            case 'save':
                $controller_obj->save();
                break;
            case 'checkout_complete':
                $controller_obj->checkout_complete();
                break;
            case 'details':
                $controller_obj->details();
                break;
            case 'order_history':
                $controller_obj->order_history();
                break;
            default:
                $controller_obj->list();
                break;
        }
        break;
    case 'blog': 
        require_once('Controllers/BlogController.php');
        $controller_obj = new BlogController() ;
        $controller_obj->Blog_View();
        break; 
    case 'blog_detail':
        require_once('Controllers/BlogController.php');
        $controller_obj = new BlogController() ;
        $controller_obj->Blog_Detail();
        break;
    case 'comment':
        require_once('Controllers/CommentController.php');
        $controller_obj = new commentControlller();
        $controller_obj->comment_exc(); 
        break; 
    case 'favorite':
        require_once('Controllers/FavoriteController.php');
        $controller_obj = new FavoriteController();
        $act = isset($_GET['xuli']) ? $_GET['xuli'] : "list";
        switch ($act) {
            case 'list':
                $controller_obj->list();
                require_once('Views/index.php');
                break;
            case 'add':
                $controller_obj->add();
                break;
            case 'delete':
                $controller_obj->delete();
                break;
            default:
                $controller_obj->list();
                require_once('Views/index.php');
                break;
            }
            break;  
    default:
        require_once 'Controllers/HomeController.php';
        $controller_obj = new HomeController();
        $controller_obj->list();
        break;
}