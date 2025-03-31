<!-- filepath: c:\xampp\htdocs\DuAn1 2\DuAn1\Views\product\product.php -->
<?php

if($data != NULL){
    require_once "Models/reviews.php";
    $reviewModel = new Review();
    $product_id = $data['product_id']; 
    
    // Sử dụng phương thức giống như trong ShopController để lấy dữ liệu
    $allReviews = $reviewModel->getAllProductReviews();
    
    // Xử lý dữ liệu theo cách tương tự như trong trang list-products
    $reviewCount = 0;
    $rating = 0;
    
    foreach ($allReviews as $review) {
        if ($review['product_id'] == $product_id) {
            if (!isset($reviewCount)) {
                $reviewCount = 0;
            }
            $reviewCount++;
            
            if (!isset($ratingSum)) {
                $ratingSum = 0;
            }
            $ratingSum += $review['rating'];
        }
    }
    
    // Tính trung bình điểm đánh giá - không làm tròn để giữ nhất quán với list-products
    if ($reviewCount > 0) {
        $rating = $ratingSum / $reviewCount;
    }
    
    // Debug - có thể xóa sau khi sửa xong
    echo "<!-- Rating: $rating, Count: $reviewCount -->";
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
                    <div class="d-flex justify-content-center align-items-center">
                            <figure class="product-main-image">
                                <img id="product-zoom" src="uploaded/<?=$data['product_img']?>"
                                    data-zoom-image="uploaded/<?=$data['product_img']?>" alt="product image">
                            </figure><!-- End .product-main-image -->
                    </div><!-- End .product-gallery -->
                </div><!-- End .col-md-6 -->

                <div class="col-md-6">
                    <div class="product-details">
                        <h1 class="product-title"><?=$data['product_name']?></h1><!-- End .product-title -->

                        <div class="ratings-container">
                            <div class="ratings">
                                <!-- Sử dụng công thức giống như trong list-products.php -->
                                <div class="ratings-val" style="width: <?= ($rating * 20) ?>%;"></div>
                            </div>
                            <span class="ratings-text">( <?= $reviewCount ?> Reviews )</span>
                        </div>
                        <div class="product-price">
                            <?=number_format($data['product_price'],0,",",".")?> đ
                        </div><!-- End .product-price -->

                        <div class="product-content">
                            <p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero
                                eu augue. Morbi purus libero, faucibus adipiscing. Sed lectus. </p>
                        </div><!-- End .product-content -->

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
                                </div><!-- End .details-action-wrapper -->
                            </div><!-- End .product-details-action -->
                        </form>
                        <div class="product-details-footer">

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