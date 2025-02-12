<div class="container">
    <div class="page-wrapper">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="la la-plus-circle"></i> Thêm Coupon mới</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="index.php?mod=coupon&act=store" class="form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="la la-tag"></i> Tên Coupon:</label>
                                <input type="text" name="coupon_name" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="la la-cubes"></i> Số lượng:</label>
                                <div class="input-group">
                                    <input type="number" name="coupon_count" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="la la-percent"></i> Giảm giá (%):</label>
                                <div class="input-group">
                                    <input type="number" name="coupon_discount" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="la la-calendar"></i> Ngày hết hạn:</label>
                                <input type="datetime-local" name="coupon_expiredate" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-footer mt-4 text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="la la-save"></i> Lưu Coupon
                        </button>
                        <a href="index.php?mod=coupon&act=list" class="btn btn-outline-secondary">
                            <i class="la la-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>