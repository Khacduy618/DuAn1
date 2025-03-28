<?php
require_once("model.php");

class AuthModel extends Model
{
    public function checkEmailExists($email)
    {
        $query = "SELECT * FROM user WHERE user_email = ?";
        return pdo_query_one($query, $email) !== false;
    }

    public function storeResetToken($email, $token)
    {
        $query = "UPDATE user SET reset_token = ?, token_expiry = NOW() + INTERVAL 1 HOUR WHERE user_email = ?";
        pdo_execute($query, $token, $email);
    }

    public function isValidToken($token)
    {
        $query = "SELECT * FROM user WHERE reset_token = ? AND token_expiry > NOW()";
        return pdo_query_one($query, $token);
    }

    public function updatePassword($token, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $query = "UPDATE user SET password = ?, reset_token = NULL, token_expiry = NULL WHERE reset_token = ?";
        return pdo_execute($query, $hashedPassword, $token);
    }
}
