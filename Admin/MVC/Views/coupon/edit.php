<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card custom-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="la la-edit"></i> Edit Coupon
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="index.php?mod=coupon&act=update" class="needs-validation" novalidate>
                        <input type="hidden" name="coupon_id" value="<?= $coupon['coupon_id'] ?>">

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" 
                                           class="form-control" 
                                           id="couponName"
                                           name="coupon_name" 
                                           placeholder="Enter coupon name"
                                           value="<?= $coupon['coupon_name'] ?>" 
                                           required>
                                    <label for="couponName">
                                        <i class="la la-tag"></i> Coupon Name
                                    </label>
                                    <div class="invalid-feedback">
                                        Please enter a coupon name
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" 
                                           class="form-control" 
                                           id="quantity"
                                           name="coupon_count" 
                                           placeholder="Enter quantity"
                                           value="<?= $coupon['coupon_count'] ?>" 
                                           required>
                                    <label for="quantity">
                                        <i class="la la-cubes"></i> Quantity
                                    </label>
                                    <div class="invalid-feedback">
                                        Please enter a valid quantity
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" 
                                           class="form-control" 
                                           id="discount"
                                           name="coupon_discount" 
                                           placeholder="Enter discount"
                                           value="<?= $coupon['coupon_discount'] ?>" 
                                           required>
                                    <label for="discount">
                                        <i class="la la-percent"></i> Discount (%)
                                    </label>
                                    <div class="invalid-feedback">
                                        Please enter a valid discount percentage
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="datetime-local" 
                                           class="form-control" 
                                           id="expiryDate"
                                           name="coupon_expiredate" 
                                           value="<?= date('Y-m-d\TH:i', strtotime($coupon['coupon_expiredate'])) ?>" 
                                           required>
                                    <label for="expiryDate">
                                        <i class="la la-calendar"></i> Expiry Date
                                    </label>
                                    <div class="invalid-feedback">
                                        Please select an expiry date
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center gap-3 mt-4 pt-4 border-top">
                            <button type="submit" class="btn btn-gradient px-4 py-2">
                                <i class="la la-save"></i> Update
                            </button>
                            <a href="index.php?mod=coupon&act=list" 
                               class="btn btn-light px-4 py-2">
                                <i class="la la-arrow-left"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>