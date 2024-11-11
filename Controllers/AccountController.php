<?php
require_once 'models/user.php';

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

        $accounts = User::getAll();
        include __DIR__ . '/../Views/home/index.php';
    }

    // Hàm xử lý đăng ký
    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user_email = $_POST['user_email'];
            $user_name = $_POST['user_name'];
            $user_password = $_POST['user_password'];

            // Kiểm tra xem email đã tồn tại chưa
            if (User::findByEmail($user_email)) {
                $_SESSION['error'] = "Email đã tồn tại!";
                header("Location: index.php?act=register");
                exit();
            }

            // Nếu email chưa tồn tại, tiến hành đăng ký người dùng
            $user = new User($user_email, $user_name, $user_password);
            if ($user->insert()) {
                $_SESSION['message'] = "Đăng ký thành công!";
                header("Location: index.php?act=login");  // Chuyển hướng đến trang đăng nhập
                exit();
            } else {
                $_SESSION['error'] = "Có lỗi trong quá trình đăng ký!";
                header("Location: index.php?act=register");
                exit();
            }
        }
        include 'Views/account/register.php';
    }

    // Hàm xử lý đăng nhập
    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['user_name'];
            $password = $_POST['user_password'];

            // Kiểm tra thông tin đăng nhập
            $account = User::findByCredentials($username, $password);
            if ($account) {
                // Lưu thông tin người dùng vào session
                $_SESSION['user'] = [
                    'user_name' => $account['user_name'],
                    'user_role' => $account['user_role'],
                    'user_email' => $account['user_email'], // Thêm email nếu cần
                ];

                echo '<pre>';
                print_r($_SESSION);
                echo '</pre>';

                // Điều hướng dựa trên quyền của người dùng
                if ($account['user_role'] == 1) {
                    header("Location: index.php?controller=account&action=index"); // Trang quản lý
                }
            } else {
                $_SESSION['error'] = "Sai thông tin đăng nhập!";
                header("Location: index.php?act=login");  // Quay lại trang đăng nhập
                exit();
            }
        }

        // Hiển thị form đăng nhập
        include 'Views/account/login.php';
    }



    public function forgotPassword()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['user_email'];
            $account = User::findByEmail($email);
            if ($account) {
                $_SESSION['message'] = "Email đặt lại mật khẩu đã được gửi.";
            } else {
                $_SESSION['message'] = "Email không tồn tại trong hệ thống.";
            }
        }

        include __DIR__ . '/../Views/home/index.php';
    }


    public function bulkAction()
    {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
            $selectedEmails = $_POST['selected_emails'] ?? [];

            switch ($action) {
                case 'select_all':
                    header("Location: index.php?controller=account&action=index&select_all=1");
                    break;

                case 'deselect_all':
                    header("Location: index.php?controller=account&action=index&deselect_all=1");
                    break;

                case 'delete_selected':
                    if (!empty($selectedEmails)) {
                        foreach ($selectedEmails as $email) {
                            User::delete($email);
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
        session_unset();
        session_destroy();
        header("Location: index.php?controller=account&action=login");
        exit;
    }

    public function delete()
    {
        if (isset($_GET['email'])) {
            $email = $_GET['email'];
            User::delete($email);
            $_SESSION['message'] = "Tài khoản đã được xóa thành công.";
            header("Location: index.php?controller=account&action=index");
        } else {
            $_SESSION['message'] = "Email không hợp lệ.";
            header("Location: index.php?controller=account&action=index");
        }
    }

    public function edit()
    {
        $account = null;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['user_email'];
            $username = $_POST['user_name'];
            $password = $_POST['user_password'] ?? null;
            $phone = $_POST['user_phone'] ?? null;

            // Cập nhật thông tin tài khoản
            $account = new User($email, $username, $password, $phone);
            $account->update($email, $password);
            $_SESSION['message'] = "Tài khoản đã được cập nhật thành công.";
            header("Location: index.php?controller=account&action=index");
            exit;
        } else {
            if (isset($_GET['email'])) {
                $email = $_GET['email'];
                $account = User::findById($email);
            }
        }
        if ($account === null) {
            $_SESSION['message'] = "Tài khoản không tồn tại.";
            header("Location: index.php?controller=account&action=index");
            exit;
        }

        include 'Views/home/edit.php';
    }
}
