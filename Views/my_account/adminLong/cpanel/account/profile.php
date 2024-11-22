<style>
.div-avata img {
    width: 120px;
    height: 140px;
    border: 1px solid #030303;
    border-radius: 5px;
}
</style>
<?php
Session::checkSession();
extract($data[0]);
?>
<div class="card">
    <div class="card-header alert alert-primary" style="background-color: var(--danger);">
        Đổi Thông Tin Tài Khoản
    </div>
    
    <div class="card-body"> 
        <div class="row">
            <div class="col-4">
                <div class="text-center justify-content-center align-items-center div-avata">
                    <img src="<?= BASE_URL?>/uploaded/<?=$user_images?>"> <br> <!-- /assets/upload/user_imgs/ bản không team -->
                </div> 
            </div>
            <div class="col-8">
                <form action="?act=adminLong&ctlr=AdminLongController&method=proFileEdit" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <p>Tên Đăng Nhập</p>
                        <input class="form-control" name="user_name" value="<?=$user_name?>" placeholder="Tên Đăng Nhập" required>
                    </div>
                    <div class="form-group mb-3">
                        <p>Họ và tên</p>
                        <input class="form-control" name="user_full_name" value="<?=$user_full_name?>"  placeholder="Họ và tên" required>
                    </div>
                    <div class="form-group mb-3">
                        <p>Địa chỉ email</p>
                        <input class="form-control" type="email" name="user_email" value="<?=$user_email?>" readonly placeholder="Địa chỉ email" required>
                    </div>
                    <div class="form-group mb-3">
                        <input class="form-control" type="file" name="up_images" placeholder="Chọn ảnh" required>
                    </div>
                    <div class="form-group mb-3">
                        <?php if (!empty($msg)): ?>
                            <div class="alert alert-success">
                                <?= htmlspecialchars($msg) ?>
                            </div>
                        <?php endif; ?>
                        <button class="btn btn-dark" name="btn_update">Cập nhật</button>
                        <a class="btn btn-dark" href="?act=home">Về Trang Chủ</a>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>

