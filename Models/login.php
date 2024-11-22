<?php
require_once("model.php");
class Login extends Model
{
    protected $conn;

    function login_action($user_email, $user_password)
    {
        $query = "SELECT * from user WHERE user_email = ? AND user_password = ? AND user_status = 1";
        
        $login = pdo_query_one($query, $user_email, $user_password);

        if ($login !== NULL) {
            if($login['user_role'] == 1){
                $_SESSION['isLogin_Admin'] = true;
                $_SESSION['login'] = $login;

            header('Location: /DuAn1/Admin');
            } else if($login['user_role'] >= 2){
                $_SESSION['isLogin_Nhanvien'] = true;
                $_SESSION['login'] = $login;

               
            header('Location: /DuAn1/Admin');
            } else {
                $_SESSION['isLogin'] = true;
                $_SESSION['login'] = $login;
                header('Location: ?mod=login');
            }

        } else {
            setcookie('msg1', 'Đăng nhập không thành công', time() + 5);
            header('Location: ?act=taikhoan#dangnhap');
        }
    }
    function logout()
    {
        if(isset($_SESSION['isLogin_Admin'])){
            unset($_SESSION['isLogin_Admin']);
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['isLogin_Nhanvien'])){
            unset($_SESSION['isLogin_Nhanvien']);
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['isLogin'])){
            unset($_SESSION['isLogin']);
            unset($_SESSION['login']);
        }
        header('location: ?act=home');
    }
    function check_account()
    {
        $query =  "SELECT * from user";

        return pdo_query($query);
    }
      function dangky_action($data, $check1, $check2)
    {
        if ($check1 == 0) {
            if ($check2 == 0) {
                $f = "";
                $v = "";
                foreach ($data as $key => $value) {
                    $f .= $key . ",";
                    $v .= "'" . $value . "',";
                }
                $f = trim($f, ",");
                $v = trim($v, ",");
                $query = "INSERT INTO user($f) VALUES ($v);";

                $status = pdo_execute($query);
                if ($status == true) {
                    setcookie('msg', 'Đăng ký thành công', time() + 2);
                } else {
                    setcookie('msg', 'Đăng ký không thành công', time() + 2);
                }
            } else {
                setcookie('msg', 'Mật khẩu không trùng nhau', time() + 2);
            }
        } else {
            setcookie('msg', 'Tên tài khoản hoặc Email  đã tồn tại', time() + 2);
        }
        header('Location: ?act=taikhoan#dangky');
    }
  
}