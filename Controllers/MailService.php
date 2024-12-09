<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class MailService
{
    private $mail;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        // Cấu hình SMTP
        $this->mail->isSMTP();
        $this->mail->Host       = 'smtp.gmail.com';
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = 'tranvietkhoa2004@gmail.com'; // Email của bạn
        $this->mail->Password   = 'Vietkhoa2004';    // Mật khẩu ứng dụng Gmail
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port       = 587;

        // Người gửi mặc định
        $this->mail->setFrom('tedeshop@gmail.com', 'Tede Shop');
    }

    public function sendEmail($toEmail, $subject, $body)
    {
        try {
            // Người nhận
            $this->mail->addAddress($toEmail);

            // Nội dung email
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;

            // Gửi email
            $this->mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Không thể gửi email. Lỗi: {$this->mail->ErrorInfo}");
            return false;
        }
    }
}
