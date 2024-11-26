<div class="container-fluid px-4">
    <h1 class="text-uppercase mt-4">Đơn Hàng Hiện Tại</h1>

    <!-- Order Details Section -->
    <div class="container-fluid text-center my-4">
        <div class="d-flex justify-content-center gap-3">
            <a href="?mod=bills&act=archived" class="btn btn-warning px-4 py-2 text-dark fw-bold">Xem Đơn hàng Lưu
                Trữ</a>
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
                        <td><?php echo htmlspecialchars($bill['total_price']); ?></td>
                        <td>
                            <p id="status"><?php
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
                                    echo htmlspecialchars($statusMapping[$bill['bill_status']]);
                                    ?></p>
                        </td>
                        <td><?php echo htmlspecialchars($bill['bill_time']); ?></td>
                        <form class="bill-form" id="form-<?=$bill['bill_id']?>">
                <input type="hidden" name="bill_id" value="<?=$bill['bill_id']?>">
                <input type="hidden" name="bill_status" value="<?=$bill['bill_status']?>">
                        </form>
                        <td>
                            <a href="?mod=bills&act=detail&id=<?php echo $bill['bill_id']; ?>"
                                class="btn btn-primary btn-sm">Chi Tiết Đơn Hàng</a>
                            <?php if ($bill['bill_status'] == 3) { ?>
                                <a href="?mod=bills&act=status&id=<?=$bill['bill_id']?>&status=4" class="btn btn-danger btn-sm">Approve</a><?php
                            }
                            if ($bill['bill_status'] == 6) {
                                ?><a href="?mod=bills&act=status&id=<?=$bill['bill_id']?>&status=7" class="btn btn-success btn-sm">Complete</a><?php
                            }
                            if($bill['bill_status'] == 7) {
                               ?><a href="?mod=bills&act=status&id=<?=$bill['bill_id']?>&status=8" class="btn btn-warning btn-sm">Archive</a>
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
</div>
</div>


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
            fetch('?mod=bills&act=api', {
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
</script>