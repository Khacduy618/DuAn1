    <h2>Review</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity Review</th>
                <th>Oldest</th>
                <th>Lastest</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reviews as $review){ 
               ?>
            <tr>
                <td><?= $review['product_name'] ?></td>
                <td><?= $review['review_quantity'] ?></td>
                <td><?= $review['oldest_review'] ?></td>
                <td><?= $review['latest_review'] ?></td>
                <td>
                    <button class="details-button">
                        <?php if (!empty($review['product_id'])): ?>
                        <a href="?mod=review&act=detail&product_id=<?=$review['product_id']?>"
                            style="color: #fff; text-decoration: none;">
                            Details <i class="la la-angle-right"></i>
                        </a>

                        <?php else: ?>
                        <span>Không có dữ liệu</span>
                        <?php endif; ?>
                    </button>
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>