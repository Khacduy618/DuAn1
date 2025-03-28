<?php
require_once("Models/AuthModel.php");
require_once("MailService.php");

class AuthController
{
    private $authModel;
    private $mailService;

    public function __construct()
    {
        $this->authModel = new AuthModel();
        $this->mailService = new MailService();
    }

    // Hiển thị trang quên mật khẩu
    public function showForgotPassword()
    {
        require_once("Views/index.php");
    }

    // Gửi liên kết đặt lại mật khẩu
    public function sendResetLink()
    {
        $email = $_POST['email'] ?? null;

        // Kiểm tra email có tồn tại trong hệ thống
        if (!$this->authModel->checkEmailExists($email)) {
            $_SESSION['error'] = "Email không tồn tại trong hệ thống!";
            header("Location: index.php?act=forgot_password&xuli=reset_pass");
            exit();
        }

        // Tạo token và lưu vào cơ sở dữ liệu
        $token = bin2hex(random_bytes(32));
        $this->authModel->storeResetToken($email, $token);

        // Tạo liên kết đặt lại mật khẩu
        $resetLink = "https://localhost/?act=forgot_password&xuli=reset_form&token=$token";
        $subject = "Đặt lại mật khẩu";
        $body = "Nhấn vào liên kết sau để đặt lại mật khẩu của bạn: <a href='$resetLink'>$resetLink</a>";

        if ($this->mailService->sendEmail($email, $subject, $body)) {
            $_SESSION['success'] = "Đã gửi email đặt lại mật khẩu, vui lòng kiểm tra email của bạn.";
            header("Location: index.php?act=forgot_password&xuli=reset_pass");
        } else {
            $_SESSION['error'] = "Không thể gửi email, vui lòng thử lại.";
            header("Location: index.php?act=forgot_password&xuli=reset_pass");
        }
        exit();
    }

    // Hiển thị form đặt lại mật khẩu
    public function resetPasswordForm()
    {
        $token = $_GET['token'] ?? null;

        // Kiểm tra token hợp lệ
        if (!$this->authModel->isValidToken($token)) {
            $_SESSION['error'] = "Liên kết không hợp lệ hoặc đã hết hạn!";
            header("Location: index.php?act=forgot_password&xuli=reset_pass");
            exit();
        }
        $data['token'] = $token;
        require_once("Views/index.php");
    }

    // Đặt lại mật khẩu
    public function resetPassword()
    {
        $token = $_POST['token'] ?? null;
        $password = $_POST['password'] ?? null;
        $confirm_password = $_POST['confirm_password'] ?? null;
        // $newPassword = $_POST['password'] ?? null;

        // Cập nhật mật khẩu mới
        if ($this->authModel->updatePassword($token, $newPassword)) {
            echo "Đặt lại mật khẩu thành công!";
        } else {
            echo "Đặt lại mật khẩu thất bại!";
        }

        // Kiểm tra token hợp lệ
        if (!$this->authModel->isValidToken($token)) {
            $_SESSION['error'] = "Liên kết không hợp lệ hoặc đã hết hạn!";
            header("Location: index.php?act=forgot_password&xuli=reset_pass");
            exit();
        }

        // Kiểm tra mật khẩu và xác nhận mật khẩu
        if ($password !== $confirm_password) {
            $_SESSION['error'] = "Mật khẩu và xác nhận mật khẩu không khớp!";
            header("Location: index.php?act=forgot_password&xuli=reset_form&token=$token");
            exit();
        }

        // Cập nhật mật khẩu mới
        if ($this->authModel->updatePassword($token, $password)) {
            $_SESSION['success'] = "Đặt lại mật khẩu thành công! Vui lòng đăng nhập với mật khẩu mới.";
            header("Location: index.php?act=taikhoan&xuli=login");
        } else {
            $_SESSION['error'] = "Đặt lại mật khẩu thất bại!";
            header("Location: index.php?act=forgot_password&xuli=reset_form&token=$token");
        }
        exit();
    
    }
}
