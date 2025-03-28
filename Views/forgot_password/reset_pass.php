<div class="container">
    <h2>Quên mật khẩu</h2>
    
    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error']; ?>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>
    
    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success']; ?>
            <?php unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>
    
    <form method="POST" action="index.php?act=forgot_password&xuli=send_reset_link">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email của bạn" required>
        </div>
        <button type="submit" class="btn btn-primary">Gửi liên kết đặt lại mật khẩu</button>
    </form>
    
    <p class="mt-3">
        <a href="index.php?act=taikhoan&xuli=login">Quay lại đăng nhập</a>
    </p>
</div>