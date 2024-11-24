<div class="container-fluid px-4">
    <h1 class="text-uppercase mt-4">Đơn Hàng Hiện Tại</h1>

    <!-- Order Details Section -->
    <div class="container-fluid text-center my-4">
        <div class="d-flex justify-content-center gap-3">
            <a href="?mod=bills&act=archived" class="btn btn-warning px-4 py-2 text-dark fw-bold">Xem Đơn hàng Lưu Trữ</a>
            <a href="?mod=bills&act=deleted" class="btn btn-warning px-4 py-2 text-dark fw-bold">Xem Đơn hàng đã Xóa</a>
        </div>
    </div>
        <div class="card-body">
            <!-- Table for Bills -->
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
                                <td><?php echo htmlspecialchars($bill['bill_id']); ?></td>
                                <td><?php echo htmlspecialchars($bill['bill_userEmail']); ?></td>
                                <td><?php echo htmlspecialchars($bill['user_full_name']); ?></td>
                                <td><?php echo htmlspecialchars($bill['bill_product_price']); ?></td>
                                <td><?php echo htmlspecialchars($bill['delivery_price']); ?></td>
                                <td><?php echo htmlspecialchars($bill['total_price']); ?></td>
                                <td><?php
                                    $statusMapping = [
                                        0 => 'Pending',
                                        1 => 'Shipping',
                                        2 => 'Completed',
                                        3 => 'Archive'
                                    ];
                                    echo htmlspecialchars($statusMapping[$bill['bill_status']]);
                                    ?></td>
                                <td><?php echo htmlspecialchars($bill['bill_time']); ?></td>
                                <td>
                                    <a href="?mod=bills&act=detail&id=<?php echo $bill['bill_id']; ?>" class="btn btn-primary btn-sm">Chi Tiết Đơn Hàng</a>
                                    <a href="?mod=bills&act=delete&id=<?php echo $bill['bill_id']; ?>" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure you want to mark this bill as deleted?');">Xoá</a>
                                    <a href="?mod=bills&act=status&id=<?php echo $bill['bill_id']; ?>&status=completed" class="btn btn-success btn-sm">Trạng Thái Đơn</a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">No bills found.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>