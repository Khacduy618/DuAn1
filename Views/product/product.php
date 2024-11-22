<?php
    if($data != NULL){
?>
<nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
    <div class="container d-flex align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?act=home">Home</a></li>
            <li class="breadcrumb-item"><a
                    href="?act=shop&product_cat=<?=$data['product_cat']?>"><?=$data['category_name']?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?=$data['product_name']?></li>
        </ol>

        <nav class="product-pager ml-auto" aria-label="Product">
            <?php
                if($data['product_id'] > 6){
            ?><a class="product-pager-link product-pager-prev" href="?act=product&id=<?=$data['product_id']-1?>"
                aria-label="Previous" tabindex="-1">
                <i class="icon-angle-left"></i>
                <span>Prev</span>
            </a>
            <?php
            }
            ?>

            <a class="product-pager-link product-pager-next" href="?act=product&id=<?=$data['product_id']+1?>"
                aria-label="Next" tabindex="-1">
                <span>Next</span>
                <i class="icon-angle-right"></i>
            </a>
        </nav><!-- End .pager-nav -->
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->

<div class="page-content">
    <div class="container">
        <div class="product-details-top">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-gallery product-gallery-vertical">
                        <div class="row">
                            <figure class="product-main-image">
                                <img id="product-zoom" src="uploaded/<?=$data['product_img']?>"
                                    data-zoom-image="uploaded/<?=$data['product_img']?>" alt="product image">

                                <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                    <i class="icon-arrows"></i>
                                </a>
                            </figure><!-- End .product-main-image -->

                            <div id="product-zoom-gallery" class="product-image-gallery">
                                <a class="product-gallery-item active" href="#"
                                    data-image="uploaded/<?=$data['product_img']?>"
                                    data-zoom-image="uploaded/<?=$data['product_img']?>">
                                    <img src="uploaded/<?=$data['product_img']?>" alt="product side">
                                </a>

                                <a class="product-gallery-item" href="#" data-image="uploaded/<?=$data['product_img']?>"
                                    data-zoom-image="uploaded/<?=$data['product_img']?>">
                                    <img src="uploaded/<?=$data['product_img']?>" alt="product cross">
                                </a>

                                <a class="product-gallery-item" href="#" data-image="uploaded/<?=$data['product_img']?>"
                                    data-zoom-image="uploaded/<?=$data['product_img']?>">
                                    <img src="uploaded/<?=$data['product_img']?>" alt="product with model">
                                </a>

                                <a class="product-gallery-item" href="#" data-image="uploaded/<?=$data['product_img']?>"
                                    data-zoom-image="uploaded/<?=$data['product_img']?>">
                                    <img src="uploaded/<?=$data['product_img']?>" alt="product back">
                                </a>
                            </div><!-- End .product-image-gallery -->
                        </div><!-- End .row -->
                    </div><!-- End .product-gallery -->
                </div><!-- End .col-md-6 -->

                <div class="col-md-6">
                    <div class="product-details">
                        <h1 class="product-title"><?=$data['product_name']?></h1><!-- End .product-title -->

                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                        </div><!-- End .rating-container -->

                        <div class="product-price">
                            <?=number_format($data['product_price'],0,",",".")?> đ
                        </div><!-- End .product-price -->

                        <div class="product-content">
                            <p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero
                                eu augue. Morbi purus libero, faucibus adipiscing. Sed lectus. </p>
                        </div><!-- End .product-content -->

                        <div class="details-filter-row details-row-size">
                            <label>Color:</label>

                            <div class="product-nav product-nav-thumbs">
                                <a href="#" class="active">
                                    <img src="uploaded/<?=$data['product_img']?>" alt="product desc">
                                </a>
                                <a href="#">
                                    <img src="uploaded/<?=$data['product_img']?>" alt="product desc">
                                </a>
                            </div><!-- End .product-nav -->
                        </div><!-- End .details-filter-row -->

                        <div class="details-filter-row details-row-size">
                            <label for="size">Size:</label>
                            <div class="select-custom">
                                <select name="size" id="size" class="form-control">
                                    <option value="#" selected="selected">Select a size</option>
                                    <option value="s">Small</option>
                                    <option value="m">Medium</option>
                                    <option value="l">Large</option>
                                    <option value="xl">Extra Large</option>
                                </select>
                            </div><!-- End .select-custom -->

                            <a href="#" class="size-guide"><i class="icon-th-list"></i>size guide</a>
                        </div><!-- End .details-filter-row -->
                        <form action="index.php" method="GET">
                            <div class="details-filter-row details-row-size">
                                <label for="qty">Qty:</label>
                                <div class="product-details-quantity">
                                    <input type="hidden" name="act" value="cart">
                                    <input type="hidden" name="xuli" value="add">
                                    <input type="hidden" name="product_id" value="<?=$data['product_id']?>">
                                    <input type="number" id="qty" name="quantity" class="form-control" value="1" min="1"
                                        max="10" step="1" required>
                                </div><!-- End .product-details-quantity -->
                            </div><!-- End .details-filter-row -->

                            <div class="product-details-action">
                                <button type="submit" class="btn-product btn-cart"><span>add to cart</span></button>

                                <div class="details-action-wrapper">
                                    <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Add to
                                            Wishlist</span></a>
                                    <a href="#" class="btn-product btn-compare" title="Compare"><span>Add to
                                            Compare</span></a>
                                </div><!-- End .details-action-wrapper -->
                            </div><!-- End .product-details-action -->
                        </form>
                        <div class="product-details-footer">
                            <div class="product-cat">
                                <span>Category:</span>
                                <a href="#">Women</a>,
                                <a href="#">Dresses</a>,
                                <a href="#">Yellow</a>
                            </div><!-- End .product-cat -->

                            <div class="social-icons social-icons-sm">
                                <span class="social-label">Share:</span>
                                <a href="#" class="social-icon" title="Facebook" target="_blank"><i
                                        class="icon-facebook-f"></i></a>
                                <a href="#" class="social-icon" title="Twitter" target="_blank"><i
                                        class="icon-twitter"></i></a>
                                <a href="#" class="social-icon" title="Instagram" target="_blank"><i
                                        class="icon-instagram"></i></a>
                                <a href="#" class="social-icon" title="Pinterest" target="_blank"><i
                                        class="icon-pinterest"></i></a>
                            </div>
                        </div><!-- End .product-details-footer -->
                    </div><!-- End .product-details -->
                </div><!-- End .col-md-6 -->
            </div><!-- End .row -->
        </div><!-- End .product-details-top -->

        <div class="product-details-tab">
            <?php require_once 'product_details.php' ?>
        </div><!-- End .product-details-tab -->

        <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->

        <?php require_once 'product_related.php' ?>
    </div><!-- End .container -->
</div><!-- End .page-content -->
<?php } else {
    require_once("Views/error-404.php");
} ?>