<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Set New Password</h4>
                </div>
                <div class="card-body">


                    <p>Please enter your new password below.</p>
                    <form action="?act=forgot_password&xuli=update" method="POST">
                        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? ''); ?>">
                        <div class="form-group">
                            <label for="user_password">New Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="user_password" name="user_password" required
                                minlength="8">
                            <small class="form-text text-muted">Password must be at least 8 characters long</small>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm New Password <span
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