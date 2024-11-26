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
                                        0 => 'Unpaid', 
                                        1 => 'Paid', 
                                        2 => 'Pending', 
                                        3 => 'Approved', 
                                        4 => 'Delivering', 
                                        5 => 'Delivered', 
                                        6 => 'Completed', 
                                        7 => 'Archive' 
                                    ];
                                    echo htmlspecialchars($statusMapping[$bill['bill_status']]);
                                    ?></p>
                        </td>
                        <td><?php echo htmlspecialchars($bill['bill_time']); ?></td>
                        <form id="form-aaa" method="post">
                            <input type="hidden" name="bill_id" value="<?=$bill['bill_id']?>">
                            <input type="hidden" name="bill_status" value="<?=$bill['bill_status']?>">
                        </form>
                        <td>
                            <a href="?mod=bills&act=detail&id=<?php echo $bill['bill_id']; ?>"
                                class="btn btn-primary btn-sm">Chi Tiết Đơn Hàng</a>
                            <a href="?mod=bills&act=status&id=<?php echo $bill['bill_id']; ?>&status=completed"
                                class="btn btn-success btn-sm">Trạng Thái Đơn</a>

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
// API endpoint để xử lý dữ liệu (thay đổi theo cấu hình server)
const apiEndpoint = '?mod=bills&act=api';

// Hàm gửi dữ liệu qua AJAX
const sendData = () => {
    // Lấy form và dữ liệu trong form
    const form = document.getElementById('form-aaa');
    const formData = new FormData(form);

    // Chuyển FormData thành JSON để gửi qua API
    const data = {};
    formData.forEach((value, key) => {
        data[key] = value;
    });

    // Gửi yêu cầu qua Fetch API
    fetch(apiEndpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data), // Gửi dữ liệu dạng JSON
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log('Cập nhật thành công:', data);
        })
        .catch(error => {
            console.error('Lỗi khi cập nhật:', error);
        });
};
setTimeout(() => {
    sendData(); // Gửi lần đầu tiên
}, 5000);
setInterval(() => {
    location.reload();
}, 9000);
</script>