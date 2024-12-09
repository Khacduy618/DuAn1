<div class="row">
    <div class="row frmtitle">
        <h1>User Management</h1>
    </div>
    <div class="row mb-3 gap-3 justify-content-around">
        <!-- Search -->
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" 
                       name="search" 
                       value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" 
                       placeholder="Search customer..."
                       onchange="this.form.submit()"
                       form="searchForm">
            </div>
            <form id="searchForm" action="" method="GET">
                <input type="hidden" name="mod" value="user">
                <input type="hidden" name="act" value="list">
                <?php if (isset($_GET['status'])): ?>
                    <input type="hidden" name="status" value="<?= htmlspecialchars($_GET['status']) ?>">
                <?php endif; ?>
            </form>
        </div>


        <!-- Status Filter -->
        <div class="col-md-2">
            <select class="form-select" onchange="filterStatus(this.value)">
                <option value="">All Status</option>
                <option value="1" <?= isset($_GET['status']) && $_GET['status'] == '1' ? 'selected' : '' ?>>Active</option>
                <option value="0" <?= isset($_GET['status']) && $_GET['status'] == '0' ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>


        <div class="col-2 ms-auto">
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
                                $user_images = empty($user_images) ? 'user.png' : $user_images;
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
                                            <a href="<?= $url_email ?>" class="btn btn-info" <?= !isset($_SESSION['privilege']['address']['list']) ? 'disabled' : ''?>>DETAIL</a>
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
 <!-- Pagination -->
 <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php if ($pagination['current_page'] > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?mod=user&act=list&page=<?= $pagination['current_page'] - 1 ?><?= isset($_GET['search']) ? '&search=' . htmlspecialchars($_GET['search']) : '' ?>" aria-label="Previous">&laquo;</a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                        <li class="page-item <?= $i == $pagination['current_page'] ? 'active' : '' ?>">
                            <a class="page-link" href="?mod=user&act=list&page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($pagination['current_page'] < $pagination['total_pages']): ?>
                        <li class="page-item">
                            <a class="page-link" href="?mod=user&act=list&page=<?= $pagination['current_page'] + 1 ?>" aria-label="Next">&raquo;</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script>
function filterStatus(status) {
    const url = new URL(window.location.href);
    if (status) {
        url.searchParams.set('status', status);
    } else {
        url.searchParams.delete('status');
    }
    url.searchParams.set('page', '1');
    window.location.href = url.toString();
}
</script>