<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="m-0 font-weight-bold">
            Coupon Management
        </h2>
        <a href="index.php?mod=coupon&act=add" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle me-2"></i> Add New Coupon
        </a>
    </div>

    <!-- Alert Messages -->
    <div class="messages mb-4">
        <?php
        if(!empty($_GET['msg'])){
            $msg = unserialize(urldecode($_GET['msg']));
            foreach($msg as $key => $value){
                echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                        '.$value.'
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }
        }
        ?>
    </div>

    <!-- Table Section -->
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th width="10%" class="text-center">ID</th>
                            <th width="25%">Coupon Name</th>
                            <th width="15%" class="text-center">Quantity</th>
                            <th width="15%" class="text-center">Discount</th>
                            <th width="20%" class="text-center">Expiry Date</th>
                            <th width="15%" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($coupons as $coupon): ?>
                        <tr>
                            <td class="text-center"><?= $coupon['coupon_id'] ?></td>
                            <td>
                                <span class="fw-semibold"><?= $coupon['coupon_name'] ?></span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-info"><?= $coupon['coupon_count'] ?></span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-success"><?= $coupon['coupon_discount'] ?>%</span>
                            </td>
                            <td class="text-center">
                                <span class="text-muted"><?= date('d/m/Y H:i', strtotime($coupon['coupon_expiredate'])) ?></span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="index.php?mod=coupon&act=edit&id=<?= $coupon['coupon_id'] ?>"
                                        class="btn btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="index.php?mod=coupon&act=delete&id=<?= $coupon['coupon_id'] ?>"
                                        class="btn btn-outline-danger"
                                        onclick="return confirm('Are you sure you want to delete this coupon?')" 
                                        title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>