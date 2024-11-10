<?php
require_once 'pdo.php'; // Đảm bảo đường dẫn tới pdo.php là chính xác

class User
{
    public $user_id;
    public $user_email;
    public $user_name;
    public $user_password;
    public $user_phone;
    public $user_role;

    public function __construct($email, $username, $password, $phone = null, $role = 0)
    {
        $this->user_email = $email;
        $this->user_name = $username;
        $this->user_password = $password;
        $this->user_phone = $phone;
        $this->user_role = $role;
    }

    public static function getAll()
    {
        $sql = "SELECT * FROM user ORDER BY user_id DESC";
        return pdo_query($sql);
    }

    public function insert()
    {
        $sql = "INSERT INTO user (user_email, user_name, user_password, user_phone, user_role) VALUES (?, ?, ?, ?, ?)";
        pdo_execute($sql, $this->user_email, $this->user_name, $this->user_password, $this->user_phone, $this->user_role);
    }

    public static function findByCredentials($username, $password)
    {
        $sql = "SELECT * FROM user WHERE user_name = ? AND user_password = ?";
        return pdo_query_one($sql, $username, $password);
    }

    public function update($id, $newPassword = null)
    {
        if ($newPassword) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $sql = "UPDATE user SET user_name = ?, user_password = ?, user_email = ?, user_phone = ? WHERE user_id = ?";
            pdo_execute($sql, $this->user_name, $hashedPassword, $this->user_email, $this->user_phone, $id);
        } else {
            $sql = "UPDATE user SET user_name = ?, user_email = ?, user_phone = ? WHERE user_id = ?";
            pdo_execute($sql, $this->user_name, $this->user_email, $this->user_phone, $id);
        }
    }

    public static function delete($id)
    {
        $sql = "DELETE FROM user WHERE user_id = ?";
        pdo_execute($sql, $id);
    }

    public static function findById($id)
    {
        $sql = "SELECT * FROM user WHERE user_id = ?";
        return pdo_query_one($sql, $id);
    }
}