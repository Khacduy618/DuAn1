<div class="container trending">
    <div class="heading heading-flex mb-3">
        <div class="heading-left">
            <h2 class="title">Trending Products</h2><!-- End .title -->
        </div><!-- End .heading-left -->

        <div class="heading-right">
            <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="trending-all-link" data-toggle="tab" href="#trending-all-tab"
                        role="tab" aria-controls="trending-all-tab" aria-selected="true">Iphone</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="trending-tv-link" data-toggle="tab" href="#trending-tv-tab" role="tab"
                        aria-controls="trending-tv-tab" aria-selected="false">samsung</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="trending-computers-link" data-toggle="tab" href="#trending-computers-tab"
                        role="tab" aria-controls="trending-computers-tab" aria-selected="false">xiaomi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="trending-phones-link" data-toggle="tab" href="#trending-phones-tab"
                        role="tab" aria-controls="trending-phones-tab" aria-selected="false">oppo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="trending-watches-link" data-toggle="tab" href="#trending-watches-tab"
                        role="tab" aria-controls="trending-watches-tab" aria-selected="false">ipad</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="trending-acc-link" data-toggle="tab" href="#trending-acc-tab" role="tab"
                        aria-controls="trending-acc-tab" aria-selected="false">Macbook</a>
                </li>
            </ul>
        </div><!-- End .heading-right -->
    </div><!-- End .heading -->

    <div class="row">
        <div class="col-xl-5col d-none d-xl-block">
            <div class="banner">
                <a href="#">
                    <img src="uploaded/banner-4.jpg" alt="banner">
                </a>
            </div><!-- End .banner -->
        </div><!-- End .col-xl-5col -->

        <div class="col-xl-4-5col">
            <div class="tab-content tab-content-carousel just-action-icons-sm">
                <div class="tab-pane p-0 fade show active" id="trending-all-tab" role="tabpanel"
                    aria-labelledby="trending-all-link">
                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl"
                        data-owl-options='{
                                "nav": true, 
                                "dots": false,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    }
                                }
                            }'>
                        <?php if (!empty($trendingView) ){
                        foreach($trendingView[0] as $key => $value ){
                                extract($value);
                        ?>

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">Top</span>
                                <a href="?act=product&id=<?=$product_id?>">
                                    <img src="uploaded/<?=$product_img?>" alt="Product image" class="product-image">
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
                                <div class="product-cat">
                                    <a href="#"><?= $category_name?></a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="#"><?= $product_name?></a></h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    <?=number_format($product_price,0,",",".")?> đ
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 100%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 Reviews )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" style="background: #69b4ff;"><span class="sr-only">Color
                                            name</span></a>
                                    <a href="#" style="background: #ff887f;"><span class="sr-only">Color
                                            name</span></a>
                                    <a href="#" class="active" style="background: #333333;"><span class="sr-only">Color
                                            name</span></a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                        <?php 
                                }   
                                }else{
                                    echo "No data available";
                                } ?>
                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane p-0 fade" id="trending-tv-tab" role="tabpanel" aria-labelledby="trending-tv-link">
                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl"
                        data-owl-options='{
                                    "nav": true, 
                                    "dots": false,
                                    "margin": 20,
                                    "loop": false,
                                    "responsive": {
                                        "0": {
                                            "items":2
                                        },
                                        "480": {
                                            "items":2
                                        },
                                        "768": {
                                            "items":3
                                        },
                                        "992": {
                                            "items":4
                                        }
                                    }
                                }'>
                        <?php if (isset($samsung) && $samsung != NULL){
                                    foreach ($samsung as $item){?>

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">Top</span>
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
                                <div class="product-cat">
                                    <a href="#"><?= $item ['category_name'];?></a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="#"><?= $item ['product_name'];?></a></h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    <?=number_format($item['product_price'],0,",",".")?> đ
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 100%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 Reviews )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" style="background: #69b4ff;"><span class="sr-only">Color
                                            name</span></a>
                                    <a href="#" style="background: #ff887f;"><span class="sr-only">Color
                                            name</span></a>
                                    <a href="#" class="active" style="background: #333333;"><span class="sr-only">Color
                                            name</span></a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                        <?php 
                                }   
                                }else{
                                    echo "No data available";
                                } ?>
                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane p-0 fade" id="trending-computers-tab" role="tabpanel"
                    aria-labelledby="trending-computers-link">
                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl"
                        data-owl-options='{
                                "nav": true, 
                                "dots": false,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    }
                                }
                            }'>
                        <?php if (isset($xiaomi) && $xiaomi != NULL){
                                foreach ($xiaomi as $item){?>

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">Top</span>
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
                                <div class="product-cat">
                                    <a href="#"><?= $item ['category_name'];?></a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="#"><?= $item ['product_name'];?></a></h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    <?=number_format($item['product_price'],0,",",".")?> đ
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 100%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 Reviews )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" style="background: #69b4ff;"><span class="sr-only">Color
                                            name</span></a>
                                    <a href="#" style="background: #ff887f;"><span class="sr-only">Color
                                            name</span></a>
                                    <a href="#" class="active" style="background: #333333;"><span class="sr-only">Color
                                            name</span></a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                        <?php 
                            }   
                            }else{
                                echo "No data available";
                            } ?>
                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane p-0 fade" id="trending-phones-tab" role="tabpanel"
                    aria-labelledby="trending-phones-link">
                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl"
                        data-owl-options='{
                                    "nav": true, 
                                    "dots": false,
                                    "margin": 20,
                                    "loop": false,
                                    "responsive": {
                                        "0": {
                                            "items":2
                                        },
                                        "480": {
                                            "items":2
                                        },
                                        "768": {
                                            "items":3
                                        },
                                        "992": {
                                            "items":4
                                        }
                                    }
                                }'>
                        <?php if (isset($oppo) && $oppo != NULL){
                                    foreach ($oppo as $item){?>

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">Top</span>
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
                                <div class="product-cat">
                                    <a href="#"><?= $item ['category_name'];?></a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="#"><?= $item ['product_name'];?></a></h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    <?=number_format($item['product_price'],0,",",".")?> đ
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 100%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 Reviews )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" style="background: #69b4ff;"><span class="sr-only">Color
                                            name</span></a>
                                    <a href="#" style="background: #ff887f;"><span class="sr-only">Color
                                            name</span></a>
                                    <a href="#" class="active" style="background: #333333;"><span class="sr-only">Color
                                            name</span></a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                        <?php 
                                }   
                                }else{
                                    echo "No data available";
                                } ?>
                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane p-0 fade" id="trending-watches-tab" role="tabpanel"
                    aria-labelledby="trending-watches-link">
                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl"
                        data-owl-options='{
                                    "nav": true, 
                                    "dots": false,
                                    "margin": 20,
                                    "loop": false,
                                    "responsive": {
                                        "0": {
                                            "items":2
                                        },
                                        "480": {
                                            "items":2
                                        },
                                        "768": {
                                            "items":3
                                        },
                                        "992": {
                                            "items":4
                                        }
                                    }
                                }'>
                        <?php if (isset($ipad) && $ipad != NULL){
                                    foreach ($ipad as $item){?>

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">Top</span>
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
                                <div class="product-cat">
                                    <a href="#"><?= $item ['category_name'];?></a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="#"><?= $item ['product_name'];?></a></h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    <?=number_format($item['product_price'],0,",",".")?> đ
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 100%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 Reviews )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" style="background: #69b4ff;"><span class="sr-only">Color
                                            name</span></a>
                                    <a href="#" style="background: #ff887f;"><span class="sr-only">Color
                                            name</span></a>
                                    <a href="#" class="active" style="background: #333333;"><span class="sr-only">Color
                                            name</span></a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                        <?php 
                                }   
                                }else{
                                    echo "No data available";
                                } ?>
                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane p-0 fade" id="trending-acc-tab" role="tabpanel"
                    aria-labelledby="trending-acc-link">
                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl"
                        data-owl-options='{
                                    "nav": true, 
                                    "dots": false,
                                    "margin": 20,
                                    "loop": false,
                                    "responsive": {
                                        "0": {
                                            "items":2
                                        },
                                        "480": {
                                            "items":2
                                        },
                                        "768": {
                                            "items":3
                                        },
                                        "992": {
                                            "items":4
                                        }
                                    }
                                }'>
                        <?php if (isset($macbook) && $macbook != NULL){
                                    foreach ($macbook as $item){?>

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">Top</span>
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
                                <div class="product-cat">
                                    <a href="#"><?= $item ['category_name'];?></a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="#"><?= $item ['product_name'];?></a></h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    <?=number_format($item['product_price'],0,",",".")?> đ
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 100%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 Reviews )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" style="background: #69b4ff;"><span class="sr-only">Color
                                            name</span></a>
                                    <a href="#" style="background: #ff887f;"><span class="sr-only">Color
                                            name</span></a>
                                    <a href="#" class="active" style="background: #333333;"><span class="sr-only">Color
                                            name</span></a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                        <?php 
                                    }   
                                    }else{
                                        echo "No data available";
                                    } ?>
                    </div><!-- End .product -->
                </div><!-- End .owl-carousel -->
            </div><!-- .End .tab-pane -->
        </div><!-- End .tab-content -->
    </div><!-- End .col-xl-4-5col -->
</div><!-- End .row -->
</div><!-- End .container -->