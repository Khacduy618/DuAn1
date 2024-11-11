<?php include 'views/header_footer/header.php'; ?>

<div class="container mt-5">
    <?php if ($account === null): ?>
        <div class="alert alert-danger">Tài khoản không tồn tại.</div>
    <?php else: ?>
        <h1 class="mb-4 text-center">Chỉnh sửa tài khoản</h1>
        <form action="index.php?controller=account&action=edit" method="post" class="form-edit-account">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($account['user_id']); ?>">

            <div class="mb-3">
                <label for="user_email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="user_email" name="user_email" value="<?php echo htmlspecialchars($account['user_email']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="user_name" class="form-label">Tên đăng nhập:</label>
                <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo htmlspecialchars($account['user_name']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="user_password" class="form-label">Mật khẩu mới (để trống nếu không muốn thay đổi):</label>
                <input type="password" class="form-control" id="user_password" name="user_password">
            </div>

            <div class="mb-3">
                <label for="user_phone" class="form-label">Số điện thoại:</label>
                <input type="text" class="form-control" id="user_phone" name="user_phone" value="<?php echo htmlspecialchars($account['user_phone']); ?>">
            </div>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="index.php?controller=account&action=index" class="btn btn-secondary">Hủy</a>
            </div>
        </form>
    <?php endif; ?>
</div>