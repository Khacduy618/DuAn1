
    <table class="table table-hover ">
        <thead class="table-dark">
            <tr>
                <th scope="col">Product Name</th>
                <th scope="col">Image</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody id="orderDetailContent">
        <?php foreach($data as $item):
            extract($item);
        ?>
            <tr>
                <td class="align-middle fw-semibold"><?php echo htmlspecialchars($product_name); ?></td>
                <td class="align-middle">
                    <img src="<?=UPLOAD_DIR . $product_img ?>" 
                         alt="<?php echo htmlspecialchars($product_name); ?>" 
                         class="img-thumbnail"
                         style="width: 80px; height: 80px; object-fit: cover;">
                </td>
                <td class="align-middle text-primary"><?=number_format($pro_price,0,",",".")?> đ</td>
                <td class="align-middle"><?php echo htmlspecialchars($pro_count); ?></td>
                <td class="align-middle fw-bold text-success"><?=number_format($total_price,0,",",".")?> đ</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
                
