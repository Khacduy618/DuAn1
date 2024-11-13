<?php
require_once("model.php");
class Login extends Model
{
    protected $conn;

    function login_action($user_email, $user_password)
    {
        $query = "SELECT * from user WHERE user_email = ? AND user_password = ?";
        
        $login = pdo_query_one($query, $user_email, $user_password);

        if ($login !== NULL) {
            if($login['user_role'] == 1){
                $_SESSION['isLogin_Admin'] = true;
                $_SESSION['login'] = $login;
            } else if($login['user_role'] == 2){
                $_SESSION['isLogin_Nhanvien'] = true;
                $_SESSION['login'] = $login;
            } else {
                $_SESSION['isLogin'] = true;
                $_SESSION['login'] = $login;
            }
            setcookie('msg', 'Đăng nhập thành công!', time() + 5);
            header('Location: ?mod=login');
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
                $this->create($data);
                $f = "user_email, user_name, user_password";
                $v = ":email, :name, :password";
                $query = "INSERT INTO $this->table($f) VALUES ($v);";

                $status = pdo_execute($query, [
                    ':email' => $data['email'],
                    ':name' => $data['name'],
                    ':password' => $data['password']
                ]);
                if ($status) {
                    setcookie('msg', 'Đăng ký thành công! Vui lòng đăng nhập.', time() + 5);
                } else {
                    setcookie('msg1', 'Đăng ký không thành công. Vui lòng thử lại!', time() + 5);
                }
            } else {
                setcookie('msg1', 'Mật khẩu xác nhận không khớp', time() + 5);
            }
        } else {
            setcookie('msg1', 'Email đã tồn tại trong hệ thống', time() + 5);
        }
        header('Location: ?act=taikhoan#dangky');
    }
    function account()
    {
        $id = $_SESSION['login']['user_email'];
        return $this->conn->query("SELECT * from user where user_email = $id")->fetch_assoc();
    }
    function update_account($data)
    {
        $v = "";
        foreach ($data as $key => $value) {
            $v .= $key . "='" . $value . "',";
        }
        $v = trim($v, ",");

        $query = "UPDATE user SET  $v   WHERE  user_email = " . $_SESSION['login']['user_email'];

        $result = pdo_execute($query);
        
        if ($result) {
            setcookie('doimk', 'Cập nhật tài khoản thành công', time() + 2);
        } else {
            setcookie('doimk', 'Mật khẩu xác nhận không đúng', time() + 2);
        }
        header('Location: ?act=taikhoan&xuli=account#doitk');
    }
    function error()
    {
        header('location: ?act=errors');
    }
}