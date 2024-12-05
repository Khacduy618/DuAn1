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

    function account($user_email)
    {
        $query = "SELECT u.*, a.*, i.user_images 
              FROM user u
              LEFT JOIN address a ON u.user_email = a.address_userEmail
              LEFT JOIN user_images i ON u.user_id = i.user_id
              WHERE u.user_email = ?";
        return pdo_query_one($query, $user_email);
    }
    function update_account($data, $address_data, $user_email)
    {
        // Cập nhật thông tin user
        $fields = "";
        foreach ($data as $key => $value) {
            $fields .= "$key = '$value',";
        }
        $fields = trim($fields, ",");
        $query = "UPDATE user SET $fields WHERE user_email = ?";
        pdo_execute($query, $user_email);

        // Cập nhật thông tin địa chỉ
        $address_fields = "";
        foreach ($address_data as $key => $value) {
            $address_fields .= "$key = '$value',";
        }
        $address_fields = trim($address_fields, ",");
        $query = "UPDATE address SET $address_fields WHERE address_userEmail = ?";
        pdo_execute($query, $user_email);

        // Thông báo kết quả
        setcookie('msg', 'Cập nhật thành công', time() + 2);
    }
}