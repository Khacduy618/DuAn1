<h2 class="page-title">Product Reviews Management</h2>
    <table class="table table-bordered table-hover">
        <thead class="thead-white">
            <tr>
                <th>Product Name</th>
                <th class="text-center">Total Reviews</th>
                <th class="text-center">First Review</th>
                <th class="text-center">Latest Review</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reviews as $review){ ?>
            <tr>
                <td class="product-name"><?= $review['product_name'] ?></td>
                <td class="text-center"><?= $review['review_quantity'] ?></td>
                <td class="text-center"><?= $review['oldest_review'] ?></td>
                <td class="text-center"><?= $review['latest_review'] ?></td>
                <td class="text-center">
                    <?php if (!empty($review['product_id'])): ?>
                        <a href="?mod=review&act=detail&product_id=<?=$review['product_id']?>" 
                           class="btn btn-primary btn-sm <?=!isset($_SESSION['privilege']['review']['detail']) ? 'disabled' : ''?>">
                            <i class="la la-eye"></i> View Details
                        </a>
                    <?php else: ?>
                        <span class="text-muted">No data available</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>