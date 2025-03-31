<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Thiết lập mật khẩu mới</h4>
                </div>
                <div class="card-body">


                    <p>Vui lòng nhập mật khẩu mới của bạn ở dưới.</p>
                    <form action="?act=forgot_password&xuli=update" method="POST">
                        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? ''); ?>">
                        <div class="form-group">
                            <label for="user_password">Mật khẩu mới <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="user_password" name="user_password" required
                                minlength="8">
                            <small class="form-text text-muted">Mật khẩu phải ít nhất 8 kí tự dài.</small>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Xác nhận mật khẩu mới <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                required minlength="8">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                Đặt lại mật khẩu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>