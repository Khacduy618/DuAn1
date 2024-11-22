<div class="row">
    <div class="row frmtitle">
        <h1>DANH SÁCH TÀI KHOẢN</h1>
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
                <option v-for="role in uniqueRoles" value="role">
                </option>
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-select" v-model="statusFilter">
                <option value="">All Status</option>
                <option value="true">Available</option>
                <option value="false">Unavailable</option>
            </select>
        </div>
        <div class="col-md-1">
            <select class="form-select" v-model="sortBy">
                <option value="">Sort by</option>
                <option value="id">Sort by id</option>
                <option value="name">Sort by Name</option>
            </select>
        </div>

        <div class="col-md-3 d-flex gap-3 align-items-center">
            <div class="btn-group">
                <button class="btn" class="" onclick="viewMode = 'list'">
                    icon
                </button>
                <button class="btn" class="me-1" onclick="viewMode = 'grid'">
                    icon
                </button>

            </div>
            <button type="submit" class="btn btn-danger" onclick="return confirmDeletion()">Delete All</button>
            <a href="?act=adduser" class="btn btn-success">Add new user</a>
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
                            <th>VAI TRÒ</th>
                            <th>TRẠNG THÁI</th>
                            <th>THAO TÁC</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    // Kiểm tra nếu danh sách người dùng không rỗng
                    if (!empty($listuser)) {
                        foreach ($listuser as $user) {
                            extract($user);
                            $edituser = "?mod=user&act=edit&user_email=" . $user_email;
                            $deleteuser = "?mod=user&act=delete&user_email=" . $user_email;
                            // Xử lý đường dẫn ảnh đã được sửa trong controller
                            $images = "<img src='../uploaded/" . $user_images . "' alt='User Image' width='50'>";
                            // Kiểm tra trạng thái người dùng (Hiện/Ẩn)
                            $user_status = ($user_status == 1) ? 'Hiện' : 'Ẩn';

                            echo '<tr>
                                <td><input type="checkbox" name="user_email[]" value="' . $user_email . '"></td>
                                <td>' . $images . '</td>
                                
                                <td>' . $user_name . '</td>
                                <td>' . $user_email . '</td>
                                <td>' . $user_phone . '</td>
                                <td>' . ($user_role == 0 ? 'User' : ($user_role == 1 ?  'Admin' : 'Employee')) . '</td>
                                <td>' . $user_status . '</td>
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

// Hàm chọn tất cả checkbox
function selectAllCheckboxes() {
    document.querySelectorAll('input[name="user_email[]"]').forEach(cb => cb.checked = true);
}

// Hàm bỏ chọn tất cả checkbox
function deselectAllCheckboxes() {
    document.querySelectorAll('input[name="user_email[]"]').forEach(cb => cb.checked = false);
}

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