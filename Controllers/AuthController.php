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
            echo "Email không tồn tại trong hệ thống!";
            return;
        }

        // Tạo token và lưu vào cơ sở dữ liệu
        $token = bin2hex(random_bytes(32));
        $this->authModel->storeResetToken($email, $token);

        // Tạo liên kết đặt lại mật khẩu
        $resetLink = "http://localhost/DuAn1/?mod=auth&act=resetPasswordForm&token=$token";
        $subject = "Đặt lại mật khẩu";
        $body = "Nhấn vào liên kết sau để đặt lại mật khẩu của bạn: <a href='$resetLink'>$resetLink</a>";

        if ($this->mailService->sendEmail($email, $subject, $body)) {
            echo "Đã gửi email đặt lại mật khẩu, vui lòng kiểm tra email của bạn.";
        } else {
            echo "Không thể gửi email, vui lòng thử lại.";
        }
    }

    // Hiển thị form đặt lại mật khẩu
    public function resetPasswordForm()
    {
        $token = $_GET['token'] ?? null;

        // Kiểm tra token hợp lệ
        if (!$this->authModel->isValidToken($token)) {
            echo "Liên kết không hợp lệ hoặc đã hết hạn!";
            return;
        }

        require_once("Views/index.php");
    }

    // Đặt lại mật khẩu
    public function resetPassword()
    {
        $token = $_POST['token'] ?? null;
        $newPassword = $_POST['password'] ?? null;

        // Cập nhật mật khẩu mới
        if ($this->authModel->updatePassword($token, $newPassword)) {
            echo "Đặt lại mật khẩu thành công!";
        } else {
            echo "Đặt lại mật khẩu thất bại!";
        }
    }
}
