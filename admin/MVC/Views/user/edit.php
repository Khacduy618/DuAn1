<?php
// Kiểm tra đường dẫn ảnh đại diện
$imgPath = "../uploaded/" . ($user['user_images'] ?? ''); // Xử lý nếu user_images không tồn tại
if (is_file($imgPath) && !empty($user['user_images'])) {
    $user_images_display = "<img src='" . $imgPath . "' height='80' alt='User Image'>";
} else {
    $user_images_display = "<img src='../uploaded/user.png' height='80' alt='Default Image'>"; // Nếu không có ảnh, dùng ảnh mặc định
}
?>

<div class="row">
    <div class="row frmtitle">
        <h1>Update User</h1>
    </div>
    <div class="row frmcontent">
        <form action="?mod=user&act=update" method="post" enctype="multipart/form-data">
            <!-- Hiển thị ảnh đại diện hiện tại -->
            <div class="row mb10">
                <label for="current_user_images">Avatar</label><br>
                <div class="img">
                    <?= $user_images_display ?>
                </div>
            </div>

            <!-- Input ảnh đại diện mới -->
            <div class="row mb10">
                <label for="user_images">Change your avater?</label><br>
                <input type="file" id="user_images" name="user_images" accept="image/*">
            </div>

            <!-- Email (không thể thay đổi) -->
            <div class="row mb10">
                <label for="user_email">Email</label><br>
                <input type="email" id="user_email" name="user_email" value="<?=$user['user_email']?>" readonly>
            </div>
            <!-- Tên đăng nhập -->
            <div class="row mb10">
                <label for="user_name">Full name:</label><br>
                <input type="text" id="user_name" name="user_name" value="<?=$user['user_name']?>" required>
            </div>
            <!-- Số điện thoại -->
            <div class="row mb10">
                <label for="user_phone">Phone Number</label><br>
                <input type="text" id="user_phone" name="user_phone" value="<?=$user['user_phone']?> " required>
            </div>
            <!-- Vai trò -->
            <div class="row mb10">
                <label for="user_role">Role</label><br>
                <div class="form-group">
                    <input class="form-check-input me-1" id="user_role1" type="radio" name="user_role"
                        <?php if (isset($user['user_role']) && $user['user_role']=="0") echo "checked";?> value="0">
                    <label class="form-check-label me-3" for="user_role1">User</label>

                    <input class="form-check-input me-1" id="user_role2" type="radio" name="user_role"
                        <?php if (isset($user['user_role']) && $user['user_role'] =="1") echo "checked";?> value="1">
                    <label class="form-check-label me-3" for="user_role2">Admin</label>

                    <input class="form-check-input me-1" id="user_role3" type="radio" name="user_role"
                        <?php if (isset($user['user_role']) && $user['user_role'] >="2") echo "checked";?> value="2">
                    <label class="form-check-label" for="user_role3">Employee</label>
                </div>
            </div>
            <div class="row mb10">
                <lable for="user_status">Status</lable>
                <div class="form-group">
                    <input class="form-check-input me-1" id="user_status1" type="radio" name="user_status"
                        <?php if (isset($user['user_status']) && $user['user_status']=="1") echo "checked";?> value="1">
                    <label class="form-check-label me-3" for="user_status1">Active</label>

                    <input class="form-check-input me-1" id="user_status2" type="radio" name="user_status"
                        <?php if (isset($user['user_status']) && $user['user_status'] =="0") echo "checked";?>
                        value="0">
                    <label class="form-check-label me-3" for="user_status2">Inactive</label>
                </div>
            </div>

            <!-- Nút cập nhật và hủy -->
            <div class="row mb10">
                <input type="hidden" name="current_user_images"
                    value="<?= htmlspecialchars($user['user_images'] ?? '') ?>">
                <input type="submit" name="submit" value="CẬP NHẬT">
                <button type="button" onclick="window.location.href='index.php?act=listuser'">HỦY</button>
            </div>
        </form>
    </div>
</div>