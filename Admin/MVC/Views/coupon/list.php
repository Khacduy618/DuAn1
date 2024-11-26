<div class="container">
    <div class="page-wrapper">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title"><i class="la la-ticket"></i> Coupon List</h4>
                <a href="index.php?mod=coupon&act=add" class="btn btn-primary">
                    <i class="la la-plus-circle"></i> Add New Coupon
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th><i class="la la-hashtag"></i> ID</th>
                                <th><i class="la la-tag"></i> Coupon Name</th>
                                <th><i class="la la-cubes"></i> Quantity</th>
                                <th><i class="la la-percent"></i> Discount</th>
                                <th><i class="la la-calendar"></i> Expiry Date</th>
                                <th><i class="la la-cog"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($coupons as $coupon): ?>
                            <tr>
                                <td><?= $coupon['coupon_id'] ?></td>
                                <td><?= $coupon['coupon_name'] ?></td>
                                <td><span class="text-info"><?= $coupon['coupon_count'] ?></span></td>
                                <td><span class="text-success"><?= $coupon['coupon_discount'] ?>%</span></td>
                                <td><?= date('d/m/Y H:i', strtotime($coupon['coupon_expiredate'])) ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="index.php?mod=coupon&act=edit&id=<?= $coupon['coupon_id'] ?>"
                                            class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="la la-edit"></i>
                                        </a>
                                        <a href="index.php?mod=coupon&act=delete&id=<?= $coupon['coupon_id'] ?>"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this coupon?')" title="Delete">
                                            <i class="la la-trash"></i>
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
</div>