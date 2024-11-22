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
            'user_name' =>    $_POST['user_name'],
            'user_password' => md5($_POST['user_password']),
            'user_email'  =>   $_POST['user_email'],
            'user_images' => 'user.png',
        );
        foreach ($data as $key => $value) {
            if (strpos($value, "'") != false) {
                $value = str_replace("'", "\'", $value);
                $data[$key] = $value;
            }
        }

        $this->login_model->dangky_action($data, $check1, $check2);
    }
    function dangxuat()
    {
        $this->login_model->logout();
    }
    function account()
    {
       
        $data = $this->login_model->account();

        require_once('Views/index.php');
    }
    function update()
    {

        if (isset($_POST['Ho'])) {
            $data = array(
                'Ho' =>    $_POST['Ho'],
                'Ten'  =>   $_POST['Ten'],
                'GioiTinh' => $_POST['GioiTinh'],
                'SDT' => $_POST['SĐT'],
                'Email' =>    $_POST['Email'],
                'DiaChi'  =>   $_POST['DiaChi'],
            );
            foreach ($data as $key => $value) {
                if (strpos($value, "'") != false) {
                    $value = str_replace("'", "\'", $value);
                    $data[$key] = $value;
                }
            }
            $this->login_model->update_account($data);
        } else {
            if ($_POST['MatKhauMoi'] == $_POST['MatKhauXN']) {
                if (md5($_POST['MatKhau']) == $_SESSION['login']['MatKhau']) {
                    $data = array(
                        'MatKhau' => md5($_POST['MatKhauMoi']),
                    );
                    $this->login_model->update_account($data);
                } else {
                    setcookie('doimk', 'Mật khẩu không đúng', time() + 2);
                }
            } else {
                setcookie('doimk', 'Mật khẩu mới không trùng nhau', time() + 2);
            }
        }
        header('location: ?act=taikhoan&xuli=account#doitk');
    }
}