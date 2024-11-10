<div class="products mb-3">
    <div class="row justify-content-center">
        <?php 
			if(isset($data) && $data != NULL){
				foreach ($data as $value) {		
		?>
        <div class="col-6 col-md-4 col-lg-4 col-xl-3">
            <div class="product product-7 text-center">
                <figure class="product-media">
                    <span class="product-label label-new">New</span>
                    <a href="?act=detail&id=<?=$value['product_id']?>">
                        <img src="assets/site/images/products/<?=$value['HinhAnh1']?>" alt="Product image"
                            class="product-image">
                    </a>

                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                wishlist</span></a>
                        <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                            title="Quick view"><span>Quick view</span></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                    </div><!-- End .product-action-vertical -->

                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                    </div><!-- End .product-action -->
                </figure><!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
                        <a href="#">Women</a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a
                            href="?act=detail&id=<?=$value['product_id']?>"><?=$value['product_name']?></a></h3>
                    <!-- End .product-title -->
                    <div class="product-price">
                        <?=$value['product_price']?>
                    </div><!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 2 Reviews )</span>
                    </div><!-- End .rating-container -->

                    <div class="product-nav product-nav-thumbs">
                        <a href="#" class="active">
                            <img src="assets/site/images/products/product-4-thumb.jpg" alt="product desc">
                        </a>
                        <a href="#">
                            <img src="assets/site/images/products/product-4-2-thumb.jpg" alt="product desc">
                        </a>

                        <a href="#">
                            <img src="assets/site/images/products/product-4-3-thumb.jpg" alt="product desc">
                        </a>
                    </div><!-- End .product-nav -->
                </div><!-- End .product-body -->
            </div><!-- End .product -->
        </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->

        <?php }}else{
			echo '<p> KHÔNG CÓ DỮ LIỆU </p>';}?>
        <!-- single product end -->
    </div><!-- End .row -->
</div><!-- End .products -->
<?php 
                    if($orderdata['totalRecord']>12){
                ?>
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php
            if ($orderdata['currentPage'] > 2) {
                $first_page = 1;
                ?>
        <li class="page-item"><a class="page-link"
                href="<?php if (isset($_GET['product_cat']) && ($_GET['product_cat'] > 0)) { ?>index.php?act=shop&product_cat=<?= $_GET['product_cat'] ?>&per_page=<?= $orderdata['itemPerPage'] ?>&page=<?= $first_page ?>
                                    <?php }else{?>index.php?act=shop&per_page=<?= $orderdata['itemPerPage'] ?>&page=<?= $first_page ?><?php } ?>">First</a>
        </li>
        <?php
            }
            if ($orderdata['currentPage'] > 1) {
                $prev_page = $orderdata['currentPage'] - 1;
                ?>
        <li class="page-item"><a class="page-link page-link-prev"
                href="<?php if (isset($_GET['product_cat']) && ($_GET['product_cat'] > 0)) { ?>index.php?act=shop&product_cat=<?= $_GET['product_cat'] ?>&per_page=<?= $orderdata['itemPerPage'] ?>&page=<?= $prev_page ?>
                                        <?php }else{?>index.php?act=shop&per_page=<?= $orderdata['itemPerPage'] ?>&page=<?= $prev_page ?><?php } ?>"><i
                    class="icon-long-arrow-left"></i>Prev</a></li>
        <?php }
                                ?>
        <?php for ($num = 1; $num <= $orderdata['totalPages']; $num++) { ?>
        <?php if ($num != $orderdata['currentPage']) { ?>
        <?php if ($num > $orderdata['currentPage'] - 3 && $num < $orderdata['currentPage'] + 3) { ?>
        <li class="page-item"><a class="page-link"
                href="<?php if (isset($_GET['product_cat']) && ($_GET['product_cat'] > 0)) { ?>index.php?act=shop&product_cat=<?= $_GET['product_cat'] ?>&per_page=<?= $orderdata['itemPerPage'] ?>&page=<?= $num ?>
                                                <?php }else{?>index.php?act=shop&per_page=<?= $orderdata['itemPerPage'] ?>&page=<?= $num ?> <?php } ?>"><?= $num ?></a>
        </li>
        <?php } ?>
        <?php } else { ?>
        <li class="page-item active"><a class="page-link"><?= $num ?></a></li>
        <?php } ?>
        <?php } ?>
        <?php
                                if ($orderdata['currentPage'] < $orderdata['totalPages'] - 0) {
                                    $next_page = $orderdata['currentPage'] + 1;
                                    ?>
        <li class="page-item"><a class="page-link page-link-next"
                href="<?php if (isset($_GET['product_cat']) && ($_GET['product_cat'] > 0)) { ?>index.php?act=shop&product_cat=<?= $_GET['product_cat'] ?>&per_page=<?= $orderdata['itemPerPage'] ?>&page=<?= $next_page ?>
                                    <?php }else{ ?>index.php?act=shop&per_page=<?= $orderdata['itemPerPage'] ?>&page=<?= $next_page ?> <?php } ?>">Next<span><i
                        class="icon-long-arrow-right"></i></span></a></li>
        <?php
                                }
                                if ($orderdata['currentPage'] < $orderdata['totalPages'] - 2) {
                                    $end_page = $orderdata['totalPages'];
                                    ?>
        <li class="page-item"><a class="page-link"
                href="<?php if (isset($_GET['product_cat']) && ($_GET['product_cat'] > 0)) { ?>index.php?act=shop&product_cat=<?= $_GET['product_cat'] ?>&per_page=<?= $orderdata['itemPerPage'] ?>&page=<?= $end_page ?>
                                        <?php }else{ ?>index.php?act=shop&per_page=<?= $orderdata['itemPerPage'] ?>&page=<?= $end_page ?> <?php } ?>">Last</a>
        </li>
        <?php
                                }
                                ?>
        <!-- <li class="page-item disabled">
                                <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                    <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                                </a>
                            </li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item-total">of 6</li>
                            <li class="page-item">
                                <a class="page-link page-link-next" href="#" aria-label="Next">
                                    Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                </a>
                            </li> -->
    </ul>
</nav>
<?php
                    }
                ?>