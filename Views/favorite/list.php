<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
    <div class="container">
        <h1 class="page-title">List Favorite<span>Favorite</span></h1>
    </div><!-- End .container -->
</div><!-- End .page-header -->
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?act=home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->
<?php if(isset($_COOKIE['msg1'])): ?>
<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
    <strong><?php echo htmlspecialchars($_COOKIE['msg1']); ?></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif; ?>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="title text-center mb-4">Favorite List</h2>

                    <?php if(empty($data['favorites'])): ?>
                        <div class="text-center py-5">
                            <h4>No favorite products yet</h4>
                            <a href="?act=shop" class="btn btn-outline-primary-2 mt-3">
                                <span>CONTINUE SHOPPING</span>
                                <i class="icon-long-arrow-right"></i>
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-wishlist table-mobile">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Stock Status</th>
                                        <th>Actions</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach($data['favorites'] as $item): ?>
                                        <tr>
                                            <td class="product-col">
                                                <div class="product">
                                                    <figure class="product-media">
                                                        <a href="?act=product&id=<?=$item['product_id']?>">
                                                            <img src="uploaded/<?=$item['product_img']?>" 
                                                                 alt="<?=$item['product_name']?>" 
                                                                 class="product-image">
                                                        </a>
                                                    </figure>

                                                    <h3 class="product-title">
                                                        <a href="?act=product&id=<?=$item['product_id']?>">
                                                            <?=$item['product_name']?>
                                                        </a>
                                                    </h3>
                                                </div>
                                            </td>
                                            <td class="price-col">
                                                <?=number_format($item['product_price'], 0, ",", ".")?> đ
                                            </td>
                                            <td class="stock-col">
                                                <?php if($item['product_count'] > 0): ?>
                                                    <span class="in-stock">In Stock</span>
                                                <?php else: ?>
                                                    <span class="out-of-stock">Out of Stock</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="action-col">
                                                <?php if($item['product_count'] > 0): ?>
                                                    <a href="?act=cart&xuli=add&product_id=<?=$item['product_id']?>&quantity=1" 
                                                       class="btn btn-block btn-outline-primary-2">
                                                        <i class="icon-cart-plus"></i>Add to Cart
                                                    </a>
                                                <?php else: ?>
                                                    <button class="btn btn-block btn-outline-primary-2 disabled">
                                                        Out of Stock
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                            <td class="remove-col">
                                                <a href="?act=favorite&xuli=delete&id=<?=$item['favorite_id']?>" 
                                                   class="btn-remove"
                                                   onclick="return confirm('Are you sure you want to remove this product from your favorites?');">
                                                    <i class="icon-close"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
function removeFavorite(favoriteId) {
    if(confirm('Bạn có chắc muốn xóa sản phẩm này khỏi danh sách yêu thích?')) {
        $.ajax({
            url: 'index.php?act=favorite&xuli=delete',
            type: 'POST',
            data: {
                favorite_id: favoriteId
            },
            success: function(response) {
                try {
                    let result = JSON.parse(response);
                    if(result.status === 'success') {
                        // Reload trang sau khi xóa thành công
                        location.reload();
                    } else {
                        alert(result.message);
                    }
                } catch(e) {
                    alert('Có lỗi xảy ra');
                }
            },
            error: function() {
                alert('Không thể kết nối đến server');
            }
        });
    }
}
</script>