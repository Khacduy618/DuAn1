<?php
require_once("Models/address.php");

class AddressController {
    private $addressModel;

    public function __construct() {
        $this->addressModel = new Address();
    }

    // Hiển thị danh sách địa chỉ
    public function list_addresses() {
        if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true) {
            $userEmail = $_SESSION['login']['user_email'];
            $addresses = $this->addressModel->getAllAddresses($userEmail);
            require_once 'Views/index.php';
        } else {
            header('location: ?act=taikhoan&xuli=login');
        }
    }

    // Thêm địa chỉ
    public function add_address() {
        if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true) {
            if (isset($_POST['name'], $_POST['city'], $_POST['street'])) {
                $userEmail = $_SESSION['login']['user_email'];
                $name = $_POST['name'];
                $city = $_POST['city'];
                $street = $_POST['street'];
                $this->addressModel->addAddress($userEmail, $name, $city, $street);
                header('location: ?act=address&xuli=list');
            }
        } else {
            header('location: ?act=taikhoan&xuli=login');
        }
    }

    // Sửa địa chỉ
    public function update_address() {
        if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true) {
            if (isset($_POST['id'], $_POST['name'], $_POST['city'], $_POST['street'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $city = $_POST['city'];
                $street = $_POST['street'];
                $this->addressModel->updateAddress($id, $name, $city, $street);
                header('location: ?act=address&xuli=list');
            }
        } else {
            header('location: ?act=taikhoan&xuli=login');
        }
    }

    // Xóa địa chỉ
    public function delete_address() {
        if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true) {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $this->addressModel->deleteAddress($id);
                header('location: ?act=address&xuli=list');
            }
        } else {
            header('location: ?act=taikhoan&xuli=login');
        }
    }
}
?>