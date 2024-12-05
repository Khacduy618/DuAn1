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
    $listuser = $this->model->getAllUserWithAddress();
    foreach ($listuser as &$user) {
        $user['address_display'] = (!empty($user['address_name']) || !empty($user['address_city']) || !empty($user['address_street']))
            ? $user['address_name'] . ', ' . $user['address_city'] . ', ' . $user['address_street']
            : 'Chưa có địa chỉ';

        $user['address_id'] = !empty($user['address']) ? $user['address'][0]['address_id'] : null;
    }

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
            $user_password = $_POST['user_password'];
            $user_phone = $_POST['user_phone'];

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

            $current_user_images = $_POST['current_user_images'] ?? '';
            $user_images = $_FILES['user_images']['name'];
            $user_images_tmp = $_FILES['user_images']['tmp_name'];
            if (empty($user_images)) {
                $user_images = $current_user_images;
            } else {
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

    
}