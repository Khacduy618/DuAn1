<!-- Update Bill Status Section -->
    <div class="card mb-4">
        <div class="card-header">
            <h4 class="mb-0">Cập nhật trạng thái đơn hàng</h4>
        </div>
        <div class="card-body">
            <?php if (!empty($billDetails)): ?>
                <form action="?mod=bills&act=status&id=<?php echo $billDetails['bill_id']; ?>" method="POST">
                    <div class="mb-3">
                        <label for="status" class="form-label"><strong>Current Status:</strong></label>
                        <?php
                        // Display the current status as text directly
                        $statusMapping = [
                            0 => 'Pending',
                            1 => 'Shipping',
                            2 => 'Completed',
                            3 => 'Archive'
                        ];
                        $currentStatusText = isset($statusMapping[$billDetails['bill_status']]) ? $statusMapping[$billDetails['bill_status']] : 'Unknown';
                        ?>
                        <input type="text" class="form-control" id="status" value="<?php echo htmlspecialchars($currentStatusText); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="newStatus" class="form-label"><strong>New Status:</strong></label>
                        <select class="form-select" id="newStatus" name="newStatus">
                            <option value="0" <?php echo ($billDetails['bill_status'] == 0) ? 'selected' : ''; ?>>Pending</option>
                            <option value="1" <?php echo ($billDetails['bill_status'] == 1) ? 'selected' : ''; ?>>Shipping</option>
                            <option value="2" <?php echo ($billDetails['bill_status'] == 2) ? 'selected' : ''; ?>>Completed</option>
                            <option value="3" <?php echo ($billDetails['bill_status'] == 3) ? 'selected' : ''; ?>>Archive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </form>
            <?php else: ?>
                <p class="text-center">No details found for this bill.</p>
            <?php endif; ?>
            <a href="?mod=bills&act=list" class="btn btn-secondary mt-3">Back to List</a>
        </div>
    </div>