<!-- menu -->
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo BASE_URL ?>/Login/dashboard">Admin Cpanel</a>
        </div>
        <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo BASE_URL ?>">Trang Chủ</a></li>

        <li><a href="<?php echo BASE_URL ?>/In4">Thông Tin website</a></li>    

        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Danh mục Bài Viết
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="<?php echo BASE_URL ?>/Post">Thêm</a></li>
                <li><a href="<?php echo BASE_URL ?>/Post/list_category">Liệt Kê</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Bài Viết
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="<?php echo BASE_URL ?>/Post/add_post">Thêm</a></li>
                <li><a href="<?php echo BASE_URL ?>/Post/list_post">Liệt Kê</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Danh mục Sản Phẩm
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="<?php echo BASE_URL ?>/Product">Thêm</a></li>
                <li><a href="<?php echo BASE_URL ?>/Product/list_category">Liệt Kê</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Sản Phẩm
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="<?php echo BASE_URL ?>/Product/add_product">Thêm</a></li>
                <li><a href="<?php echo BASE_URL ?>/Product/list_product">Liệt Kê</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Đơn Hàng
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="<?php echo BASE_URL ?>/Order/add_order">Thêm</a></li>
                <li><a href="<?php echo BASE_URL ?>/Order">Liệt Kê</a></li>
            </ul>
        </li>
        

        </ul>
    </div>
</nav>
<!-- menu end-->