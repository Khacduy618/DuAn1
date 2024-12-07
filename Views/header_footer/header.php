<header class="header header-intro-clearance header-3">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <a href="tel:#"><i class="icon-phone"></i>Call: +0123 456 789</a>
            </div><!-- End .header-left -->

            <div class="header-right">

                <ul class="top-menu">
                    <li>
                        <a href="#">Links</a>
                        <ul>
                            <li>
                                <div class="header-dropdown">
                                    <a href="#">USD</a>
                                    <div class="header-menu">
                                        <ul>
                                            <li><a href="#">Eur</a></li>
                                            <li><a href="#">Usd</a></li>
                                        </ul>
                                    </div><!-- End .header-menu -->
                                </div>
                            </li>
                            <li>
                                <div class="header-dropdown">
                                    <a href="#">English</a>
                                    <div class="header-menu">
                                        <ul>
                                            <li><a href="#">English</a></li>
                                            <li><a href="#">French</a></li>
                                            <li><a href="#">Spanish</a></li>
                                        </ul>
                                    </div><!-- End .header-menu -->
                                </div>
                            </li>
                            <?php
                                if (isset($_SESSION['login'])) {
                            ?>
                            <li>
                                <div class="header-dropdown">
                                    <a class="row align-items-center">
                                        <div class="avatar">
                                            <img src="<?= UPLOAD_DIR.$_SESSION['login']['user_images'] ?>"
                                                alt="User Avatar">
                                        </div>
                                        <strong><span><?= $_SESSION['login']['user_name'] ?></span></strong>
                                    </a>
                                    <div class="header-menu">
                                        <ul>
                                            <li><a href="?act=taikhoan&xuli=account">Tài khoản</a></li>
                                            </li>
                                            <?php
                                                if(isset($_SESSION['isLogin_Admin']) || isset($_SESSION['isLogin_Nhanvien'])){
                                                    echo '<li><a href="Admin/?mod=login">Trang quản lý</a></li>';
                                                }
                                            ?>
                                            <li><a href="?act=taikhoan&xuli=dangxuat">Đăng xuất</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <?php } else { ?>
                            <li><a href="?act=taikhoan">Sign in / Sign up</a></li>
                            <?php } ?>

                        </ul>
                    </li>
                </ul><!-- End .top-menu -->
            </div><!-- End .header-right -->

        </div><!-- End .container -->
    </div><!-- End .header-top -->

    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>

                <a href="?act=home" class="logo">
                    <img src="uploaded/logo500x500.png" alt="Tede Logo" width="105" height="25">
                </a>
            </div><!-- End .header-left -->

            <div class="header-center">
                <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                    <form action="" method="GET">
                        <div class="header-search-wrapper search-wrapper-wide">
                            <label for="q" class="sr-only">Search</label>
                            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                            <input type="hidden" name="act" value="shop">
                            <input type="search" class="form-control" name="keyword" id="q"
                                placeholder="Search product ..." required>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->
            </div>

            <div class="header-right">
                <div class="dropdown compare-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" data-display="static" title="Compare Products"
                        aria-label="Compare Products">
                        <div class="icon">
                            <i class="icon-random"></i>
                        </div>
                        <p>Compare</p>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <ul class="compare-products">
                            <li class="compare-product">
                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                <h4 class="compare-product-title"><a href="product.html">Blue Night Dress</a></h4>
                            </li>
                            <li class="compare-product">
                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                <h4 class="compare-product-title"><a href="product.html">White Long Skirt</a></h4>
                            </li>
                        </ul>

                        <div class="compare-actions">
                            <a href="#" class="action-link">Clear All</a>
                            <a href="#" class="btn btn-outline-primary-2"><span>Compare</span><i
                                    class="icon-long-arrow-right"></i></a>
                        </div>
                    </div><!-- End .dropdown-menu -->
                </div><!-- End .compare-dropdown -->

                <div class="wishlist">
                    <a href="wishlist.html" title="Wishlist">
                        <div class="icon">
                            <i class="icon-heart-o"></i>
                            <span class="wishlist-count badge">3</span>
                        </div>
                        <p>Wishlist</p>
                    </a>
                </div><!-- End .compare-dropdown -->

                <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" data-display="static">
                        <div class="icon">
                            <i class="icon-shopping-cart"></i>
                            <?php
                            if(isset($_SESSION['login'])) {
                                require_once 'Models/cart.php';
                                $cart = new Cart();
                                $cartItems = $cart->getCartItems($_SESSION['login']['user_email']);
                                $cartCount = count($cartItems);
                            ?>
                            <span class="cart-count"><?= $cartCount ?></span>
                            <?php } else { ?>
                            <span class="cart-count">0</span>
                            <?php } ?>
                        </div>
                        <p>Cart</p>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-cart-products">
                            <?php 
                            if(isset($_SESSION['login']) && !empty($cartItems)) {
                                $total = 0;
                                foreach($cartItems as $item) {
                                    $subtotal = $item['product_price'] * $item['quantity'];
                                    $total += $subtotal;
                            ?>
                            <div class="product">
                                <div class="product-cart-details">
                                    <h4 class="product-title">
                                        <a href="?act=product&id=<?=$item['pro_id']?>"><?=$item['product_name']?></a>
                                    </h4>

                                    <span class="cart-product-info">
                                        <span class="cart-product-qty"><?=$item['quantity']?></span>
                                        x <?=number_format($item['product_price'],0,",",".")?> đ
                                    </span>
                                </div>

                                <figure class="product-image-container">
                                    <a href="?act=product&id=<?=$item['pro_id']?>" class="product-image">
                                        <img src="uploaded/<?=$item['product_img']?>" alt="<?=$item['product_name']?>">
                                    </a>
                                </figure>
                                <a href="?act=cart&xuli=delete&product_id=<?=$item['pro_id']?>" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                            </div>
                            <?php
                                }
                            } else {
                            ?>
                            <div class="text-center p-3">No products in cart</div>
                            <?php } ?>
                        </div>

                        <div class="dropdown-cart-total">
                            <span>Total</span>
                            <span class="cart-total-price">
                                <?php 
                                if(isset($total)) {
                                    echo number_format($total,0,",",".") . ' đ';
                                } else {
                                    echo '0 đ';
                                }
                                ?>
                            </span>
                        </div>

                        <div class="dropdown-cart-action">
                            <?php if (isset($_SESSION['login'])) { ?>
                            <a href="?act=checkout&xuli=order_history" class="btn btn-outline-primary-2">Your Order
                            </a>
                            <?php } else { ?>
                            <a class="btn disabled">
                            </a>
                            <?php } ?>

                            <a href="?act=cart" class="btn btn-outline-primary-2 ms-auto">View Cart</a>
                        </div>
                    </div>
                </div>
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->

    <div class="header-bottom sticky-header">
        <div class="container">
            <div class="header-left">
                <div class="dropdown category-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" data-display="static" title="Browse Categories">
                        Browse Categories <i class="icon-angle-down"></i>
                    </a>

                    <div class="dropdown-menu">
                        <nav class="side-nav">
                            <ul class="category-menu">
                                <?php
                                require_once 'Controllers/CategoryController.php';
                                $category = new CategoryController();
                                echo $category->list_cat_home();
                            ?>
                            </ul>
                        </nav>
                    </div>
                </div><!-- End .category-dropdown -->
            </div><!-- End .header-left -->

            <div class="header-center">
                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        <li>
                            <a href="?act=home">Home</a>
                        </li>
                        <li>
                            <a href="?act=shop" class="sf-with-ul">Shop</a>
                        </li>
                        <li>
                            <a href="?act=about">About Us</a>

                        </li>
                        <li>
                            <a href="?act=contact">Contact</a>
                        </li>
                        <li>
                            <a href="?act=blog">Blog</a>
                        </li>
                    </ul><!-- End .menu -->
                </nav><!-- End .main-nav -->
            </div><!-- End .header-center -->

            <div class="header-right">
                <i class="la la-lightbulb-o"></i>
                <p>Clearance<span class="highlight">&nbsp;Up to 30% Off</span></p>
            </div>
        </div><!-- End .container -->
    </div><!-- End .header-bottom -->
</header><!-- End .header -->