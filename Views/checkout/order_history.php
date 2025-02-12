<div class="order-history py-5 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <h2 class="fw-bold text-primary text-center">Your Orders</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Order History</li>
                    </ol>
                </nav>
            </div>
        </div>

        <?php if(isset($_SESSION['login']) && !empty($bill)): ?>
            <div class="card shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Order ID</th>
                                <th>Date</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($bill as $order): ?>
                                <tr>
                                    <td class="ps-4 fw-bold">#<?php echo $order['bill_var_id']; ?></td>
                                    <td><?php echo date('F d, Y', strtotime($order['bill_time'])); ?></td>
                                    <td class="fw-bold text-success"><?=number_format($order['bill_totalPrice'],0,",",".")?> đ</td>
                                    <td>
                                        <span class="badge-b rounded-pill <?php echo getStatusBadgeClass($order['bill_status']); ?>">
                                            <?php echo $order['status_name']; ?>
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                     <a class="btn btn-sm btn-outline-primary" href="javascript:void(0)" onclick="showBillDetails(<?=$order['bill_id']?>)">
                                            Details
                                        </a>
                                        
                                        <?php if($order['bill_status'] != 5 && $order['bill_status'] != 4): ?>
                                            <!-- <button class="btn btn-sm btn-outline-danger" 
                                                    onclick="cancelOrder(<?php echo $order['bill_var_id']; ?>)">
                                                <i class="fas fa-times me-1"></i> Cancel
                                            </button> -->
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else: ?>
            <div class="card shadow-sm">
                <div class="card-body text-center py-5">
                    <img src="assets/images/empty-order.svg" alt="No Orders" class="mb-4" style="width: 200px;">
                    <h4 class="text-secondary">No Orders Found</h4>
                    <p class="text-muted mb-4">Looks like you haven't placed any orders yet.</p>
                    <a href="index.php" class="btn btn-primary">
                        <i class="fas fa-shopping-bag me-2"></i>Start Shopping
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <div class="modal-body" id="orderDetailsContent">
                <!-- Nội dung chi tiết đơn hàng sẽ được load vào đây -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeOrderModal()">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
function showBillDetails(billId) {
    $.ajax({
        url: '?act=checkout&xuli=details&id=' + billId,
        type: 'GET',
        success: function(response) {
            $('#orderDetailsContent').html(response);
            $('#orderDetailsModal').modal('show');  
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
            alert('Có lỗi xảy ra khi tải thông tin đơn hàng');
        }
    });
}

function closeOrderModal() {
    $('#orderDetailsModal').modal('hide');
}
</script>
<style>
.badge-b {
    padding: 8px 16px;
    font-size: 12px;
    font-weight: 500;
}

.table {
    font-size: 14px;
}

.table td, .table th {
    padding: 1rem;
    vertical-align: middle;
}

.btn-sm {
    padding: 0.4rem 0.8rem;
    font-size: 13px;
}

.breadcrumb {
    font-size: 14px;
}

.card {
    border-radius: 10px;
    border: none;
}

.table-responsive {
    border-radius: 10px;
}

@media (max-width: 768px) {
    .table td, .table th {
        padding: 0.75rem;
    }
    
    .badge {
        padding: 6px 12px;
    }
}
</style>

<!-- <script>
function cancelOrder(orderId) {
    Swal.fire({
        title: 'Cancel Order',
        text: 'Are you sure you want to cancel this order?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, cancel it!',
        cancelButtonText: 'No, keep it'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `index.php?act=cancel_order&id=${orderId}`;
        }
    });
}
</script> -->

<?php
function getStatusBadgeClass($status) {
    switch ($status) {
        case 4: return 'bg-warning text-dark';   // Chờ xác nhận
        case 5: return 'bg-info text-white';     // Đang xử lý
        case 6: return 'bg-primary text-white';  // Đang giao hàng
        case 7: return 'bg-success text-white';  // Đã giao hàng
        case 8: return 'bg-danger text-white';   // Đã hủy
        default: return 'bg-secondary text-white';
    }
}
?>
