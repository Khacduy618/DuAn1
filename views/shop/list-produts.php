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
                    <a href="?act=product&id=<?=$value['product_id']?>">
                        <img src="uploaded/<?=$value['product_img']?>" alt="Product image" class="product-image">
                    </a>

                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                wishlist</span></a>
                        <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                            title="Quick view"><span>Quick view</span></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                    </div><!-- End .product-action-vertical -->

                    <div class="product-action">
                        <a href="?act=cart&xuli=add&product_id=<?=$value['product_id']?>&quantity=1"
                            class="btn-product btn-cart"><span>add to cart</span></a>
                    </div><!-- End .product-action -->
                </figure><!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
                        <a href="#">Women</a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a
                            href="?act=product&id=<?=$value['product_id']?>"><?=$value['product_name']?></a></h3>
                    <!-- End .product-title -->
                    <div class="product-price">
                        <?=number_format($value['product_price'],0,",",".")?> đ
                    </div><!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 2 Reviews )</span>
                    </div><!-- End .rating-container -->

                    <div class="product-nav product-nav-thumbs">
                        <a href="#" class="active">
                            <img src="uploaded/product-4-thumb.jpg" alt="product desc">
                        </a>
                        <a href="#">
                            <img src="uploaded/product-4-2-thumb.jpg" alt="product desc">
                        </a>

                        <a href="#">
                            <img src="uploaded/product-4-3-thumb.jpg" alt="product desc">
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
// Retrieve current sorting parameters
$field = isset($_GET['field']) ? $_GET['field'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
$product_cat = isset($_GET['product_cat']) ? $_GET['product_cat'] : 0;
$per_page = isset($orderdata['itemPerPage']) ? $orderdata['itemPerPage'] : 12; // Default to 12 if not set

if ($orderdata['totalRecord'] > 12) {
?>
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php
            // Link to first page
            if ($orderdata['currentPage'] > 2) {
                $first_page = 1;
                ?>
        <li class="page-item"><a class="page-link"
                href="index.php?act=shop&product_cat=<?= $product_cat ?>&per_page=<?= $per_page ?>&page=<?= $first_page ?>&field=<?= $field ?>&sort=<?= $sort ?>">First</a>
        </li>
        <?php
            }
            // Link to previous page
            if ($orderdata['currentPage'] > 1) {
                $prev_page = $orderdata['currentPage'] - 1;
                ?>
        <li class="page-item"><a class="page-link page-link-prev"
                href="index.php?act=shop&product_cat=<?= $product_cat ?>&per_page=<?= $per_page ?>&page=<?= $prev_page ?>&field=<?= $field ?>&sort=<?= $sort ?>"><i
                    class="icon-long-arrow-left"></i>Prev</a></li>
        <?php }
        // Numbered page links
        for ($num = 1; $num <= $orderdata['totalPages']; $num++) {
            if ($num != $orderdata['currentPage']) {
                if ($num > $orderdata['currentPage'] - 3 && $num < $orderdata['currentPage'] + 3) {
                    ?>
        <li class="page-item"><a class="page-link"
                href="index.php?act=shop&product_cat=<?= $product_cat ?>&per_page=<?= $per_page ?>&page=<?= $num ?>&field=<?= $field ?>&sort=<?= $sort ?>"><?= $num ?></a>
        </li>
        <?php 
                }
            } else { ?>
        <li class="page-item active"><a class="page-link"><?= $num ?></a></li>
        <?php }
        }
        // Link to next page
        if ($orderdata['currentPage'] < $orderdata['totalPages']) {
            $next_page = $orderdata['currentPage'] + 1;
            ?>
        <li class="page-item"><a class="page-link page-link-next"
                href="index.php?act=shop&product_cat=<?= $product_cat ?>&per_page=<?= $per_page ?>&page=<?= $next_page ?>&field=<?= $field ?>&sort=<?= $sort ?>">Next<span><i
                        class="icon-long-arrow-right"></i></span></a></li>
        <?php
        }
        // Link to last page
        if ($orderdata['currentPage'] < $orderdata['totalPages'] - 2) {
            $end_page = $orderdata['totalPages'];
            ?>
        <li class="page-item"><a class="page-link"
                href="index.php?act=shop&product_cat=<?= $product_cat ?>&per_page=<?= $per_page ?>&page=<?= $end_page ?>&field=<?= $field ?>&sort=<?= $sort ?>">Last</a>
        </li>
        <?php
        }
        ?>
    </ul>
</nav>
<?php } ?>