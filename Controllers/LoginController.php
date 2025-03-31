<?php
require_once("Models/login.php");
class LoginController
{
    var $login_model;
    public function __construct()
    {
        $this->login_model = new Login();
    }
    function login()
    {
        require_once('Views/index.php');
    }
    function login_action()
    {

        $user_email = $_POST['user_email'];
        $user_password = md5($_POST['user_password']);
        if (strpos($user_email, "'") != false) {
            $user_email = str_replace("'", "\'", $user_email);

        }
        $this->login_model->login_action($user_email, $user_password);

    }
    function dangky()
    {
        $check1 = 0;
        $check2 = 0;
        $check3 = 0;

        if (strlen($_POST['user_password']) < 8) {
            $check3 = 1;
        }

        $data_check = $this->login_model->check_account();
        foreach ($data_check as $value) {
            if ($value['user_email'] == $_POST['user_email']) {
                $check1 = 1;
            }
        }

        if ($_POST['user_password'] != $_POST['check_password']) {
            $check2 = 1;
        }

        $data = array(
            'user_name' => $_POST['user_name'],
            'user_password' => md5($_POST['user_password']),
            'user_email' => $_POST['user_email'],
            'user_images' => 'user.png',
        );
        foreach ($data as $key => $value) {
            if (strpos($value, "'") != false) {
                $value = str_replace("'", "\'", $value);
                $data[$key] = $value;
            }
        }

        $this->login_model->dangky_action($data, $check1, $check2, $check3);
    }
    function dangxuat()
    {
        $this->login_model->logout();
    }
    function account()
    {

        $user_email = $_SESSION['login']['user_email'];
        $data = $this->login_model->account($user_email);

        require_once('Views/index.php');
    }
    function update()
    {
        $user_email = $_SESSION['login']['user_email'];
        if (isset($_POST['user_name'])) {
            // Thông tin từ bảng user
            $data = array(
                'user_name' => $_POST['user_name'],
                'user_full_name' => $_POST['user_full_name'],
                'user_phone' => $_POST['user_phone'],
            );

            // Thông tin từ bảng address
            $address_data = array(
                'address_name' => $_POST['address_name'],
                'address_city' => $_POST['address_city'],
                'address_street' => $_POST['address_street']
            );

            // Xử lý ảnh đại diện
            if (isset($_FILES['user_images']) && $_FILES['user_images']['error'] == 0) {
                $target_dir = "uploaded/";
                $user_images = $_FILES["user_images"]["name"];
                $target_file = $target_dir . basename($user_images);
                if (move_uploaded_file($_FILES["user_images"]["tmp_name"], $target_file)) {
                    $data['user_images'] = $user_images; // Đường dẫn ảnh đại diện
                }
            }

            // Gọi hàm update từ model
            $this->login_model->update_account($data, $address_data, $user_email);
        }

        header('location: ?act=taikhoan&xuli=account#doitk');
    }

    function forgotPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['user_email'];

            // Validate email
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Check if email exists in database
                $user = $this->login_model->checkEmail($email);

                if ($user) {
                    // Generate token and expiration time (24 hours)
                    $token = bin2hex(random_bytes(32));
                    $expires = date('Y-m-d H:i:s', time() + 86400);

                    // Save token to database
                    $this->login_model->saveResetToken($email, $token, $expires);

                    // Create reset link
                    $reset_link = "http://" . $_SERVER['HTTP_HOST'] . "/DuAn1/?act=forgot_password&xuli=reset_form&token=" . $token;

                    // Send email with link using PHPMailer
                    require_once('Controllers/MailService.php');
                    $mailService = new MailService();
                    $emailSent = $mailService->sendPasswordResetEmail($email, $reset_link);
                    // $isDev = true; // Đặt thành false khi triển khai thực tế
                    // // $emailSent = $isDev 
                    // //     ? $mailService->sendPasswordResetEmailDev($email, $reset_link) 
                    // //     : $mailService->sendPasswordResetEmail($email, $reset_link);

                    if ($emailSent) {
                        setcookie('msg', 'Hướng dẫn đặt lại mật khẩu đã được gửi vào email của bạn', time() + 5);
                    } else {
                        setcookie('msg1', 'Không thể gửi email. Vui lòng thử lại sau.', time() + 5);
                    }
                } else {
                    setcookie('msg1', 'Email không tồn tại trong hệ thống', time() + 5);
                }
            } else {
                setcookie('msg1', 'Vui lòng nhập email hợp lệ', time() + 5);
            }
            header('Location: ?act=forgot_password&xuli=reset_pass');
        }
    }

    function resetPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['token'];
            $password = $_POST['user_password'];
            $confirm_password = $_POST['confirm_password'];

            // Validate token
            $tokenData = $this->login_model->validateResetToken($token);

            if (!$tokenData) {
                setcookie('msg1', 'Invalid or expired token', time() + 5);
                header('Location: ?act=taikhoan');
                return;
            }

            // Validate password
            if (strlen($password) < 8) {
                setcookie('msg1', 'Password must be at least 8 characters long', time() + 5);
                header('Location: ?act=forgot_password&xuli=reset_form&token=' . $token);
                return;
            }

            if ($password !== $confirm_password) {
                setcookie('msg1', 'Passwords do not match', time() + 5);
                header('Location: ?act=forgot_password&xuli=reset_form&token=' . $token);
                return;
            }

            // Update password
            $email = $tokenData['user_email'];
            $hashed_password = md5($password);
            $this->login_model->updatePassword($email, $hashed_password);

            // Clear token
            $this->login_model->clearResetToken($email);

            setcookie('msg', 'Your password has been updated successfully', time() + 5);
            header('Location: ?act=taikhoan');
        }
    }
}