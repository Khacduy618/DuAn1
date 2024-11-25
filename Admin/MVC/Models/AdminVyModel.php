<?php
require_once 'model.php';

class AdminVyModel
{
    // Lấy danh sách tất cả người dùng kèm địa chỉ
    public function getAllUserWithAddress()
    {
        $sql = "SELECT u.*, a.address_id, a.address_name, a.address_city, a.address_street 
                FROM user u 
                LEFT JOIN address a ON u.user_email = a.address_userEmail 
                WHERE u.user_role != 1";
        return pdo_query($sql);
    }

    // Lấy thông tin một người dùng dựa trên email
    public function getUserByEmail($user_email)
    {
        $sql = "SELECT * FROM user WHERE user_email = ?";
        return pdo_query_one($sql, $user_email);
    }

    // Thêm người dùng
    public function addUser($user_name, $user_full_name, $user_email, $user_password, $user_phone, $user_images)
    {
        // Nếu không có ảnh, để null
        $user_images_path = !empty($user_images) ? "../uploaded/$user_images" : null;

        $sql = "INSERT INTO user (user_name, user_full_name, user_email, user_password, user_phone, user_images, user_role, user_status) 
                VALUES (?, ?, ?, ?, ?, ?, 0, 1)";
        pdo_execute($sql, $user_name, $user_full_name, $user_email, $user_password, $user_phone, $user_images_path);
    }

    // Cập nhật người dùng
    public function updateUser($user_name, $user_email, $user_phone, $user_images, $user_role, $user_status)
    {
        $sql = "UPDATE user SET user_name = ?, user_phone = ?, user_images = ?, user_role = ?, user_status = ? WHERE user_email = ?";
        pdo_execute($sql, $user_name, $user_phone, $user_images, $user_role, $user_status, $user_email);
    }

    // Xóa người dùng
    public function deleteUser($user_email)
    {
        $sql = "UPDATE user SET user_status = 0 WHERE user_email = ?";
        pdo_execute($sql, $user_email);
    }

    // Lấy danh sách địa chỉ của người dùng
    public function getAddressByEmail($user_email)
    {
        $sql = "SELECT * FROM address WHERE address_userEmail = ?";
        return pdo_query($sql, $user_email);
    }

    // Thêm địa chỉ
    public function addAddress($user_email, $address_name, $address_city, $address_street)
    {
        $sql = "INSERT INTO address (address_userEmail, address_name, address_city, address_street, address_status) 
                VALUES (?, ?, ?, ?, 0)";
        pdo_execute($sql, $user_email, $address_name, $address_city, $address_street);
    }

    // Cập nhật địa chỉ
    public function handleImageUpload($user_images, $user_images_tmp)
    {
        $uploads_dir = '../uploaded';
        if (!file_exists($uploads_dir)) {
            mkdir($uploads_dir, 0777, true);
        }

        $user_images_path = "$uploads_dir/$user_images";
        if (move_uploaded_file($user_images_tmp, $user_images_path)) {
            return $user_images;
        } else {
            return '';
        }
    }
    // Cập nhật địa chỉ người dùng
    public function updateAddress(
        $address_id,
        $user_email,
        $address_name,
        $address_city,
        $address_street
    ) {
        if ($address_id) {
            $sql = "UPDATE address SET address_name = ?, address_city = ?, address_street = ? WHERE address_id = ?";
            pdo_execute(
                $sql,
                $address_name,
                $address_city,
                $address_street,
                $address_id
            );
        } else {
            $sql = "INSERT INTO address (user_email, address_name, address_city, address_street) VALUES (?, ?, ?, ?)";
            pdo_execute($sql, $user_email, $address_name, $address_city, $address_street);
        }
    }


    // Xóa địa chỉ theo ID
    public function deleteAddress($address_id)
    {
        $sql = "UPDATE address SET address_status = 1 WHERE address_id = ?";
        pdo_execute($sql, $address_id);
    }

    // Xóa tất cả địa chỉ của một người dùng
    public function deleteAddressByEmail($user_email)
    {
        $sql = "DELETE FROM address WHERE address_userEmail = ?";
        pdo_execute($sql, $user_email);
    }
}