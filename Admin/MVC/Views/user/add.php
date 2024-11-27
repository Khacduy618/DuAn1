<div class="row">
    <div class="row frmtitle">
        <h1>Add User Information</h1>
    </div>

    <form action="?mod=user&act=store" method="POST" enctype="multipart/form-data" class="p-3">
        <div class="d-flex align-items-start mb-4" style="gap: 1rem;">
            <div>
                <img
                    src="../uploaded/user.png"
                    alt="User Image"
                    id="user_image_preview"
                    class="border"
                    style="width: 110px; height: 110px; object-fit: cover;">
            </div>
            <!-- Nút tải ảnh mới lên -->
            <div class="d-flex flex-column justify-content-end" style="height: 109px;">
                <button
                    type="button"
                    class="btn btn-outline-primary btn-sm shadow-sm"
                    onclick="document.getElementById('user_images').click();">
                    <i class="fas fa-upload"></i> Upload New Image
                </button>
            </div>
        </div>

        <input
            type="file"
            id="user_images"
            name="user_images"
            accept="image/*"
            class="d-none"
            onchange="updateImagePreview(event)">

        <!-- Các trường thông tin -->
        <div class="mb-3">
            <label for="user_email" class="form-label fw-bold">Email</label>
            <input
                type="email"
                name="user_email"
                id="user_email"
                class="form-control shadow-sm"
                required>
        </div>

        <div class="mb-3">
            <label for="user_name" class="form-label fw-bold">Tên đăng nhập</label>
            <input
                type="text"
                name="user_name"
                id="user_name"
                class="form-control shadow-sm"
                required>
        </div>

        <div class="mb-3">
            <label for="user_full_name" class="form-label fw-bold">Họ và tên</label>
            <input
                type="text"
                name="user_full_name"
                id="user_full_name"
                class="form-control shadow-sm"
                required>
        </div>

        <div class="mb-3">
            <label for="user_password" class="form-label fw-bold">Mật khẩu</label>
            <input
                type="password"
                name="user_password"
                id="user_password"
                class="form-control shadow-sm"
                required>
        </div>

        <div class="mb-3">
            <label for="user_phone" class="form-label fw-bold">Điện thoại</label>
            <input
                type="text"
                name="user_phone"
                id="user_phone"
                class="form-control shadow-sm"
                required>
        </div>

        <div class="mb-3">
            <label for="user_role" class="form-label fw-bold">Quyền</label>
            <select name="user_role" id="user_role" class="form-select shadow-sm">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <!-- Các trường thông tin địa chỉ -->
        <div class="mb-3">
            <label for="address_name" class="form-label fw-bold">Tên địa chỉ</label>
            <input
                type="text"
                name="address_name"
                id="address_name"
                class="form-control shadow-sm"
                placeholder="Nhập tên địa chỉ (VD: Nhà riêng)"
                required>
        </div>

        <div class="mb-3">
            <label for="address_city" class="form-label fw-bold">Thành phố</label>
            <select name="address_city" id="address_city" class="form-select shadow-sm" required>
                <option value="">Loading...</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="address_street" class="form-label fw-bold">Đường phố</label>
            <input
                type="text"
                name="address_street"
                id="address_street"
                class="form-control shadow-sm"
                placeholder="Nhập tên đường phố"
                required>
        </div>

        <div class="mb-3">
            <label for="address_status" class="form-label fw-bold">Trạng thái địa chỉ</label>
            <select name="address_status" id="address_status" class="form-select shadow-sm">
                <option value="0">Chưa xác nhận</option>
                <option value="1">Đã xác nhận</option>
            </select>
        </div>

        <!-- Nút gửi -->
        <div class="mt-4">
            <button type="submit" name="submit" class="btn btn-success px-4 py-2 shadow">Thêm Người Dùng</button>
            <a href="?mod=user&act=list" class="btn btn-outline-secondary px-4 py-2 shadow ms-2">Cancel</a>
        </div>
    </form>
</div>

<script>
    // Cập nhật hình ảnh xem trước
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

    // Tải danh sách thành phố từ API
    document.addEventListener('DOMContentLoaded', function() {
        const citySelect = document.getElementById('address_city');
        fetch('https://provinces.open-api.vn/api/')
            .then(response => response.json())
            .then(data => {
                citySelect.innerHTML = '<option value="">Chọn thành phố</option>';
                data.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.code; // Thay bằng mã code để nhất quán
                    option.textContent = city.name;
                    citySelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Lỗi tải danh sách thành phố:', error);
                citySelect.innerHTML = '<option value="">Không thể tải dữ liệu</option>';
            });
    });
</script>