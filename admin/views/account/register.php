<!-- views/account/register.php -->
<?php include 'views/layouts/header.php'; ?>
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="card p-4" style="width: 100%; max-width: 500px;">
        <h2 class="text-center mb-4">Đăng ký tài khoản</h2>
        <form action="index.php?controller=account&action=register" method="POST">
            <div class="form-group">
                <label for="user_email">Email:</label>
                <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Nhập email của bạn" required>
            </div>
            <div class="form-group">
                <label for="user_name">Tên đăng nhập:</label>
                <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Nhập tên đăng nhập" required>
            </div>
            <div class="form-group">
                <label for="user_password">Mật khẩu:</label>
                <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Nhập mật khẩu" required>
            </div>
            <div class="form-group">
                <label for="user_phone">Số điện thoại:</label>
                <input type="text" name="user_phone" id="user_phone" class="form-control" placeholder="Nhập số điện thoại">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
        </form>
        <p class="text-center mt-3">Đã có tài khoản? <a href="index.php?controller=account&action=login">Đăng nhập</a></p>
    </div>
</div>
<?php include 'views/layouts/footer.php'; ?>