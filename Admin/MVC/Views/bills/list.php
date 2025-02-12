<div class="container-fluid px-4">
    <h1 class="mt-4">Bills Management</h1>

    <!-- Order Details Section -->
    <div class="container-fluid text-center my-4">
        <div class="d-flex justify-content-center gap-3">
            <a href="?mod=bill&act=archived" class="btn btn-warning px-4 py-2 text-dark fw-bold">View Saved Orders Store</a>
        </div>
    </div>

    <?php
    // Khai báo các mảng trạng thái và màu sắc
    $statusClasses = [
        1 => 'bg-danger',     // Unpaid
        2 => 'bg-success',    // Paid
        3 => 'bg-warning',    // Processing
        4 => 'bg-info',       // Approved
        5 => 'bg-primary',    // Delivering
        6 => 'bg-secondary',  // Delivered
        7 => 'bg-success'     // Completed
    ];

    $statusLabels = [
        1 => 'Unpaid',
        2 => 'Paid',
        3 => 'Processing',
        4 => 'Approved',
        5 => 'Delivering',
        6 => 'Delivered',
        7 => 'Completed'
    ];
    ?>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
            <tr>
                <th>BILL CODE</th>
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
                        <td><?= $bill['bill_var_id']; ?></td>
                        <td><?= number_format($bill['total_price'], 0, ',', '.'); ?> đ</td>
                        <td>
                            <label>
                                <select class="form-select status-select <?= $statusClasses[$bill['bill_status']] ?>"
                                        data-bill-id="<?= $bill['bill_id']; ?>"
                                        style="width: auto; display: inline-block;">
                                    <!-- Hiển thị trạng thái hiện tại -->
                                    <option value="<?= $bill['bill_status'] ?>" selected>
                                        <?= $statusLabels[$bill['bill_status']] ?>
                                    </option>
                                    <!-- Hiển thị các trạng thái khác -->
                                    <?php foreach ($statusLabels as $key => $label): ?>
                                        <?php if ($key != $bill['bill_status']): ?>
                                            <option value="<?= $key ?>"><?= $label ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </label>
                        </td>
                        <td><?= $bill['bill_time']; ?></td>
                        <td>
                            <a href="?mod=bill&act=detail&id=<?= $bill['bill_id']; ?>"
                               class="btn btn-primary btn-sm">Bill details</a>
                            <?php if ($bill['bill_status'] == 7): ?>
                                <a href="?mod=bill&act=edit&id=<?= $bill['bill_id']; ?>&status=8"
                                   class="btn btn-warning btn-sm">Archive</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No bills found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Hiển thị thông báo trạng thái -->
<?php
$statusMessages = [
    3 => 'Đơn hàng đang xử lý',
    5 => 'Đơn hàng đang giao',
    6 => 'Đơn hàng giao thành công'
];

$currentStatus = isset($_GET['status']) ? (int)$_GET['status'] : null;
if (isset($currentStatus) && isset($statusMessages[$currentStatus])): ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= $statusMessages[$currentStatus]; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const statusClasses = {
            1: 'bg-danger',
            2: 'bg-success',
            3: 'bg-warning',
            4: 'bg-info',
            5: 'bg-primary',
            6: 'bg-secondary',
            7: 'bg-success',
        };

        const statusLabels = {
            1: 'Unpaid',
            2: 'Paid',
            3: 'Processing',
            4: 'Approved',
            5: 'Delivering',
            6: 'Delivered',
            7: 'Completed',
        };

        document.querySelectorAll('.status-select').forEach(function (selectElement) {
            selectElement.addEventListener('change', function () {
                const billId = this.getAttribute('data-bill-id');
                const newStatus = this.value;

                // Tạo FormData để gửi qua AJAX
                const formData = new FormData();
                formData.append('bill_id', billId);
                formData.append('bill_status', newStatus);

                console.log('Dữ liệu gửi đi:', { bill_id: billId, bill_status: newStatus }); // Log dữ liệu
                // Gửi AJAX tới server
                fetch('?mod=bill&act=status', {
                    method: 'POST',
                    body: formData,
                })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return response.json(); // Phản hồi JSON từ server
                    })
                    .then((data) => {
                        console.log('Phản hồi từ server:', data); // Log dữ liệu để kiểm tra
                        if (data.success) {
                            alert('Cập nhật trạng thái thành công');
                            selectElement.className = `form-select status-select ${statusClasses[newStatus]}`;
                            selectElement.querySelector(`option[value="${newStatus}"]`).selected = true;
                        } else {
                            alert('Cập nhật thất bại: ' + data.message);
                            selectElement.value = selectElement.querySelector('option[selected]').value;
                        }
                    })
                    .catch((error) => {
                        console.error('Lỗi khi gửi yêu cầu:', error);
                        alert('Đã xảy ra lỗi khi gửi yêu cầu.');
                        selectElement.value = selectElement.querySelector('option[selected]').value;
                    });
            });
        });
    });
</script>