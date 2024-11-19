<h1 class="text-uppercase card-body">Trang quản trị</h1>

<div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers"><?=$total_user?></div>
                        <div class="cardName">Người dùng</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?=$total_dh?></div>
                        <div class="cardName">Đơn hàng</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?=$total_bl?></div>
                        <div class="cardName">Bình luận</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                    
                        <div class="numbers"><?=number_format($month_revenue,0,",",".")?>đ</div>
                        <div class="cardName">Doanh thu</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================ Charts ================= -->
            <?php
                require  'charts.php';
            ?>
            
            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h4>Đơn hàng hiện tại</h4>
                        <a href="../donhang" class="btn">Xem tất cả</a>
                    </div>
                    <?php
                        require 'orders.php';
                    ?>
                    
                </div>

                <!-- ================= New Customers ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h4>Người dùng hiện tại</h4>
                        <a href="../nguoidung" class="btn">Xem tất cả</a>
                    </div>

                    <?php
                        require 'users.php';
                    ?>
                </div>
            </div>