<div class="products mb-3">
    <div class="row justify-content-center">
        <?php 
			if(isset($data) && $data != NULL){
				foreach ($data as $value) {
		?>
        <div class="col-6 col-md-4 col-lg-4 col-xl-3">
            <div class="product product-7 text-center">
                <figure class="product-media">
                <?php 
                    // Kiểm tra sản phẩm có được tạo trong vòng 1 tháng không
                    $created_date = strtotime($value['created_at']);
                    $one_month_ago = strtotime('-1 month');
                    if ($created_date >= $one_month_ago) { 
                    ?>
                        <span class="product-label label-new">New</span>
                    <?php } ?>
                    <a <?php if ($value['product_status'] != 0 && $value['product_count'] != 0) { ?> href="?act=product&id=<?=$value['product_id']?>"  <?php } ?> >
                        <div class="product-image">
                            <img src="uploaded/<?=$value['product_img']?>" alt="Product image" >
                        </div>
                    </a>
                    <?php if ($value['product_status'] == 1 && $value['product_count'] > 0) { ?>
                        <?php if ($value['product_status'] == 1 && $value['product_count'] > 0) { 
    $isFavorited = false;
    if(isset($_SESSION['login'])) {
        require_once 'Models/favorite.php';
        $favorite = new Favorite();
        $isFavorited = $favorite->isProductFavorited($_SESSION['login']['user_email'], $value['product_id']);
    }
?>
    <div class="product-action-vertical">
        <form action="index.php?act=favorite&xuli=<?= $isFavorited ? 'delete' : 'add' ?>" method="POST">
            <input type="hidden" name="product_id" value="<?=$value['product_id']?>">
            <?php if($isFavorited): ?>
                <input type="hidden" name="favorite_id" value="<?=$favorite->findByUserAndProduct($_SESSION['login']['user_email'], $value['product_id'])['favorite_id']?>">
            <?php endif; ?>
            <button type="submit" class="btn-product-icon btn-wishlist <?= $isFavorited ? 'active' : '' ?>">
                <span><?= $isFavorited ? 'Xóa khỏi yêu thích' : 'Thêm vào yêu thích' ?></span>
            </button>
        </form>
    </div>
<?php } ?>

                    <div class="product-action">
                        <a href="?act=cart&xuli=add&product_id=<?=$value['product_id']?>&quantity=1"
                            class="btn-product btn-cart"><span>add to cart</span></a>
                    </div><!-- End .product-action -->
                    <?php } ?>
                </figure><!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
                        <a href="?act=shop&product_cat=<?=$value['category_id']?>"><?=$value['category_name']?></a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a
                    <?php if ($value['product_status'] != 0 && $value['product_count'] != 0) { ?> href="?act=product&id=<?=$value['product_id']?>"  <?php } ?>><?=$value['product_name']?></a></h3>
                    <!-- End .product-title -->
                    <?php if ($value['product_count'] == 0) { ?>
                    <div class="outstock">
                            <span class="outStockSpan">Out of Stock</span>
                    </div><!-- End .product-nav -->
                    <?php }else if($value['product_status']==0 || $value['product_count']==0){?>
                        <div class="outstock">
                            <span class="outStockSpan">Stop selling</span>
                        </div><!-- End .product-nav -->
                    <?php } else{?>
                        
                    <div class="product-price">
                        <?=number_format($value['product_price'],0,",",".")?> đ
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
<style>
.btn-wishlist {
    width: 35px;
    height: 35px;
    padding: 0;
    border-radius: 50%; 
    border: 0.1rem solid #d7d7d7;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
}

.btn-wishlist.active {
    color: #fff; 
    background-color: #dc3545; 
    border-color: #dc3545; 
}
</style>