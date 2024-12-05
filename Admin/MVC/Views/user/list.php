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
            <a href="?mod=user&act=add" class="btn btn-success <?=!isset($_SESSION['privilege']['user']['add']) ? 'disabled' : ''?>">Add New User</a>
        </div>
    </div>

    <div class="row frmcontent">
        <form action="?act=deleteSelected" method="post" id="userForm">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>AVARTA</th>
                            <th>USER NAME</th>
                            <th>EMAIL</th>
                            <th>PHONE NUMBER</th>
                            <th>STATUS</th>
                            <!-- <th>ROLES</th> -->
                            <th>ADDRESS</th>
                            <th>ACTION</th>
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
                                $url_email = "?mod=address&act=list&user_email=".$user_email;
                                
                                $user_status_display = ($user_status == 1) ? 'Active' : 'Inactive';
                                $user_role_display = $user_role == 0 ? 'User' : ($user_role == 1 ? 'Admin' : 'Employee');
                                ?>
                                <tr>
                                    <td><?= $images ?></td>
                                    <td><?= $user_name ?></td>
                                    <td><?= $user_email ?></td>
                                    <td><?= $user_phone ?></td>
                                    <td><?= $user_status_display ?></td>
                                    <td>
                                            <a href="<?= $url_email ?>" class="btn btn-info" <?= !isset($_SESSION['privilege']['address']['list']) ? disabled : ''?>>DETAIL</a>
                                    </td>
                                    <td>
                                        
                                            <a href="<?= $edituser ?>" class="btn btn-warning <?=!isset($_SESSION['privilege']['user']['edit']) ? 'disabled' : ''?>">UPDATE</a>
                                        
                                        <a href="<?= $deleteuser ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này không?')"  class="btn btn-danger <?=!isset($_SESSION['privilege']['user']['delete']) ? 'disabled' : ''?>">DELETE
                                        </a>
                                        
                                    </td>
                                </tr>
                            <?php
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