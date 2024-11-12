<?php
require_once 'pdo.php';

class User
{
    public $user_email;
    public $user_name;
    public $user_password; // Giữ mật khẩu đã mã hóa
    public $user_phone;
    public $user_role;

    public function __construct($email, $username, $password, $phone = null, $role = 0)
    {
        $this->user_email = $email;
        $this->user_name = $username;
        $this->user_password = password_hash($password, PASSWORD_DEFAULT);
        $this->user_phone = $phone;
        $this->user_role = $role;
    }

    public static function getAll()
    {
        $sql = "SELECT * FROM user ORDER BY user_email DESC";
        return pdo_query($sql);
    }

    public function insert()
    {
        // Kiểm tra xem email đã tồn tại chưa
        $existingUser = self::findByEmail($this->user_email);
        if ($existingUser) {
            throw new Exception("Email đã tồn tại. Vui lòng sử dụng email khác.");
        }

        // Nếu email chưa tồn tại, thực hiện chèn mới
        $sql = "INSERT INTO user (user_email, user_name, user_password, user_phone, user_role) VALUES (?, ?, ?, ?, ?)";
        return pdo_execute($sql, $this->user_email, $this->user_name, $this->user_password, $this->user_phone, $this->user_role);
    }

    // Tìm người dùng bằng thông tin đăng nhập
    public static function findByCredentials($username, $password)
    {
        $sql = "SELECT * FROM user WHERE user_email = ?";
        $user = pdo_query_one($sql, $username);

        // Kiểm tra mật khẩu nếu người dùng tồn tại
        if ($user && password_verify($password, $user['user_password'])) {
            return $user;
        }
        return false;
    }


    // Cập nhật thông tin người dùng
    public function update($email, $newPassword = null)
    {
        if ($newPassword) {
            // Mã hóa mật khẩu mới
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $sql = "UPDATE user SET user_name = ?, user_password = ?, user_phone = ?, user_role = ? WHERE user_email = ?";
            pdo_execute($sql, $this->user_name, $hashedPassword, $this->user_phone, $this->user_role, $email);
        } else {
            $sql = "UPDATE user SET user_name = ?, user_phone = ?, user_role = ? WHERE user_email = ?";
            pdo_execute($sql, $this->user_name, $this->user_phone, $this->user_role, $email);
        }
    }

    // Xóa người dùng theo user_email
    public static function delete($email)
    {
        $sql = "DELETE FROM user WHERE user_email = ?";
        pdo_execute($sql, $email);
    }

    // Tìm người dùng bằng user_email
    public static function findById($email)
    {
        $sql = "SELECT * FROM user WHERE user_email = ?";
        return pdo_query_one($sql, $email);
    }

    // Tìm người dùng bằng email
    public static function findByEmail($email)
    {
        $sql = "SELECT * FROM user WHERE user_email = ?";
        return pdo_query_one($sql, $email);
    }
}
