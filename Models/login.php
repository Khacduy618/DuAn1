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
            if ($login['user_role'] == 1) {
                $_SESSION['isLogin_Admin'] = true;
                $_SESSION['login'] = $login;

                header('Location: /DuAn1/Admin');
            } else if ($login['user_role'] >= 2) {
                $_SESSION['isLogin_Nhanvien'] = true;
                $_SESSION['login'] = $login;


                header('Location: /DuAn1/Admin');
            } else {
                $_SESSION['isLogin'] = true;
                $_SESSION['login'] = $login;
                header('Location: ?mod=login');
            }

        } else {
            setcookie('msg1', 'Email or Password is incorrect', time() + 5);
            header('Location: ?act=taikhoan#dangnhap');
        }
    }
    function logout()
    {
        if (isset($_SESSION['isLogin_Admin'])) {
            unset($_SESSION['isLogin_Admin']);
            unset($_SESSION['login']);
        }
        if (isset($_SESSION['isLogin_Nhanvien'])) {
            unset($_SESSION['isLogin_Nhanvien']);
            unset($_SESSION['login']);
        }
        if (isset($_SESSION['isLogin'])) {
            unset($_SESSION['isLogin']);
            unset($_SESSION['login']);
        }
        header('location: ?act=home');
    }
    function check_account()
    {
        $query = "SELECT * from user";

        return pdo_query($query);
    }

    function saveResetToken($email, $token, $expires)
    {
        $query = "UPDATE user SET reset_token = ?, reset_token_expires = ? WHERE user_email = ?";
        pdo_execute($query, $token, $expires, $email);
    }

    function validateResetToken($token)
    {
        $query = "SELECT user_email FROM user WHERE reset_token = ? AND reset_token_expires > NOW()";
        return pdo_query_one($query, $token);
    }

    function updatePassword($email, $password)
    {
        $query = "UPDATE user SET user_password = ? WHERE user_email = ?";
        pdo_execute($query, $password, $email);
    }

    function clearResetToken($email)
    {
        $query = "UPDATE user SET reset_token = NULL, reset_token_expires = NULL WHERE user_email = ?";
        pdo_execute($query, $email);
    }
    function dangky_action($data, $check1, $check2, $check3)
    {
        if ($check1 == 0) {
            if ($check3 == 0) {
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
                        setcookie('msg', 'Register successfully', time() + 2);
                    } else {
                        setcookie('msg1', 'Register failed', time() + 2);
                    }
                } else {
                    setcookie('msg1', 'Password is not match', time() + 2);
                }

            } else {
                setcookie('msg1', 'Password must be at least 8 characters long', time() + 2);
            }
        } else {
            setcookie('msg1', 'Username or Email already exists', time() + 2);
        }
        header('Location: ?act=taikhoan#dangky');
    }

    function account($user_email)
    {
        $query = "SELECT u.*, a.address_name, a.address_city, a.address_street
              FROM user u
              LEFT JOIN address a ON u.user_email = a.address_userEmail
              WHERE u.user_email = ?";
        return pdo_query_one($query, $user_email);
    }
    public function checkEmail($email)
    {
        $query = "SELECT * FROM user WHERE user_email = ?";
        return pdo_query_one($query, $email);
    }
    public function dangky_google($google_id, $user_name, $user_full_name, $user_email, $user_images, $user_password)
    {
        $query = "INSERT INTO user (google_id, user_name, user_full_name, user_email, user_images, user_password) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        return pdo_execute($query, $google_id, $user_name, $user_full_name, $user_email, $user_images, $user_password);
    }
    function update_account($data, $address_data, $user_email)
    {
        // Cập nhật thông tin user
        if (!empty($data)) {
            $fields = "";
            foreach ($data as $key => $value) {
                $fields .= "$key = '$value',";
            }
            $fields = trim($fields, ",");
            $query = "UPDATE user SET $fields WHERE user_email = ?";
            pdo_execute($query, $user_email);
        }

        // Cập nhật thông tin địa chỉ
        if (!empty($address_data)) {
            // Kiểm tra xem có địa chỉ nào tồn tại với user_email này không
            $check_address_query = "SELECT * FROM address WHERE address_userEmail = ?";
            $existing_address = pdo_query_one($check_address_query, $user_email);

            if ($existing_address) {
                // Nếu địa chỉ đã tồn tại, thực hiện cập nhật
                $address_fields = "";
                foreach ($address_data as $key => $value) {
                    $address_fields .= "$key = '$value',";
                }
                $address_fields = trim($address_fields, ",");
                $query = "UPDATE address SET $address_fields WHERE address_userEmail = ?";
                pdo_execute($query, $user_email);
            } else {
                // Nếu địa chỉ chưa tồn tại, thực hiện thêm mới
                $address_data['address_userEmail'] = $user_email;
                $fields = implode(",", array_keys($address_data));
                $values = implode("','", array_values($address_data));
                $query = "INSERT INTO address ($fields) VALUES ('$values')";
                pdo_execute($query);
            }
        }

        // Thông báo kết quả
        setcookie('msg', 'Update successfully', time() + 2);
    }
}