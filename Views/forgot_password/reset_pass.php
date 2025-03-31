<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
    <div class="container">
        <h1 class="page-title">Đặt lại mật khẩu</h1>
    </div>
</div>
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?act=home">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="?act=taikhoan">Tài khoản</a></li>
            <li class="breadcrumb-item active" aria-current="page">Đặt lại mật khẩu</li>
        </ol>
    </div>
</nav>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Quên mật khẩu?</h4>
                </div>
                <div class="card-body">


                    <p>Vui lòng nhập địa chỉ email của bạn. Bạn sẽ nhận được một liên kết để đặt lại mật khẩu.</p>
                    <form action="?act=forgot_password&xuli=request" method="POST">
                        <div class="form-group">
                            <label for="user_email">Địa chỉ email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="user_email" name="user_email" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                Gửi liên kết đặt lại
                            </button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <a href="?act=taikhoan">Quay lại đăng nhập</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>