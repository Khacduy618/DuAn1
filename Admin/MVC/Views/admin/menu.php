<?php
require_once 'MVC/Models/Privilege.php';
$role = $_SESSION['login']['user_role'] ; 
 ?>
<ul class="navbar-nav">
    <li class="nav-item">
        <a href="#" class="nav-link">
            <span class="icon">
                <div class="user">
                    <img src="<?=BASE_URL?>uploaded/<?=$_SESSION['login']['user_images']?>" alt="">
                </div>
            </span>
            <span class="title"><?=$_SESSION['login']['user_name']?></span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="?mod=login">
            <span class="icon">
                <i class="fa-solid fa-house fa-xl"></i>
            </span>
            <span class="title">Dashboard</span>
        </a>
    </li>
    <?php if(($role == 1)|| isset($_SESSION['privilege']['category']) ) {?>
    <li class="nav-item">
        <a class="nav-link" href="?mod=category">
            <span class="icon">
                <i class="fa-solid fa-list fa-xl"></i>
            </span>
            <span class="title">Categories</span>
        </a>
    </li>
    <?php } ?>
    <?php if( ($role == 1)|| isset($_SESSION['privilege']['product'])) {?>
    <li class="nav-item">
        <a class="nav-link" href="?mod=product">
            <span class="icon">
                <i class="fa-solid fa-box fa-xl"></i>
            </span>
            <span class="title">Product</span>
        </a>
    </li>
    <?php } ?>
    <?php if( ($role == 1)|| isset($_SESSION['privilege']['favorite'])) {?>
    <li class="nav-item">
        <a class="nav-link" href="?mod=favorite">
            <span class="icon">
                <i class="fa-solid fa-heart fa-xl"></i>
            </span>
            <span class="title">Favorite</span>
        </a>
    </li>
    <?php } ?>
    <?php if(($role == 1)|| isset($_SESSION['privilege']['coupon'])) {?>
    <li class="nav-item">
        <a class="nav-link" href="?mod=coupon">
            <span class="icon">
                <i class="fa-solid fa-ticket fa-xl"></i>
            </span>
            <span class="title">Coupon</span>
        </a>
    </li>
    <?php } ?>
    <?php if(($role ==1)|| isset($_SESSION['privilege']['blog'])) {?>
    <li class="nav-item">
        <a class="nav-link" href="?mod=blog">
            <span class="icon">
                <i class="fa-solid fa-blog fa-xl"></i>
            </span>
            <span class="title">Blog</span>
        </a>
    </li>
    <?php } ?>
    <?php if(($role == 1)|| isset($_SESSION['privilege']['review'])) {?>
    <li class="nav-item">
        <a class="nav-link" href="?mod=review">
            <span class="icon">
                <i class="fa-solid fa-star fa-xl"></i>
            </span>
            <span class="title">Review</span>
        </a>
    </li>
    <?php } ?>
    <?php if(($role == 1)|| isset($_SESSION['privilege']['bill'])) {?>
    <li class="nav-item">
        <a class="nav-link" href="?mod=bill">
            <span class="icon">
                <i class="fa-solid fa-receipt fa-xl"></i>
            </span>
            <span class="title">Bill</span>
        </a>
    </li>
    <?php } ?>
    <?php if(($role == 1)|| isset($_SESSION['privilege']['user'])) {?>
    <li class="nav-item">
        <a class="nav-link" href="?mod=user">
            <span class="icon">
                <i class="fa-solid fa-users fa-xl"></i>
            </span>
            <span class="title">User</span>
        </a>
    </li>
    <?php } ?>
    <?php if(($role == 1)) {?>
    <li class="nav-item">
        <a class="nav-link" href="?mod=authorization&act=authorization_index">
            <span class="icon">
                <i class="fa-solid fa-user-shield fa-xl"></i>
            </span>
            <span class="title">Authorization</span>
        </a>
    </li>
    <?php } ?>
    <li class="nav-item">
        <a class="nav-link" href="../?mod=login">
            <span class="icon">
                <i class="fa-solid fa-store fa-xl"></i>
            </span>
            <span class="title">SHOP</span>
        </a>
    </li>
</ul>