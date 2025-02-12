<?php
require_once('models/favorite.php');

class FavoriteController {
    var $favorite_model;

    public function __construct()
    {
       $this->favorite_model = new Favorite();
    }

    public function list() {
        if (!isset($_SESSION['login'])) { 
            header('Location: index.php?act=taikhoan');
            return;
        }
        
        $user_email = $_SESSION['login']['user_email'];  
        $data['favorites'] = $this->favorite_model->findByUser($user_email);
        require_once('Views/index.php');
    }
    
    public function add() {
        if (!isset($_SESSION['login'])) {
            setcookie('msg1', 'Vui lòng đăng nhập', time() + 1);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            return;
        }

        $user_email = $_SESSION['login']['user_email'];
        $product_id = $_POST['product_id'] ?? null;

        if (!$product_id) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            return;
        }

        // Kiểm tra xem đã tồn tại trong yêu thích chưa
        $existing = $this->favorite_model->findByUserAndProduct($user_email, $product_id);
        if ($existing) {
            // Nếu đã tồn tại thì xóa
            $this->favorite_model->delete($existing['favorite_id']);
            setcookie('msg1', 'Đã xóa khỏi danh sách yêu thích', time() + 1);
        } else {
            // Nếu chưa tồn tại thì thêm mới
            $this->favorite_model->add($user_email, $product_id);
            setcookie('msg1', 'Đã thêm vào danh sách yêu thích', time() + 1);
        }
        
        // Quay lại trang trước đó
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function delete() {
        if (!isset($_SESSION['login'])) {
            setcookie('msg1', 'Vui lòng đăng nhập', time() + 1);
            header('Location: index.php?act=favorite&xuli=list');
            return;
        }

        $favorite_id = $_GET['favorite_id'] ?? null;

        if (!$favorite_id) {
            setcookie('msg1', 'Không tìm thấy mã yêu thích', time() + 1);
            header('Location: index.php?act=favorite&xuli=list');
            return;
        }

        if ($this->favorite_model->delete($favorite_id)) {
            setcookie('msg1', 'Đã xóa khỏi danh sách yêu thích', time() + 1);
        } else {
            setcookie('msg1', 'Không thể xóa sản phẩm', time() + 1);
        }
        
        header('Location: index.php?act=favorite&xuli=list');
    }

    public function count() {
        if (!isset($_SESSION['login'])) {
            header('Location: index.php?act=taikhoan');
            return;
        }
        
        $user_email = $_SESSION['login']['user_email'];
        $count = $this->favorite_model->countFavorites($user_email);
        header('Location: index.php?act=favorite&xuli=list');
    }
}
?>