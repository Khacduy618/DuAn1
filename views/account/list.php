<!-- views/account/list.php -->
<?php include 'views/layouts/header.php'; ?>
<div class="container mt-5">
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['message'];
            unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <h1 class="text-center mb-4">Danh sách tài khoản</h1>

    <form action="index.php?controller=account&action=bulkAction" method="post">
        <div class="d-flex justify-content-between mb-3">
            <div>
                <button type="submit" name="action" value="select_all" class="btn btn-secondary">Chọn tất cả</button>
                <button type="submit" name="action" value="deselect_all" class="btn btn-warning">Bỏ chọn tất cả</button>
                <button type="submit" name="action" value="delete_selected" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa các mục đã chọn?')">Xóa các mục đã chọn</button>
            </div>
            <div>
                <a href="index.php?controller=account&action=register" class="btn btn-primary">Nhập thêm</a>
                <a href="index.php?controller=account&action=logout" class="btn btn-dark">Đăng Xuất</a>
            </div>
        </div>

        <table class="table table-striped table-hover align-middle">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"><input type="checkbox" name="select_all"></th>
                    <th scope="col">ID</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tên đăng nhập</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($accounts) && is_array($accounts)) : ?>
                    <?php $selectAll = isset($_GET['select_all']) && $_GET['select_all'] == 1; ?>
                    <?php foreach ($accounts as $account) : ?>
                        <tr>
                            <td><input type="checkbox" name="selected_ids[]" value="<?php echo $account['user_id']; ?>" <?php echo $selectAll ? 'checked' : ''; ?>></td>
                            <td><?php echo htmlspecialchars($account['user_id']); ?></td>
                            <td><?php echo htmlspecialchars($account['user_email']); ?></td>
                            <td><?php echo htmlspecialchars($account['user_name']); ?></td>
                            <td><?php echo htmlspecialchars($account['user_phone']); ?></td>
                            <td>
                                <a href="index.php?controller=account&action=edit&id=<?php echo $account['user_id']; ?>" class="btn btn-sm btn-info">Sửa</a>
                                <a href="index.php?controller=account&action=delete&id=<?php echo $account['user_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" class="text-center">Không có tài khoản nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </form>
</div>
<?php include 'views/layouts/footer.php'; ?>