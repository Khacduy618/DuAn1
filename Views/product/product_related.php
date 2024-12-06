<div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "480": {
                                    "items":2
                                },
                                "768": {
                                    "items":3
                                },
                                "992": {
                                    "items":4
                                },
                                "1200": {
                                    "items":4,
                                    "nav": true,
                                    "dots": false
                                }
                            }
                        }'>
    <?php
    if(count($related) > 0){
        foreach($related as $data) {
            extract($data);
    ?>
    <div class="product product-7 text-center">
        <figure class="product-media">
        <?php 
            // Kiểm tra sản phẩm có được tạo trong vòng 1 tháng không
            $created_date = strtotime($created_at);
            $one_month_ago = strtotime('-1 month');
            if ($created_date >= $one_month_ago) { 
            ?>
                <span class="product-label label-new">New</span>
            <?php } ?>
            <a <?php if ($product_status != 0 && $product_count != 0) { ?> href="?act=product&id=<?=$product_id?>"  <?php } ?>  >
                <div class="product-image">
                <img src="uploaded/<?=$product_img?>" alt="Product image">
                </div>    
           
            </a>
            <?php if ($product_status == 1 && $product_count > 0) { ?>
            <div class="product-action-vertical">
                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                        wishlist</span></a>
            </div><!-- End .product-action-vertical -->
            
            <div class="product-action">
                <a href="?act=cart&xuli=add&product_id=<?=$product_id?>&quantity=1" class="btn-product btn-cart"><span>add to cart</span></a>
            </div><!-- End .product-action -->
            <?php } ?>
        </figure><!-- End .product-media -->

        <div class="product-body">
            <div class="product-cat">
                <a href="?act=shop&product_cat=<?=$category_id?>"><?=$category_name?></a>
            </div><!-- End .product-cat -->
            <h3 class="product-title"><a <?php if ($product_status != 0 && $product_count != 0) { ?> href="?act=product&id=<?=$product_id?>"  <?php } ?>><?=$product_name?></a></h3>

            <!-- End .product-title -->
            <?php if ($product_count == 0) { ?>
                    <div class="outstock">
                            <span class="outStockSpan">Out of Stock</span>
                    </div><!-- End .product-nav -->
                    <?php }else if($product_status == 0 || $product_count == 0){?>
                        <div class="outstock">
                            <span class="outStockSpan">Stop selling</span>
                        </div><!-- End .product-nav -->
                    <?php } else{?>
            <div class="product-price">
                <?=number_format($product_price,0,",",".")?> đ
            </div><!-- End .product-price -->
            <div class="ratings-container">
                <div class="ratings">
                    <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                </div><!-- End .ratings -->
                <span class="ratings-text">( 2 Reviews )</span>
            </div><!-- End .rating-container -->
            <?php } ?>
        </div><!-- End .product-body -->
    </div><!-- End .product -->
    <?php } } else {?>
        <p>Không có sản phẩm liên quan</p>
    <?php } ?>

</div><!-- End .owl-carousel -->