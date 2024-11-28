<div class="container-fluid px-4">
    <h1 class="text-uppercase mt-4">Danh Sách Hoá Đơn Đã Lưu Trữ</h1>

    <!-- Archived Bills Section -->
    <div class="container-fluid text-center my-4">
        <div class="d-flex justify-content-center gap-3">
            <a href="?mod=bill&act=list" class="btn btn-secondary px-4 py-2 text-dark fw-bold">Quay lại danh sách hóa đơn</a>
        </div>
    </div>
        <div class="card-body">
            <!-- Table for Archived Bills -->
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
                    <?php if (!empty($archivedBills)): ?>
                        <?php foreach ($archivedBills as $bill): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($bill['bill_id']); ?></td>
                                <td><?php echo htmlspecialchars($bill['bill_userEmail']); ?></td>
                                <td><?php echo htmlspecialchars($bill['user_full_name']); ?></td>
                                <td><?php echo htmlspecialchars($bill['bill_product_price']); ?></td>
                                <td><?php echo htmlspecialchars($bill['delivery_price']); ?></td>
                                <td><?php echo htmlspecialchars($bill['total_price']); ?></td>
                                <td><?php echo 'Archived'; ?></td>
                                <td><?php echo htmlspecialchars($bill['bill_time']); ?></td>
                                <td>
                                    <a href="?mod=bill&act=detail&id=<?php echo $bill['bill_id']; ?>" class="btn btn-primary btn-sm">Details</a>
                                    <a href="?mod=bill&act=restore_archived&id=<?php echo $bill['bill_id']; ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to restore this bill?');">Restore</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">Không có hoá đơn nào được lưu trữ.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
