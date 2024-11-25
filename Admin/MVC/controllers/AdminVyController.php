<?php
require_once("MVC/Models/AdminVyModel.php");

class AdminVyController
{
    private $model;

    public function __construct()
    {
        $this->model = new AdminVyModel();
    }

    // Lấy danh sách người dùng
    public function list()
    {
        $listuser = $this->model->getAllUserWithAddress();
        foreach ($listuser as &$user) {
            $user['address_display'] = (!empty($user['address_name']) || !empty($user['address_city']) || !empty($user['address_street']))
                ? $user['address_name'] . ', ' . $user['address_city'] . ', ' . $user['address_street']
                : 'Chưa có địa chỉ';
        }

        require_once("MVC/Views/admin/index.php");
    }

    // Trang thêm 
    public function add()
    {
        require_once("MVC/Views/admin/index.php");
    }

    // Thêm
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_name = $_POST['user_name'];
            $user_full_name = $_POST['user_full_name'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];
            $user_phone = $_POST['user_phone'];

            // Xử lý ảnh
            $user_images = $_FILES['user_images']['name'];
            $user_images_tmp = $_FILES['user_images']['tmp_name'];

            // Thêm người dùng
            $this->model->addUser($user_name, $user_full_name, $user_email, $user_password, $user_phone, $user_images, $user_images_tmp);

            // Thêm địa 
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

    // Chỉnh sửa người dùng
    public function edit()
    {
        $user_email = $_GET['user_email'];

        // Lấy thông tin người dùng và địa chỉ
        $user = $this->model->getUserByEmail($user_email);
        $address = $this->model->getAddressByEmail($user_email);

        if (!$user) {
            header('Location: ?mod=user&act=list');
            exit;
        }

        require_once("MVC/Views/admin/index.php");
    }

    // Cập nhật người dùng
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_name = $_POST['user_name'];
            $user_email = $_POST['user_email'];
            $user_phone = $_POST['user_phone'];
            $user_role = $_POST['user_role'];
            $user_status = $_POST['user_status'];

            $current_user_images = isset($_POST['current_user_images']) ? $_POST['current_user_images'] : '';
            $user_images = $_FILES['user_images']['name'];
            $user_images_tmp = $_FILES['user_images']['tmp_name'];
            if (empty($user_images)) {
                $user_images = $current_user_images;
            } else {
                $user_images = $this->model->handleImageUpload($user_images, $user_images_tmp);
            }

            // Cập nhật thông tin người dùng
            $this->model->updateUser($user_name, $user_email, $user_phone, $user_images, $user_role, $user_status);

            // Cập nhật địa chỉ nếu có
            if (!empty($_POST['address_name']) && !empty($_POST['address_city']) && !empty($_POST['address_street'])) {
                $address_name = $_POST['address_name'];
                $address_city = $_POST['address_city'];
                $address_street = $_POST['address_street'];
                $address_id = isset($_POST['address_id']) ? $_POST['address_id'] : null;

                $this->model->updateAddress($address_id, $user_email, $address_name, $address_city, $address_street);
            }

            header('Location: ?mod=user&act=list');
            exit;
        }
    }


    public function delete()
    {
        $user_email = $_GET['user_email'];

        // Xóa người dùng và địa chỉ liên quan
        $this->model->deleteUser($user_email);
        $this->model->deleteAddress($user_email);

        header('Location: ?mod=user&act=list');
        exit;
    }

    //     // Xóa nhiều người dùng
    //     public function deleteSelectedUsers()
    //     {
    //         if (!empty($_POST['user_email'])) {
    //             foreach ($_POST['user_email'] as $user_email) {
    //                 $this->model->deleteUser($user_email);
    //                 $this->model->deleteAddress($user_email);
    //             }
    //         }
    //         header('Location: ?mod=user&act=list');
    //         exit;
    //     }
}