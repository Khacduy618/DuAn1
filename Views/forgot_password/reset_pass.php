<div class="container">
    <h2>Quên mật khẩu</h2>
    <form method="POST" action="index.php?act=forgot_password&xuli=send_reset_link">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email của bạn" required>
        </div>
        <button type="submit" class="btn btn-primary">Gửi liên kết đặt lại mật khẩu</button>
    </form>
</div>
