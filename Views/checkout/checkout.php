<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
    <div class="container">
        <h1 class="page-title">Checkout<span>Shop</span></h1>
    </div><!-- End .container -->
</div><!-- End .page-header -->
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?act=home">Home</a></li>
            <li class="breadcrumb-item"><a href="?act=cart">Cart</a></li>
            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->

<div class="page-content">
    <div class="checkout">
        <div class="container">
            <form action="?act=checkout&xuli=save" id='form_thanhtoan' method="POST">
                
                <div class="row">
                    <div class="col-lg-9">
                        <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Full Name *</label>
                                <input type="text" class="form-control" 
                                    placeholder="<?=$_SESSION['login']['user_name']?>" readonly>
                            </div><!-- End .col-sm-6 -->

                        </div><!-- End .row -->
                        <label>Email address *</label>
                        <input type="email" class="form-control" placeholder="<?=$_SESSION['login']['user_email']?>"
                            readonly>
                        <label for="phone">Phone *</label>
                        <input type="text" class="form-control" name="phone"
                            placeholder="<?=isset($_SESSION['login']['user_phone']) ? $_SESSION['login']['user_phone'] : ''?>" readonly>
                        <label>Company Name (Optional)</label>
                        <input type="text" class="form-control"
                            placeholder="<?=isset($address['address_name']) ? $address['address_name'] : ''?>" readonly>

                        <label>City *</label>
                        <input type="text" class="form-control"
                            placeholder="<?=isset($address['address_city']) ? $address['address_city'] : ''?>" readonly>

                        <label>Street address *</label>
                        <input type="text" class="form-control"
                            placeholder="<?=isset($address['address_street']) ? $address['address_street'] :''?> readonly"
                            readonly>
                        <?php if(!isset($_SESSION['login'])) {
                        ?>
                        <div class="custom-control custom-checkbox">
                            <a href="?act=taikhoan&xuli=dangky" class="custom-control-label">Create an account?</a>
                        </div><!-- End .custom-checkbox -->
                        <?php }
                        ?>

                        <label>Order notes (optional)</label>
                        <textarea class="form-control" cols="30" rows="4"
                            placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                    </div><!-- End .col-lg-9 -->
                    <aside class="col-lg-3">
                        <div class="summary">
                            <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

                            <table class="table table-summary">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th class="widthTH"></th>
                                        <th>Total</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $tong = 0;
                                        $_SESSION['cart_items'] = $cartItems;
                                        foreach ($cartItems as $item) {
                                            
                                            $ttien = $item['product_price'] * $item['quantity'];
                                            $tong += $ttien;
                                    ?>
                                    <tr>
                                        <td><a
                                                href="?act=product&id=<?=$item['pro_id']?>"><?=$item['product_name']?></a>
                                        </td>
                                        <td>x <?=$item['quantity']?></td>
                                        <td><?=number_format($ttien,0,",",".")?> đ</td>
                                    </tr>
                                    <?php }
                                ?>
                                    <?php
                                    $discount = $tong * (isset($coupon['coupon_discount']) / 100);
                                    $total = $tong - $discount + $shipping;
                                    ?>
                                    <tr class="summary-subtotal">
                                        <td>Subtotal:</td>
                                        <td></td>
                                        <td><?=number_format($tong,0,",",".")?> đ</td>
                                    </tr><!-- End .summary-subtotal -->
                                    <tr>
                                        <td>Shipping:</td>
                                        <td></td>
                                        <td><?=number_format($shipping,0,",",".")?>
                                            đ</td>
                                    </tr>
                                    <?php
                                    if(isset($coupon)){
                                ?>
                                    <tr class="summary-coupon">
                                        <td>Coupon:</td>
                                        <td><?=$coupon['coupon_name']?></td>
                                        <td class="discount-amount"><?=number_format($discount,0,",",".")?>
                                            đ</td>
                                    </tr>
                                    <?php }
                                ?>
                                    <tr class=" summary-total">
                                        <td>Total:</td>
                                        <td></td>
                                        <td><?=number_format($total,0,",",".")?>
                                            đ</td>
                                    </tr><!-- End .summary-total -->
                                </tbody>
                            </table><!-- End .table table-summary -->
                            <?php
                                                $paymentsMapping = [
                                                    1 => 'Cash on delivery',
                                                    2 => 'Direct bank transfer',
                                                    3 => 'PayPal',
                                                    4 => 'Credit Card (Stripe)'
                                                ];
                                        ?>
                            <div class="accordion-summary" id="accordion-payment">
                                <?php foreach ($paymentsMapping as $status => $statusText){?>
                                <div class="d-flex align-item-center">
                                    <input type="radio" id="bill_payment<?=$status?>" name="bill_payment"
                                        value="<?=$status?>">
                                    <label for="bill_payment<?=$status?>">
                                        <?=$statusText?>
                                    </label>
                                </div><!-- End .card -->
                                <?php } ?>
                            </div><!-- End .accordion -->
                            <input type="hidden" name="address_id" value="<?=$address['address_id']?>">
                            <input type="hidden" name="total" value="<?=$total?>">
                            <input type="hidden" name="tong" value="<?=$tong?>">
                            <input type="hidden" name="coupon_id" value="<?= isset($coupon['coupon_id']) ? $coupon['coupon_id'] : 0 ?>">
                            <input type="hidden" name="shipping" value="<?=$shipping?>">
                            <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                <span class="btn-text">Place Order</span>
                                <span class="btn-hover-text">Proceed to Checkout</span>
                            </button>
                        </div><!-- End .summary -->
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </form>
        </div><!-- End .container -->
    </div><!-- End .checkout -->
</div><!-- End .page-content -->