<?php 
    require_once 'model.php';
    class AdminVyModel 
        {
            
           
            // Lấy toàn bộ người dùng
            public function getAllUser()
            {
                $sql = " SELECT * FROM user "; 
                return pdo_query($sql);
            }

            
            // Lấy thông tin người dùng theo email
            public function getUserByEmail($user_email)
            {
                $sql = "SELECT * FROM user WHERE user_email = ?";
                return pdo_query_one($sql,$user_email);
            }

            // Cập nhật thông tin người dùng
            public function updateUser($user_name, $user_email, $user_phone, $user_images, $user_images_tmp, $user_role, $user_status)
            {
                // Kiểm tra và xử lý upload ảnh
                if (!empty($user_images) && !empty($user_images_tmp)) {
                    $uploads_dir = '../uploaded'; // Đường dẫn lưu ảnh
                    $user_images_path = "$uploads_dir/$user_images"; // Đường dẫn đầy đủ cho ảnh
                    move_uploaded_file($user_images_tmp, $user_images_path); // Di chuyển file ảnh
                } else {
                    // Nếu không có ảnh mới, giữ nguyên ảnh cũ
                    $user_images_path = $user_images;
                }
                $sql = "UPDATE user SET  user_name = '".$user_name."', user_phone = '".$user_phone."', user_images = '".$user_images."', user_role = '".$user_role."', user_status = '".$user_status."' WHERE user_email = ?";
                pdo_execute($sql, $user_email);
            }


            // Xóa người dùng
            public function deleteUser($user_email)
            {
                $sql = "UPDATE user SET user_status = 0 WHERE user_email = ?";
                pdo_execute($sql, $user_email);
            }
    }
?>