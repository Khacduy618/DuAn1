<!-- menu -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo BASE_URL ?>/Login/dashboard">Admin Cpanel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo BASE_URL ?>">Trang Chủ</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL ?>/In4">Thông Tin website</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Danh mục Bài Viết
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo BASE_URL ?>/Post">Thêm</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL ?>/Post/list_category">Liệt Kê</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPost" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Bài Viết
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownPost">
                        <li><a class="dropdown-item" href="<?php echo BASE_URL ?>/Post/add_post">Thêm</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL ?>/Post/list_post">Liệt Kê</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProductCategory" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Danh mục Sản Phẩm
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownProductCategory">
                        <li><a class="dropdown-item" href="?act=adminLong&ctlr=AdminLongController&method=add_category">Thêm</a></li>
                        <li><a class="dropdown-item" href="?act=adminLong&ctlr=AdminLongController&method=list_category">Liệt Kê</a></li>
                        
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProduct" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Sản Phẩm
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownProduct">
                        <li><a class="dropdown-item" href="?act=adminLong&ctlr=AdminLongController&method=add_product">Thêm</a></li>
                        <li><a class="dropdown-item" href="?act=adminLong&ctlr=AdminLongController&method=list_product">Liệt Kê</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownOrder" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Đơn Hàng
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownOrder">
                        <li><a class="dropdown-item" href="<?php echo BASE_URL ?>/Order/add_order">Thêm</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL ?>/Order">Liệt Kê</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Xin Chào: <?= Session::get('username') ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownUser">
                        <li><a class="dropdown-item" href="?act=adminLong&ctlr=AdminLongController&method=logOut">Logout</a></li>
                        <li><a class="dropdown-item" href="?act=adminLong&ctlr=AdminLongController&method=proFile">Quản Lý Tài Khoản</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- menu end-->
