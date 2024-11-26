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
                            0 => 'Unpaid', 
                            1 => 'Paid', 
                            2 => 'Pending', 
                            3 => 'Approved', 
                            4 => 'Delivering', 
                            5 => 'Delivered', 
                            6 => 'Completed', 
                            7 => 'Archive' 
                        ];
                        $currentStatusText = isset($statusMapping[$billDetails['bill_status']]) ? $statusMapping[$billDetails['bill_status']] : 'Unknown';
                        ?>
                <input type="text" class="form-control" id="status"
                    value="<?php echo htmlspecialchars($currentStatusText); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="newStatus" class="form-label"><strong>New Status:</strong></label>
                <select class="form-select" id="newStatus" name="newStatus">

                    <?php foreach ($statusMapping as $status => $statusText):?>
                    <option value="<?php echo $status;?>"
                        <?php echo ($billDetails['bill_status'] == $status)?'selected' : '';?>>
                        <?php echo $statusText;?>
                    </option>
                    <?php endforeach;?>
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