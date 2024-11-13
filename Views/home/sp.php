<?php
if (isset($subcategories_products) && !empty($subcategories_products)) {
    foreach ($subcategories_products as $category_id => $products) {
        if ($products) {
            foreach ($products as $product): ?>
                <div class="product product-2">
                    <figure class="product-media">
                        <span class="product-label label-circle label-new">New</span>
                        <a href="product.html">
                            <img src="assets/site/images/demos/demo-3/products/product-13.jpg"
                                alt="Product image" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                        </div><!-- End .product-action -->

                        <div class="product-action product-action-dark">
                            <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                            <a href="popup/quick_view.php" class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#"><?php echo htmlspecialchars($product['category_name']); ?></a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="#"><?php echo htmlspecialchars($product['product_name']); ?></a></h3><!-- End .product-title -->
                        <div class="product-price">
                            <?php echo htmlspecialchars($product['product_price']); ?>
                        </div><!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 80%;"></div>
                                <!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <span class="ratings-text">( 4 Reviews )</span>
                        </div><!-- End .rating-container -->

                        <div class="product-nav product-nav-dots">
                            <a href="#" style="background: #edd2c8;"><span class="sr-only">Color name</span></a>
                            <a href="#" style="background: #eaeaec;"><span class="sr-only">Color name</span></a>
                            <a href="#" class="active" style="background: #333333;"><span class="sr-only">Color name</span></a>
                        </div><!-- End .product-nav -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->
            <?php endforeach;
        } else {
            echo "<p>Không có sản phẩm nào</p>";
        }
    }
} else {
    echo "<p>Không có danh mục sản phẩm nào</p>";
}
?>
