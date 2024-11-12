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
            header("Location: views/account/index.php");
            exit;
        }

        $account = User::getAll();
        include __DIR__ . '/../Views/home/index.php';
    }

    // Hàm xử lý đăng ký
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['user_email'];
            $username = $_POST['user_name'];
            $password = $_POST['user_password'];

            if (!empty($email) && !empty($username) && !empty($password)) {
                try {
                    $newUser = new User($email, $username, $password);
                    $newUser->insert();

                    // Đăng ký thành công
                    $_SESSION['message'] = "Đăng ký thành công! Hãy đăng nhập.";
                    header("Location: index.php?act=taikhoan&xuli=login");
                    exit();
                } catch (Exception $e) {
                    $_SESSION['error_message'] = $e->getMessage();
                    header("Location: index.php?act=taikhoan&xuli=dangky");
                }
            } else {
                $_SESSION['error_message'] = "Vui lòng điền đầy đủ thông tin.";
                header("Location: index.php?act=taikhoan&xuli=dangky");
            }
        }
    }



    // Hàm xử lý đăng nhập
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['user_name'];
            $password = $_POST['user_password'];

            $user = User::findByCredentials($username, $password);
            if ($user) {
                // Đăng nhập thành công
                session_start();
                $_SESSION['user'] = $user;
                $_SESSION['isLogin'] = true;
                header("Location: index.php?act=taikhoan&xuli=account");
                exit();
            } else {
                // Đăng nhập thất bại
                $_SESSION['error_message'] = "Username hoặc mật khẩu không đúng.";
                header("Location: index.php?act=taikhoan&xuli=login");
            }
        }
    }



    public function forgotPassword()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['user_email'];
            $account = User::findByEmail($email);
            $_SESSION['message'] = $account ? "Email đặt lại mật khẩu đã được gửi." : "Email không tồn tại trong hệ thống.";
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
        exit();
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

            $account = new User($email, $username, $password, $phone);
            $account->update($email, $password);
            $_SESSION['message'] = "Tài khoản đã được cập nhật thành công.";
            header("Location: index.php?controller=account&action=index");
            exit();
        } else {
            if (isset($_GET['email'])) {
                $email = $_GET['email'];
                $account = User::findById($email);
            }
        }

        if ($account === null) {
            $_SESSION['message'] = "Tài khoản không tồn tại.";
            header("Location: index.php?controller=account&action=index");
            exit();
        }

        include 'Views/home/edit.php';
    }
}
