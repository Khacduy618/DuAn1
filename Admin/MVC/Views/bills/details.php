<div class="container-fluid px-4">
    <h1 class="text-uppercase mt-4">Bill Details</h1>

    <!-- Bill Details Section -->
    <div class="card mb-4">

        <div class="card-body">
            <?php if (!empty($billDetails) && is_array($billDetails)): ?>
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Bill ID:</strong> <?=$billDetails['bill_id']; ?></p>
                    <p><strong>User Email:</strong> <?=$billDetails['bill_userEmail']; ?></p>
                    <p><strong>User Name:</strong> <?=$billDetails['user_full_name']; ?></p>
                    <p><strong>Coupon Name:</strong> <?=$billDetails['coupon_name']; ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Product Price:</strong>
                    <?=number_format($billDetails['bill_product_price'],0,',','.')?> đ</p>
                    <p><strong>Delivery Price:</strong> <?=number_format($billDetails['delivery_price'],0,',','.')?> đ
                    </p>
                    <p><strong>Total Price:</strong> <?=number_format($billDetails['total_price'],0,',','.')?> đ</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Status:</strong> <?php
                            $statusMapping = [
                                1 => 'Unpaid', 
                                        2 => 'Paid', 
                                        3 => 'Pending', 
                                        4 => 'Approved', 
                                        5 => 'Delivering', 
                                        6 => 'Delivered', 
                                        7 => 'Completed', 
                                        8 => 'Archive'
                            ];
                            echo htmlspecialchars($statusMapping[$billDetails['bill_status']]);
                            ?></p>
                    <p><strong>Bill Time:</strong> <?=$billDetails['bill_time']; ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Address:</strong> <?=$billDetails['address']; ?></p>
                </div>
            </div>

            <!-- Product Details in the Bill -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($billDetails['products'])): ?>
                        <?php
                            $products = explode(", ", $billDetails['products']);
                            $quantities = explode(", ", $billDetails['quantities']);
                            for ($i = 0; $i < count($products); $i++): ?>
                        <tr>
                            <td><?=$products[$i]; ?></td>
                            <td><?=$quantities[$i]; ?></td>
                        </tr>
                        <?php endfor; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="2" class="text-center">Không có sản phầm nào được tìm thấy trong hoá đơn.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <p class="text-center">No details found for this bill.</p>
            <?php endif; ?>
            <div class="mt-4">
                <?php if (isset($billDetails['deleted']) && $billDetails['deleted'] == 1): ?>
                <a href="?mod=bill&act=deleted" class="btn btn-secondary">Trở về Danh Sách Hoá Đơn Đã Xoá</a>
                <?php else: ?>
                <a href="?mod=bill&act=list" class="btn btn-secondary">Trở Về Danh Sách Hoá Đơn</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>