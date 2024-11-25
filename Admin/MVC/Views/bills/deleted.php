<div class="container-fluid px-4">
    <h1 class="text-uppercase mt-4">Danh Sách Hoá Đơn Đã Xoá</h1>

    <!-- Deleted Order Details Section -->
    <div class="container-fluid text-center my-4">
        <div class="d-flex justify-content-center gap-3">
            <a href="?mod=bills&act=list" class="btn btn-secondary px-4 py-2 text-dark fw-bold">Quay lại danh sách hóa đơn</a>
        </div>
    </div>
        <div class="card-body">
            <!-- Table for Deleted Bills -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                    <tr>
                        <th>Bill ID</th>
                        <th>User Email</th>
                        <th>User Name</th>
                        <th>Product Price</th>
                        <th>Delivery Price</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Bill Time</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($bills)): ?>
                        <?php foreach ($bills as $bill): ?>
                            <tr>
                                <td><?php echo isset($bill['bill_id']) ? htmlspecialchars($bill['bill_id']) : 'N/A'; ?></td>
                                <td><?php echo isset($bill['bill_userEmail']) ? htmlspecialchars($bill['bill_userEmail']) : 'N/A'; ?></td>
                                <td><?php echo isset($bill['user_full_name']) ? htmlspecialchars($bill['user_full_name']) : 'N/A'; ?></td>
                                <td><?php echo isset($bill['bill_product_price']) ? htmlspecialchars($bill['bill_product_price']) : 'N/A'; ?></td>
                                <td><?php echo isset($bill['delivery_price']) ? htmlspecialchars($bill['delivery_price']) : 'N/A'; ?></td>
                                <td><?php echo isset($bill['total_price']) ? htmlspecialchars($bill['total_price']) : 'N/A'; ?></td>
                                <td><?php
                                    $statusMapping = [
                                        0 => 'Pending',
                                        1 => 'Shipping',
                                        2 => 'Completed',
                                        3 => 'Archive'
                                    ];
                                    echo isset($bill['bill_status']) ? htmlspecialchars($statusMapping[$bill['bill_status']]) : 'N/A';
                                    ?></td>
                                <td><?php echo isset($bill['bill_time']) ? htmlspecialchars($bill['bill_time']) : 'N/A'; ?></td>
                                <td>
                                    <a href="?mod=bills&act=detail&id=<?php echo $bill['bill_id']; ?>" class="btn btn-primary btn-sm">Details</a>
                                    <a href="?mod=bills&act=restore_deleted&id=<?php echo $bill['bill_id']; ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to restore this bill?');">Restore</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">Không có hoá đơn nào bị xoá.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>