<?php
// controllers/AccountController.php
require_once 'Models/User.php'; // Đảm bảo đường dẫn tới user.php là chính xác

class AccountController
{
    private function isAdmin()
    {
        return isset($_SESSION['user']) && $_SESSION['user']['user_role'] == 1;
    }

    public function index()
    {
        if (!$this->isAdmin()) {
            $_SESSION['message'] = "Bạn không có quyền truy cập trang này.";
            header("Location: index.php?controller=account&action=login");
            exit;
        }

        $accounts = user::getAll();
        include 'admin/views/account/list.php';
    }


    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = md5($_POST['user_email']);
            $username = md5($_POST['user_name']);
            $password = md5($_POST['user_password']);
            $phone = $_POST['user_phone'] ?? null;

            // Tạo đối tượng người dùng mới và gán user_role là 0
            $account = new user($email, $username, $password, $phone, 0);
            $account->insert();

            // Đăng nhập người dùng sau khi đăng ký và chuyển hướng tới trang người dùng
            $_SESSION['user'] = [
                'user_email' => $email,
                'user_name' => $username,
                'user_role' => 0,
            ];

            header("Location: index.php?controller=account&action=userPage"); // Điều hướng tới trang người dùng
        } else {
            include 'admin/views/account/register.php';
        }
    }


    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['user_name'];
            $password = $_POST['user_password'];

            $account = user::findByCredentials($username, $password);
            if ($account) {
                $_SESSION['user'] = $account; // Lưu toàn bộ thông tin người dùng vào session

                // Điều hướng dựa trên quyền của người dùng
                if ($account['user_role'] == 1) {
                    header("Location: index.php?controller=account&action=index"); // Trang quản lý
                } else {
                    header("Location: index.php?controller=account&action=userPage"); // Trang người dùng
                }
            } else {
                $error = "Sai thông tin đăng nhập!";
                include 'admin/views/account/login.php';
            }
        } else {
            include 'admin/views/account/login.php';
        }
    }

    public function userPage()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=account&action=login");
            exit;
        }

        include 'admin/views/account/userPage.php'; // Tạo file này để hiển thị trang người dùng
    }

    public function bulkAction()
    {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
            $selectedIds = $_POST['selected_ids'] ?? [];

            switch ($action) {
                case 'select_all':
                    // Logic cho chọn tất cả (nếu cần)
                    header("Location: index.php?controller=account&action=index&select_all=1");
                    break;

                case 'deselect_all':
                    // Logic cho bỏ chọn tất cả (nếu cần)
                    header("Location: index.php?controller=account&action=index&deselect_all=1");
                    break;

                case 'delete_selected':
                    if (!empty($selectedIds)) {
                        foreach ($selectedIds as $id) {
                            user::delete($id); // Xóa từng tài khoản
                        }
                        $_SESSION['message'] = "Đã xóa các mục đã chọn.";
                    } else {
                        $_SESSION['message'] = "Vui lòng chọn ít nhất một mục để xóa.";
                    }
                    header("Location: index.php?controller=account&action=index");
                    break;
            }
        }
    }

    public function logout()
    {
        // Hủy session của người dùng
        session_unset();
        session_destroy();
        // Chuyển hướng tới trang đăng nhập
        header("Location: index.php?controller=account&action=login");
        exit;
    }

    public function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            user::delete($id);
            $_SESSION['message'] = "Tài khoản đã được xóa thành công.";
            header("Location: index.php?controller=account&action=index");
        } else {
            $_SESSION['message'] = "ID không hợp lệ.";
            header("Location: index.php?controller=account&action=index");
        }
    }
    public function edit()
    {
        $account = null; // Biến để chứa thông tin người dùng
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['user_id'];
            $email = $_POST['user_email'];
            $username = $_POST['user_name'];
            $password = $_POST['user_password'] ?? null; // Nếu không có mật khẩu mới
            $phone = $_POST['user_phone'] ?? null;

            // Cập nhật thông tin tài khoản
            $account = new user($email, $username, $password, $phone);
            $account->update($id, $password); // Nếu có mật khẩu mới
            $_SESSION['message'] = "Tài khoản đã được cập nhật thành công.";
            header("Location: index.php?controller=account&action=index");
            exit; // Đảm bảo không tiếp tục thực thi mã sau khi điều hướng
        } else {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $account = user::findById($id); // Sử dụng phương thức mới để tìm theo ID
            }
        }

        // Kiểm tra xem tài khoản có tồn tại không
        if ($account === null) {
            $_SESSION['message'] = "Tài khoản không tồn tại.";
            header("Location: index.php?controller=account&action=index");
            exit;
        }

        include 'admin/views/account/edit.php'; // Tải giao diện chỉnh sửa
    }
}