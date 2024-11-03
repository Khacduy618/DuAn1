<!-- views/account/login.php -->
<?php include 'views/layouts/header.php'; ?>
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="card p-4" style="width: 100%; max-width: 400px;">
        <h2 class="text-center mb-4">Đăng nhập</h2>
        <?php if (isset($error)): ?>
            <p class="text-danger text-center"><?= $error ?></p>
        <?php endif; ?>
        <form action="index.php?controller=account&action=login" method="POST">
            <div class="form-group">
                <label for="user_name">Tên đăng nhập</label>
                <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Nhập tên đăng nhập" required>
            </div>
            <div class="form-group">
                <label for="user_password">Mật khẩu</label>
                <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Nhập mật khẩu" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
        </form>
        <p class="text-center mt-3">Chưa có tài khoản? <a href="index.php?controller=account&action=register">Đăng ký</a></p>
    </div>
</div>
<?php include 'views/layouts/footer.php'; ?>