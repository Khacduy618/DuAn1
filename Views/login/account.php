<div class="container">
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Cập Nhật Thông Tin Tài Khoản</h2>
                </div>
                <div class="card-body">
                    <form action="?act=taikhoan&xuli=update" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="user_name">Tên đăng nhập:</label>
                            <input type="text" name="user_name" class="form-control" value="<?= isset($data['user_name']) ? $data['user_name'] : '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="user_phone">Số điện thoại:</label>
                            <input type="text" name="user_phone" class="form-control" value="<?= isset($data['user_phone']) ? $data['user_phone'] : '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="address_name">Tên địa chỉ:</label>
                            <input type="text" name="address_name" class="form-control" value="<?= isset($data['address_name']) ? $data['address_name'] : '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="address_city">Thành phố:</label>
                            <input type="text" name="address_city" class="form-control" value="<?= isset($data['address_city']) ? $data['address_city'] : '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="address_street">Đường:</label>
                            <input type="text" name="address_street" class="form-control" value="<?= isset($data['address_street']) ? $data['address_street'] : '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="user_images">Ảnh đại diện:</label><br>
                            <img src="<?= isset($data['user_images']) ? UPLOAD_DIR.$data['user_images'] : 'path/to/default/image.jpg' ?>" alt="User Avatar" class="mb-3" style="width: 150px; height: 150px;">
                            <input type="file" name="user_images" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Cập nhật thông tin</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Đổi Mật Khẩu</h3>
                </div>
                <div class="card-body">
                    <form action="?act=taikhoan&xuli=update" method="POST">
                        <div class="form-group">
                            <label for="MatKhau">Mật khẩu hiện tại:</label>
                            <input type="password" name="MatKhau" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="MatKhauMoi">Mật khẩu mới:</label>
                            <input type="password" name="MatKhauMoi" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="MatKhauXN">Xác nhận mật khẩu mới:</label>
                            <input type="password" name="MatKhauXN" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-warning btn-block">Đổi mật khẩu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>