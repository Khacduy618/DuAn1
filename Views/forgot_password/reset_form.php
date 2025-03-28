<div class="container">
    <h2>Đặt lại mật khẩu</h2>
    <form method="POST" action="index.php?act=forgot_password&xuli=reset_password">
        <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token']); ?>">
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu mới</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu mới" required>
        </div>
        <button type="submit" class="btn btn-primary">Đặt lại mật khẩu</button>
    </form>
</div>
