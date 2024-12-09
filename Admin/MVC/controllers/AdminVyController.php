<?php
require_once("MVC/Models/AdminVyModel.php");

class AdminVyController
{
    private $model;

    public function __construct()
    {
        $this->model = new AdminVyModel();
    }

public function list()
{
    $limit = 10;
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($current_page - 1) * $limit;
    
    $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
    $statusFilter = isset($_GET['status']) ? (int)$_GET['status'] : null;
    
    $total_users = $this->model->getTotalUser($searchQuery, $statusFilter);
    $total_pages = ceil($total_users / $limit);
    
    $listuser = $this->model->getAllUserWithAddress($offset, $limit, $searchQuery, $statusFilter);
    
    foreach ($listuser as &$user) {
        $user['address_display'] = (!empty($user['address_name']) || !empty($user['address_city']) || !empty($user['address_street']))
            ? $user['address_name'] . ', ' . $user['address_city'] . ', ' . $user['address_street']
            : 'Chưa có địa chỉ';

        $user['address_id'] = !empty($user['address']) ? $user['address'][0]['address_id'] : null;
    }
    
    $pagination = [
        'current_page' => $current_page,
        'total_pages' => $total_pages,
        'limit' => $limit
    ];
    
    require_once("MVC/Views/admin/index.php");
}

    public function add()
    {
        require_once("MVC/Views/admin/index.php");
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_name = $_POST['user_name'];
            $user_full_name = $_POST['user_full_name'];
            $user_email = $_POST['user_email'];
            $user_phone = $_POST['user_phone'];

            if (!preg_match('/^[0-9]+$/', $user_phone)) {
                $_SESSION['msg1'] = 'Your phone number must be a digits.';
                header('Location: ?mod=user&act=add');
                exit;
            }

            $user_images = $_FILES['user_images']['name'];
            $user_images_tmp = $_FILES['user_images']['tmp_name'];

            $user_images = $this->model->handleImageUpload($user_images, $user_images_tmp);
            $this->model->addUser($user_name, $user_full_name, $user_email, $user_password, $user_phone, $user_images);

            if (!empty($_POST['address_name']) && !empty($_POST['address_city']) && !empty($_POST['address_street'])) {
                $address_name = $_POST['address_name'];
                $address_city = $_POST['address_city'];
                $address_street = $_POST['address_street'];
                $this->model->addAddress($user_email, $address_name, $address_city, $address_street);
            }

            header('Location: ?mod=user&act=list');
            exit;
        }
    }


    public function edit()
    {
        $user_email = $_GET['user_email'];

        $user = $this->model->getUserByEmail($user_email);
        $address = $this->model->getAddressByEmail($user_email);

        if (!$user) {
            header('Location: ?mod=user&act=list');
            exit;
        }

        require_once("MVC/Views/admin/index.php");
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_name = $_POST['user_name'];
            $user_email = $_POST['user_email'];
            $user_phone = $_POST['user_phone'];
            $user_role = $_POST['user_role'];
            $user_status = $_POST['user_status'];

            $user = $this->model->getUserByEmail($user_email);

            $user_images = $user['user_images']; // Giữ ảnh cũ
                
                if (!empty($_FILES['user_images']['name'])) {
                    $user_images = $_FILES['user_images']['name'];
                    $user_images_tmp = $_FILES['user_images']['tmp_name'];
                    $user_images = $this->model->handleImageUpload($user_images, $user_images_tmp);
                }
            

            $this->model->updateUser($user_name, $user_email, $user_phone, $user_images, $user_role, $user_status);

            if (!empty($_POST['address_name']) && !empty($_POST['address_city']) && !empty($_POST['address_street'])) {
                $address_name = $_POST['address_name'];
                $address_city = $_POST['address_city'];
                $address_street = $_POST['address_street'];
                $address_id = $_POST['address_id'];

                $this->model->updateAddress($address_id, $user_email, $address_name, $address_city, $address_street);
            }

            header('Location: ?mod=user&act=list');
            exit;
        }
    }

    public function delete()
    {
        $user_email = $_GET['user_email'];
        $this->model->deleteUser($user_email);
        $this->model->deleteAddressByEmail($user_email);

        header('Location: ?mod=user&act=list');
        exit;
    }

public function listAddress()
{
    $user_email = $_GET['user_email'];
    if ($user_email) {
        $listaddress = $this->model->getAddressByEmail($user_email);
    } else {
        $listaddress = $this->model->getAllAddress();
    }
    require_once("MVC/Views/admin/index.php");
}

public function userAddress()
{
    if (isset($_GET['user_email'])) {
        $user_email = $_GET['user_email'];
        $listaddress = $this->model->getAddressByEmail($user_email);
        require_once("MVC/Views/admin/index.php");
    }
}


public function addAddress()
{
    $user_email = $_GET['user_email'];
    
    require_once("MVC/Views/admin/index.php");
}

public function storeAddress()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_email = $_POST['user_email'];
        $address_name = $_POST['address_name'];
        $address_city = $_POST['address_city'];
        $address_street = $_POST['address_street'];

        if (!$user_email || !$address_name || !$address_city || !$address_street) {
            $_SESSION['message'] = 'Vui lòng điền đầy đủ thông tin.';
            header("Location: ?mod=address&act=add&user_email=".$user_email);
            exit;
        }

        try {
            $this->model->addAddress($user_email, $address_name, $address_city, $address_street);
            $_SESSION['message'] = 'Thêm địa chỉ thành công!';
        } catch (Exception $e) {
            $_SESSION['message'] = 'Thêm địa chỉ thất bại. Vui lòng thử lại.';
        }

        header("Location: ?mod=address&act=list&user_email=".$user_email);
        exit;
    }
}

public function updateStatus()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $address_id = $_POST['address_id'];
        $address_status = $_POST['address_status'];
        $this->model->updateAddressStatus($address_id, $address_status);
        $_SESSION['message'] = "Cập nhật trạng thái thành công!";
        $user_email = $_POST['user_email'] ?? '';
        header("Location: ?mod=address&act=list&user_email=".$user_email);
        exit;
    }
}


    public function detail()
    {
        $user_email = $_GET['user_email'];

        $user = $this->model->getUserByEmail($user_email);
        $address = $this->model->getAddressByEmail($user_email);

        if (!$user) {
            header('Location: ?mod=address&act=list');
            exit;
        }

        require_once("MVC/Views/address/list.php");
    }
    public function listFavorite()
    {
        $limit = 10;
        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($current_page - 1) * $limit;
        
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
        
        if (isset($_GET['user_email'])) {
            $user_email = $_GET['user_email'];
            $listfavorites = $this->model->getFavoritesByEmail($user_email);
            $total_favorites = count($listfavorites);
        } else {
            $total_favorites = $this->model->getTotalFavorites($searchQuery);
            $listfavorites = $this->model->getAllFavorites($offset, $limit, $searchQuery);
        }
        
        $total_pages = ceil($total_favorites / $limit);
        
        $pagination = [
            'current_page' => $current_page,
            'total_pages' => $total_pages,
            'limit' => $limit
        ];
        
        require_once("MVC/Views/admin/index.php");
    }
    
    public function deleteFavorite()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['favorite_id'])) {
            $favorite_id = $_POST['favorite_id'];
            
            if ($this->model->deleteFavorite($favorite_id)) {
                $_SESSION['message'] = 'Xóa sản phẩm yêu thích thành công!';
            } else {
                $_SESSION['message'] = 'Có lỗi xảy ra khi xóa sản phẩm yêu thích!';
            }
            
            header("Location: ?mod=favorite&act=list");
            exit;
        }
    }
    
}