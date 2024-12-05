<?php global $data ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h2>Cập Nhật Thông Tin Tài Khoản</h2>
                </div>
                <div class="card-body">
                    <form action="?act=taikhoan&xuli=update" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="user_name">Tên đăng nhập:</label>
                            <input type="text" name="user_name" class="form-control" value="<?= $data['user_name'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="user_full_name">Họ và Tên:</label>
                            <input type="text" name="user_full_name" class="form-control" value="<?= $data['user_full_name'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="user_phone">Số điện thoại:</label>
                            <input type="text" name="user_phone" class="form-control" value="<?= $data['user_phone'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="address_name">Địa chỉ:</label>
                            <input type="text" name="address_name" class="form-control" value="<?= $data['address_name'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="address_city">Thành phố:</label>
                            <input type="text" name="address_city" class="form-control" value="<?= $data['address_city'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="address_street">Đường:</label>
                            <input type="text" name="address_street" class="form-control" value="<?= $data['address_street'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="user_status">Trạng thái:</label>
                            <select name="user_status" class="form-control">
                                <option value="1" <?= $data['user_status'] == 1 ? 'selected' : '' ?>>Hoạt động</option>
                                <option value="0" <?= $data['user_status'] == 0 ? 'selected' : '' ?>>Vô hiệu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user_images">Ảnh đại diện:</label><br>
                            <img src="<?= $data['user_images'] ?>" alt="User Avatar" class="mb-3" style="width: 150px; height: 150px;">
                            <input type="file" name="user_images" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Cập nhật thông tin</button>
                    </form>

                    <hr>

                    <h3 class="text-center mt-4">Đổi Mật Khẩu</h3>
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