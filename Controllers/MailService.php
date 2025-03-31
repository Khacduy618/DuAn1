<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailService
{
    private $mailer;

    public function __construct()
    {
        // Khởi tạo PHPMailer
        $this->mailer = new PHPMailer(true);

        // Cấu hình server
        $this->mailer->isSMTP();
        $this->mailer->Host = 'smtp.gmail.com';  // Thay đổi thành SMTP server của bạn
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = 'khacduy54.55@gmail.com'; // Thay đổi thành email của bạn
        $this->mailer->Password = 'jbkw seit ixju fvmz';  // Thay đổi thành mật khẩu email hoặc app password
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port = 587;

        // Cấu hình mặc định
        $this->mailer->setFrom('khacduy54.55@gmail.com', 'Tede Shop'); // Thay đổi thông tin người gửi
        $this->mailer->isHTML(true);
        $this->mailer->CharSet = 'UTF-8';
    }

    public function sendPasswordResetEmail($to, $resetLink)
    {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->addAddress($to);
            $this->mailer->Subject = 'Đặt lại mật khẩu';

            // Tạo nội dung email dạng HTML
            $this->mailer->Body = '
            <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
                <h2>Đặt lại mật khẩu</h2>
                <p>Chúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.</p>
                <p>Vui lòng nhấp vào liên kết bên dưới để đặt lại mật khẩu:</p>
                <p><a href="' . $resetLink . '" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block; margin: 10px 0;">Đặt lại mật khẩu</a></p>
                <p>Liên kết này sẽ hết hạn sau 24 giờ.</p>
                <p>Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.</p>
                <p>Trân trọng,<br>Đội ngũ hỗ trợ</p>
            </div>';

            // Nội dung email dự phòng cho client không hỗ trợ HTML
            $this->mailer->AltBody = "Đặt lại mật khẩu\n\nChúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.\n\nVui lòng truy cập liên kết sau để đặt lại mật khẩu: $resetLink\n\nLiên kết này sẽ hết hạn sau 24 giờ.\n\nNếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.";

            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            // Ghi log lỗi
            error_log("Không thể gửi email: {$this->mailer->ErrorInfo}");
            return false;
        }
    }
}