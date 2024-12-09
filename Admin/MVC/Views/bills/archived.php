<div class="container-fluid px-4">
    <h1 class="text-uppercase mt-4">Archived Bills List</h1>

    <!-- Archived Bills Section -->
    <div class="container-fluid text-center my-4">
        <div class="d-flex justify-content-center gap-3">
            <a href="?mod=bill&act=list" class="btn btn-secondary px-4 py-2 text-dark fw-bold">Back to Bills List</a>
        </div>
    </div>
        <div class="card-body">
            <!-- Table for Archived Bills -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                    <tr>
                        <th>BILL CODE</th>
                        <th>Total Price</th>
                        <th>Bill Time</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($archivedBills)): ?>
                        <?php foreach ($archivedBills as $bill): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($bill['bill_var_id']); ?></td>
                                <td><?= number_format($bill['total_price'], 0, ',', '.'); ?> đ</td>
                                <td><?php echo htmlspecialchars($bill['bill_time']); ?></td>
                                <td>
                                    <a href="?mod=bill&act=detail&id=<?php echo $bill['bill_id']; ?>" class="btn btn-primary btn-sm">Details</a>
                                    <a href="?mod=bill&act=add&id=<?php echo $bill['bill_id']; ?>" class="btn btn-success btn-sm <?=!isset($_SESSION['privilege']['bill']['add']) ? 'disabled' : ''?>" onclick="return confirm('Are you sure you want to restore this bill?');">Restore</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No archived bills found.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
