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
        <a class="nav-link" href="../trangchinh/">
            <span class="icon">
                <ion-icon name="home-outline"></ion-icon>
            </span>
            <span class="title">Trang chủ</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="?mod=category">
            <span class="icon">
                <ion-icon name="list-circle-outline"></ion-icon>
            </span>
            <span class="title">Categories</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="?mod=product">
            <span class="icon">
                <ion-icon name="pricetags-outline"></ion-icon>
            </span>
            <span class="title">Product</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="?mod=comment">
            <span class="icon">
                <i class="fa-regular fa-comment fa-xl"></i>
            </span>
            <span class="title">Comment</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?mod=review">
            <span class="icon">
                <ion-icon name="albums-outline"></ion-icon>
            </span>
            <span class="title">Review</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="?mod=bill">
            <span class="icon">
                <i class="fa-solid fa-bag-shopping fa-xl"></i>
            </span>
            <span class="title">Bill</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="?mod=user">
            <span class="icon">
                <ion-icon name="people-outline"></ion-icon>
            </span>
            <span class="title">User</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="?mod=role">
            <span class="icon">
                <ion-icon name="accessibility-outline"></ion-icon>
            </span>
            <span class="title">Role</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="?mod=analytics">
            <span class="icon">
                <i class="fa-solid fa-square-poll-vertical fa-xl"></i>
            </span>
            <span class="title">Analytics</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../?mod=login">
            <span class="icon">
                <ion-icon name="log-out-outline"></ion-icon>
            </span>
            <span class="title">SHOP</span>
        </a>
    </li>
</ul>