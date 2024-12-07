<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/site/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Blog Classic<span>Blog</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">Classic</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">

                    <!-- blog-post -->

                    <?php   
                            if ($blogs_content != null) {
                            foreach ($blogs_content as $blog){        
                    ?>

                    <article class="entry">
                        <figure class="entry-media">
                            <a href="?act=blog_detail&id_blog=<?=$blog['blog_id']?>">
                                <img src="uploaded/<?= $blog['blog_image'] ?>">
                            </a>
                        </figure><!-- End .entry-media -->

                        <div class="entry-body">
                            <div class="entry-meta">
                                <span class="entry-author">
                                    by <a href="#"><?= $blog['author_email'] ?></a>
                                </span>
                            </div><!-- End .entry-meta -->

                            <h2 class="entry-title">
                                <a href="?act=blog_detail&id_blog=<?=$blog['blog_id']?>"><?= $blog['blog_title'] ?></a>
                            </h2><!-- End .entry-title -->

                            <div class="entry-cats">
                                in <a href="#">Lifestyle</a>,
                                <a href="#">Shopping</a>
                            </div><!-- End .entry-cats -->

                            <div class="entry-content">
                                <p>Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget
                                    blandit nunc tortor eu nibh. Suspendisse potenti. Sed egestas, ante et vulputate
                                    volutpat, uctus metus libero eu augue.</p>
                                <a href="single.html" class="read-more">Continue Reading</a>
                            </div><!-- End .entry-content -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->

                    <?php } }
                    ?>

                    <!-- blog-post -->

                    <nav aria-label=" Page navigation">
                        <ul class="pagination">
                            <li
                                class="page-item<?php if (!isset($_GET['page']) || $_GET['page'] == 1): ?> disabled<?php endif; ?>">
                                <a class="page-link page-link-prev"
                                    href="?act=blog&page=<?php echo isset($_GET['page']) && $_GET['page'] > 1 ? $_GET['page'] - 1 : 1; ?>"
                                    aria-label="Previous" tabindex="1"
                                    aria-disabled="<?php echo (!isset($_GET['page']) || $_GET['page'] <= 1) ? 'true' : 'false'; ?>">
                                    <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                                </a>
                            </li>
                            <?php for($i = 1 ; $i <= $totalPages ; $i++ ){  ?>
                            <li class=" page-item active" aria-current="page"><a class="page-link"
                                    href="?act=blog&page=<?=$i?>">
                                    <?=$i?>
                                </a>
                            </li>
                            <?php }?>
                            <li
                                class="page-item<?php if (isset($_GET['page']) && $_GET['page'] >= $totalPages): ?> disabled<?php endif; ?>">
                                <a class="page-link page-link-next"
                                    href="?act=blog&page=<?php echo isset($_GET['page']) ? ($_GET['page'] < $totalPages ? $_GET['page'] + 1 : $totalPages) : 2; ?>"
                                    aria-label="Next" tabindex="1"
                                    aria-disabled="<?php echo (isset($_GET['page']) && $_GET['page'] >= $totalPages) ? 'true' : 'false'; ?>">
                                    <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>Next
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div><!-- End .col-lg-9 -->

                <aside class="col-lg-3">
                    <div class="sidebar">
                        <div class="widget widget-search">
                            <h3 class="widget-title">Search</h3><!-- End .widget-title -->
                            <form action="" method="post">
                                <label for="ws" class="sr-only">Search in blog</label>
                                <input type="search" class="form-control" name="key_word" id="ws"
                                    placeholder="Search in blog" required>
                                <button type="submit" class="btn"><i class="icon-search"></i><span
                                        class="sr-only">Search</span></button>
                            </form>
                        </div><!-- End .widget -->


                        <div class="widget">
                            <h3 class="widget-title">Popular Posts</h3><!-- End .widget-title -->

                            <ul class="posts-list">
                                <?php
                                            foreach($popular_posts as $post) {
                                            echo '<li>
                                            <figure>
                                            <a href="?act=blog_detail&id_blog=' . $post["blog_id"] . '">
                                    <img src="uploaded/' . $post["blog_image"] . '" alt="post">
                                            </a>
                                            </figure>
                                            <div>
                                            <h4><a href="?act=blog_detail&id_blog=' . $post["blog_id"] . '">' . $post["blog_title"] . '</a></h4>
                                            </div>
                                            </li>' ; } ?>
                            </ul><!-- End .posts-list -->
                        </div><!-- End .widget -->




                        <div class="widget widget-text">
                            <h3 class="widget-title">Best Seller Products</h3><!-- End .widget-title -->

                        </div>

                        <?php 
                    if(isset($product_populars) && $product_populars != NULL){
                        foreach($product_populars as $item){
                    
                ?>

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-new">New</span>
                                <a href="?act=product&id=<?=$item['product_id']?>">
                                    <img src="uploaded/<?=$item['product_img']?>" alt="Product image"
                                        class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                            wishlist</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add
                                            to cart</span></a>
                                    <a href="popup/quick_view.php" class="btn-product btn-quickview"
                                        title="Quick view"><span>quick view</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">

                                <h3 class="product-title"><a href="#"><?=$item['product_name'];?> </a></h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    <?=number_format($item['product_price'],0,",",".")?> đ
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 80%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 Reviews )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" style="background: #edd2c8;"><span class="sr-only">Color
                                            name</span></a>
                                    <a href="#" style="background: #eaeaec;"><span class="sr-only">Color
                                            name</span></a>
                                    <a href="#" class="active" style="background: #333333;"><span class="sr-only">Color
                                            name</span></a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                        <?php
            }}else{
            echo "No data found";
            }
            ?>





                    </div><!-- End .sidebar -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->