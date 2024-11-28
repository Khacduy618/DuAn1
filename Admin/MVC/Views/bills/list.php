<div class="container-fluid px-4">
    <h1 class=" mt-4">Bills Management</h1>

    <!-- Order Details Section -->
    <div class="container-fluid text-center my-4">
        <div class="d-flex justify-content-center gap-3">
            <a href="?mod=bill&act=archived" class="btn btn-warning px-4 py-2 text-dark fw-bold">View Saved Orders Store</a>
        </div>
    </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Bill ID</th>
                        <th>User Email</th>
                        <th>User Name</th>
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
                        <td><?=$bill['bill_id']; ?></td>
                        <td><?=$bill['bill_userEmail']; ?></td>
                        <td><?=$bill['user_full_name']; ?></td>
                        <td><?=number_format($bill['total_price'],0,',','.')?> đ</td>
                        <td>
                            <p id="status"><?php
                                $statusClasses = [
                                    1 => 'badge bg-danger',     // Unpaid
                                    2 => 'badge bg-success',    // Paid
                                    3 => 'badge bg-warning',    // Processing
                                    4 => 'badge bg-info',       // Approved
                                    5 => 'badge bg-primary',    // Delivering
                                    6 => 'badge bg-secondary',  // Delivered
                                    7 => 'badge bg-success'     // Completed
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
                                <span class="<?= $statusClasses[$bill['bill_status']] ?>">
                                    <?= $statusLabels[$bill['bill_status']] ?>
                                </span></p>
                        </td>
                        <td><?=$bill['bill_time']; ?></td>
                        <form class="bill-form" id="form-<?=$bill['bill_id']?>">
                            <input type="hidden" name="bill_id" value="<?=$bill['bill_id']?>">
                            <input type="hidden" name="bill_status" value="<?=$bill['bill_status']?>">
                        </form>
                        <td>
                            <a href="?mod=bill&act=detail&id=<?php echo $bill['bill_id']; ?>"
                                class="btn btn-primary btn-sm">Bill details</a>
                            <?php if ($bill['bill_status'] == 3) { ?>
                                <a href="?mod=bill&act=status&id=<?=$bill['bill_id']?>&status=4" class="btn btn-danger btn-sm">Approve</a><?php
                            }
                            if ($bill['bill_status'] == 6) {
                                ?><a href="?mod=bill&act=status&id=<?=$bill['bill_id']?>&status=7" class="btn btn-success btn-sm">Complete</a><?php
                            }
                            if($bill['bill_status'] == 7) {
                               ?><a href="?mod=bill&act=status&id=<?=$bill['bill_id']?>&status=8" class="btn btn-warning btn-sm">Archive</a>
                            <?php }
                            
                            ?>
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
<?php
$statusMessages = [
    3 => 'Đơn hàng đang xử lý',
    5 => 'Đơn hàng đang giao',
    6 => 'Đơn hàng giao thành công'
];

// Get status from URL if exists
$currentStatus = isset($_GET['status']) ? (int)$_GET['status'] : null;
?>

<!-- Add this right after your container div, before the table -->
<?php if (isset($currentStatus) && isset($statusMessages[$currentStatus])): ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?php echo $statusMessages[$currentStatus]; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<script>
    
document.addEventListener('DOMContentLoaded', function() {
    function sendData() {
        // Lấy tất cả các form
        const forms = document.querySelectorAll('.bill-form');
        
        forms.forEach(form => {
            // Tạo FormData từ form element
            const formData = new FormData(form);
            
            // Log để debug
            console.log('Sending data for form:', form.id, {
                bill_id: formData.get('bill_id'),
                bill_status: formData.get('bill_status')
            });

            // Gửi request
            fetch('?mod=bill&act=api', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Cập nhật thành công:', data);
                } else {
                    console.error('Lỗi cập nhật:', data.message);
                }
            })
            .catch(error => {
                console.error('Lỗi khi gửi request:', error);
            });
        });
    }

    // Gửi dữ liệu lần đầu sau 5 giây
    setTimeout(sendData, 5000);
    
    // Sau đó cứ mỗi 5 giây gửi một lần
    setInterval(sendData, 5000);
    
    // Tải lại trang mỗi 9 giây
    setInterval(() => {
        location.reload();
    }, 9000);
});

const urlParams = new URLSearchParams(window.location.search);
const status = urlParams.get('status');

if (status) {
    // Remove status from URL after showing alert
    let newUrl = window.location.href.split('&status=')[0];
    window.history.replaceState({}, document.title, newUrl);
}
</script>