<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
    <div class="container">
        <h1 class="page-title">Login</h1>
    </div><!-- End .container -->
</div><!-- End .page-header -->
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?act=login">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Login</li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->
<!-- login content section start -->
<div class="container mt-4">
    <?php if(isset($_COOKIE['msg'])): ?>
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        <strong><?php echo htmlspecialchars($_COOKIE['msg']); ?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <?php if(isset($_COOKIE['msg1'])): ?>
    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        <strong><?php echo htmlspecialchars($_COOKIE['msg1']); ?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>
</div>
<div class="modal-content">
    <div class="modal-body">
        <div class="form-box">
            <div class="form-tab">
                <ul class="nav nav-pills nav-fill nav-border-anim" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab"
                            aria-controls="signin" aria-selected="true">Sign In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab"
                            aria-controls="register" aria-selected="false">Register</a>
                    </li>
                </ul>
                <div class="tab-content" id="tab-content-5">
                    <!-- Sign In Tab -->
                    <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                        <form action="?act=taikhoan&xuli=dangnhap" method="POST">
                            <div class="form-group">
                                <label for="signin-username">Email *</label>
                                <input type="text" class="form-control" id="signin-username" name="user_email" required>
                            </div>
                            <div class="form-group">
                                <label for="signin-password">Password *</label>
                                <input type="password" class="form-control" id="signin-password" name="user_password"
                                    required>
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-outline-primary-2">
                                    <span>LOG IN</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="signin-remember"
                                        name="remember_me">
                                    <label class="custom-control-label" for="signin-remember">Remember
                                        Me</label>
                                </div>
                                <a href="index.php?controller=account&action=forgotPassword" class="forgot-link">Forgot
                                    Your Password?</a>
                            </div>
                        </form>
                        <div class="form-choice">
                            <p class="text-center">or sign in with</p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="#" class="btn btn-login btn-g">
                                        <i class="icon-google"></i>Login With Google
                                    </a>
                                </div><!-- End .col-6 -->
                                <div class="col-sm-6">
                                    <a href="#" class="btn btn-login btn-f">
                                        <i class="icon-facebook-f"></i>Login With Facebook
                                    </a>
                                </div><!-- End .col-6 -->
                            </div><!-- End .row -->
                        </div><!-- End .form-choice -->
                    </div><!-- .End .tab-pane -->

                    <!-- Register Tab -->
                    <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                        <?php if(isset($_SESSION['error_messages'])): ?>
                        <?php foreach($_SESSION['error_messages'] as $field => $message): ?>
                        <div class="alert alert-danger">
                            <?php echo htmlspecialchars($message); ?>
                        </div>
                        <?php endforeach; ?>
                        <?php unset($_SESSION['error_messages']); ?>
                        <?php endif; ?>

                        <?php if(isset($_SESSION['success_message'])): ?>
                        <div class="alert alert-success">
                            <?php 
                            echo htmlspecialchars($_SESSION['success_message']);
                            unset($_SESSION['success_message']); 
                        ?>
                        </div>
                        <?php endif; ?>

                        <form action="?act=taikhoan&xuli=dangky" method="POST">
                            <div class="form-group">
                                <label for="register-email">Your email address *</label>
                                <input type="email" class="form-control" name="user_email" required>
                            </div>
                            <div class="form-group">
                                <label for="register-username">Username *</label>
                                <input type="text" class="form-control" name="user_name" required>
                            </div>
                            <div class="form-group">
                                <label for="register-password">Password *</label>
                                <input type="password" class="form-control" name="user_password" required>
                            </div>
                            <div class="form-group">
                                <label for="register-confirm-password">Confirm Password *</label>
                                <input type="password" class="form-control" name="check_password" required>
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-outline-primary-2">
                                    <span>SIGN UP</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>
                            </div>
                        </form>
                        <div class="form-choice">
                            <p class="text-center">or sign in with</p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="#" class="btn btn-login btn-g">
                                        <i class="icon-google"></i>Login With Google
                                    </a>
                                </div><!-- End .col-6 -->
                                <div class="col-sm-6">
                                    <a href="#" class="btn btn-login btn-f">
                                        <i class="icon-facebook-f"></i>Login With Facebook
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .form-tab -->
        </div><!-- End .form-box -->
    </div><!-- End .modal-body -->
</div><!-- End .modal-content -->