<div class="container">
    <h2>Đặt lại mật khẩu</h2>
    
    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error']; ?>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>
    
    <form method="POST" action="index.php?act=forgot_password&xuli=reset_password">
        <input type="hidden" name="token" value="<?= $data['token'] ?>">
        
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu mới</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Đặt lại mật khẩu</button>
    </form>
</div>