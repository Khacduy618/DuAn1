<div class="row">
    <div class="row frmtitle">
        <h1>User Management</h1>
    </div>
    <div class="row mb-3  justify-content-around">
        <div class="col-md-3">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" v-model="searchQuery" placeholder="Search customer...">
            </div>
        </div>
        <div class="col-md-2">
            <select class="form-select" v-model="roleFilter">
                <option value="">All Roles</option>
                <option value="0">User</option>
                <option value="1">Admin</option>
                <option value="2">Employee</option>
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-select" v-model="statusFilter">
                <option value="">All Status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <div class="col-md-1">
            <select class="form-select" v-model="sortBy">
                <option value="">Sort by</option>
                <option value="id">ID</option>
                <option value="name">Name</option>
            </select>
        </div>

        <div class="col-md-3 d-flex gap-3 align-items-center">
            <div class="btn-group">
                <button class="btn" onclick="viewMode = 'list'">
                    <i class="bi bi-list"></i>
                </button>
                <button class="btn" onclick="viewMode = 'grid'">
                    <i class="bi bi-grid"></i>
                </button>
            </div>
            <button type="submit" class="btn btn-danger" onclick="return confirmDeletion()">Delete All</button>
            <a href="?mod=user&act=add" class="btn btn-success">Add New User</a>
        </div>
    </div>

    <div class="row frmcontent">
        <form action="?act=deleteSelected" method="post" id="userForm">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="selectAll"></th>
                            <th>ẢNH ĐẠI DIỆN</th>
                            <th>TÊN ĐĂNG NHẬP</th>
                            <th>EMAIL</th>
                            <th>ĐIỆN THOẠI</th>
                            <th>ĐỊA CHỈ</th> <!-- Cột địa chỉ -->
                            <th>TRẠNG THÁI (1)</th>
                            <th>TRẠNG THÁI (2)</th>
                            <th>VAI TRÒ</th>
                            <th>THAO TÁC</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($listuser)) {
                            foreach ($listuser as $user) {
                                extract($user);
                                $edituser = "?mod=user&act=edit&user_email=" . $user_email;
                                $deleteuser = "?mod=user&act=delete&user_email=" . $user_email;
                                $images = "<img src='../uploaded/" . $user_images . "' alt='User Image' width='50'>";

                                // Xử lý địa chỉ
                                $address_name = $user['address_name'] ?? '';
                                $address_street = $user['address_street'] ?? '';
                                $address_city = $user['address_city'] ?? '';
                                $address_display = ($address_name . ', ' . $address_street . ', ' . $address_city . ', ');

                                $user_status_display = ($user_status == 1) ? 'Hiện' : 'Ẩn';
                                $address_status_display = isset($address_status) ? (($address_status == 0) ? 'User' : 'Wait') : 'Không rõ';
                                $user_role_display = $user_role == 0 ? 'User' : ($user_role == 1 ? 'Admin' : 'Employee');

                                echo '<tr>
                                        <td><input type="checkbox" name="user_email[]" value="' . $user_email . '"></td>
                                        <td>' . $images . '</td>
                                        <td>' . $user_name . '</td>
                                        <td>' . $user_email . '</td>
                                        <td>' . $user_phone . '</td>
                                        <td>' . $address_display . '</td> <!-- Hiển thị địa chỉ -->
                                        <td>' . $user_status_display . '</td>
                                        <td>' . $address_status_display . '</td>
                                        <td>' . $user_role_display . '</td>
                                    <td>
                                <a href="' . $edituser . '"><button type="button" class="button-item bg-warning">SỬA</button></a>
                                <a href="' . $deleteuser . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa tài khoản này không?\')">
                                    <button class="button-item bg-danger" type="button">XÓA</button>
                                </a>
                            </td>
                        </tr>';
                            }
                        } else {
                            echo "<tr><td colspan='10'>Không có người dùng nào.</td></tr>";
                        }

                        ?>

                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

<script>
// Tự động chọn tất cả checkbox khi click "selectAll"
document.getElementById('selectAll').addEventListener('change', function() {
    const isChecked = this.checked;
    document.querySelectorAll('input[name="user_email[]"]').forEach(cb => cb.checked = isChecked);
});

// Kiểm tra nếu người dùng đã chọn ít nhất một tài khoản để xóa
function confirmDeletion() {
    const selectedUsers = document.querySelectorAll('input[name="user_email[]"]:checked');
    if (selectedUsers.length === 0) {
        alert('Vui lòng chọn ít nhất một tài khoản để xóa!');
        return false;
    }
    return confirm('Bạn có chắc chắn muốn xóa các tài khoản đã chọn không?');
}
</script>