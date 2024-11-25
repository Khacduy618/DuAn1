<?php
$imgPath = "../uploaded/" . ($user['user_images'] ?? '');
$user_images_display = (is_file($imgPath) && !empty($user['user_images']))
    ? $imgPath
    : "../uploaded/user.png";
?>

<div class="row">
    <div class="row frmtitle">
        <h1>Update User Information</h1>
    </div>

    <!-- Form cập nhật -->
    <div class="row mb-4 frmcontent">
        <form action="?mod=user&act=update" method="post" enctype="multipart/form-data" class="p-3">
            <div class="d-flex align-items-start mb-4" style="gap: 1rem;">
                <div>
                    <img src="<?= $user_images_display ?>" alt="User Image" id="user_image_preview"
                        style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px; border: 2px solid #ddd;">
                </div>
                <div class="d-flex flex-column justify-content-end" style="height: 99px;">
                    <button type="button" class="btn btn-outline-primary btn-sm shadow-sm"
                        onclick="document.getElementById('user_images').click();">
                        Tải ảnh mới lên
                    </button>
                </div>

            </div>

            <!-- File input ẩn -->
            <input type="file" id="user_images" name="user_images" accept="image/*" class="d-none"
                onchange="updateImagePreview(event)">

            <!-- Các trường thông tin -->
            <div class="mb-3">
                <label for="user_name" class="form-label fw-bold">Full Name</label>
                <input type="text" id="user_name" name="user_name" class="form-control shadow-sm"
                    value="<?= $user['user_name'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="user_email" class="form-label fw-bold">Email</label>
                <input type="email" id="user_email" name="user_email" class="form-control shadow-sm bg-light"
                    value="<?= $user['user_email'] ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="user_phone" class="form-label fw-bold">Phone Number</label>
                <input type="text" id="user_phone" name="user_phone" class="form-control shadow-sm"
                    value="<?= $user['user_phone'] ?>" required>
            </div>

            <!-- Hiển thị địa chỉ nếu có -->
            <div class="mb-3">
                <label for="address_name" class="form-label fw-bold">Address</label>
                <input type="text" id="address_name" name="address_name" class="form-control shadow-sm"
                    value="<?= !empty($address) ? $address[0]['address_name'] : '' ?>" required>
            </div>

            <div class="mb-3">
                <label for="address_street" class="form-label fw-bold">Street</label>
                <input type="text" id="address_street" name="address_street" class="form-control shadow-sm"
                    value="<?= !empty($address) ? $address[0]['address_street'] : '' ?>" required>
            </div>

            <?php
            $provinces = [
                'Hà Nội',
                'Hồ Chí Minh',
                'Đà Nẵng',
                'Cần Thơ',
                'An Giang',
                'Bà Rịa - Vũng Tàu',
                'Bắc Giang',
                'Bắc Kạn',
                'Bạc Liêu',
                'Bắc Ninh',
                'Bến Tre',
                'Bình Dương',
                'Bình Định',
                'Bình Phước',
                'Bình Thuận',
                'Cao Bằng',
                'Cà Mau',
                'Cần Thơ',
                'Đắk Lắk',
                'Đắk Nông',
                'Điện Biên',
                'Đồng Nai',
                'Đồng Tháp',
                'Gia Lai',
                'Hà Giang',
                'Hà Nam',
                'Hải Dương',
                'Hải Phòng',
                'Hậu Giang',
                'Hòa Bình',
                'Hưng Yên',
                'Khánh Hòa',
                'Kiên Giang',
                'Kon Tum',
                'Lai Châu',
                'Lâm Đồng',
                'Lạng Sơn',
                'Lào Cai',
                'Long An',
                'Nam Định',
                'Nghệ An',
                'Ninh Bình',
                'Ninh Thuận',
                'Phú Thọ',
                'Phú Yên',
                'Quảng Bình',
                'Quảng Nam',
                'Quảng Ngãi',
                'Quảng Ninh',
                'Quảng Trị',
                'Sóc Trăng',
                'Sơn La',
                'Tây Ninh',
                'Thái Bình',
                'Thái Nguyên',
                'Thanh Hóa',
                'Thừa Thiên Huế',
                'Tiền Giang',
                'Trà Vinh',
                'Tuyên Quang',
                'Vĩnh Long',
                'Vĩnh Phúc',
                'Yên Bái'
            ];
            ?>
            <div class="mb-3">
                <label for="address_city" class="form-label fw-bold">City</label>
                <select id="address_city" name="address_city" class="form-select shadow-sm" required>
                    <option value="">Choose</option>
                    <?php foreach ($provinces as $province): ?>
                    <?php
                        $selected = (!empty($address) && $address[0]['address_city'] == $province) ? 'selected' : '';
                        ?>
                    <option value="<?= $province ?>" <?= $selected ?>><?= $province ?></option>
                    <?php endforeach; ?>
                </select>
            </div>


            <div class="mb-3">
                <label for="user_role" class="form-label fw-bold">Role</label>
                <select id="user_role" name="user_role" class="form-select shadow-sm">
                    <option value="0" <?= $user['user_role'] == "0" ? "selected" : "" ?>>User</option>
                    <option value="1" <?= $user['user_role'] == "1" ? "selected" : "" ?>>Admin</option>
                    <option value="2" <?= $user['user_role'] == "2" ? "selected" : "" ?>>Employee</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="user_status" class="form-label fw-bold">Status</label>
                <select id="user_status" name="user_status" class="form-select shadow-sm">
                    <option value="1" <?= $user['user_status'] == "1" ? "selected" : "" ?>>Active</option>
                    <option value="0" <?= $user['user_status'] == "0" ? "selected" : "" ?>>Inactive</option>
                </select>
            </div>

            <!-- Nút hành động -->
            <div class="mt-4">
                <button type="submit" class="btn btn-success px-4 py-2 shadow">Update</button>
                <a href="?mod=user&act=list" class="btn btn-outline-secondary px-4 py-2 shadow ms-2">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
function updateImagePreview(event) {
    const input = event.target;
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('user_image_preview').src = e.target.result;
    };
    if (input.files[0]) {
        reader.readAsDataURL(input.files[0]);
    }
}
</script>