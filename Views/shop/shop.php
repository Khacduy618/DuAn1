<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
    <div class="container">
        <h1 class="page-title"><span>Shop</span></h1>
    </div><!-- End .container -->
</div><!-- End .page-header -->
<nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Shop</li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="toolbox">
                    <div class="toolbox-left">
                        <div class="toolbox-info">
                            <?php
                                // Calculate the total number of products to display based on pagination
                                $total_products = $orderdata['totalRecord'];
                                $per_page =0;
                                $current_start = ($orderdata['currentPage'] - 1) * $per_page + 1;
                                $current_end = min($current_start + count($data) - 1, $total_products); // end index for current page

                                // Display total products count and range
                                if ($total_products > 0) {
                                    echo "<p class='product-count'>Showing <span>$current_end</span> of <span>$total_products</span> products</p>";
                                } else {
                                    echo "<span class='product-count'>No products available</span>";
                                }
                                ?>
                        </div><!-- End .toolbox-info -->
                    </div><!-- End .toolbox-left -->

                    <div class="toolbox-right">
                        <div class="toolbox-sort">
                            <label for="sortby">Sort by:</label>
                            <div class="select-custom">
                                <select name="sortby" id="sortby" class="form-control"
                                    onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                    <option value="0" selected="selected">Choose</option>
                                    <option
                                        value="index.php?act=shop&product_cat=<?= $_GET['product_cat'] ?? 0 ?>&per_page=<?= $_GET['per_page'] ?? 12 ?>&page=<?= $_GET['page'] ?? 1 ?>&field=created_at&sort=desc"
                                        <?= (isset($_GET['field']) && $_GET['field'] == 'created_at' && isset($_GET['sort']) && $_GET['sort'] == 'desc') ? 'selected' : '' ?>>
                                        Newest
                                    </option>
                                    <option
                                        value="index.php?act=shop&product_cat=<?= $_GET['product_cat'] ?? 0 ?>&per_page=<?= $_GET['per_page'] ?? 12 ?>&page=<?= $_GET['page'] ?? 1 ?>&field=total_sold&sort=desc"
                                        <?= (isset($_GET['field']) && $_GET['field'] == 'total_sold' && isset($_GET['sort']) && $_GET['sort'] == 'desc') ? 'selected' : '' ?>>
                                        Best Selling
                                    </option>
                                    <option
                                        value="index.php?act=shop&product_cat=<?= $_GET['product_cat'] ?? 0 ?>&per_page=<?= $_GET['per_page'] ?? 12 ?>&page=<?= $_GET['page'] ?? 1 ?>&field=product_price&sort=asc"
                                        <?= (isset($_GET['field']) && $_GET['field'] == 'product_price' && isset($_GET['sort']) && $_GET['sort'] == 'asc') ? 'selected' : '' ?>>
                                        Price: Low to High
                                    </option>
                                    <option
                                        value="index.php?act=shop&product_cat=<?= $_GET['product_cat'] ?? 0 ?>&per_page=<?= $_GET['per_page'] ?? 12 ?>&page=<?= $_GET['page'] ?? 1 ?>&field=product_price&sort=desc"
                                        <?= (isset($_GET['field']) && $_GET['field'] == 'product_price' && isset($_GET['sort']) && $_GET['sort'] == 'desc') ? 'selected' : '' ?>>
                                        Price: High to Low
                                    </option>
                                </select>
                            </div>
                        </div><!-- End .toolbox-sort -->
                        <div class="toolbox-layout">
                            <a href="category-list.html" class="btn-layout">
                                <svg width="16" height="10">
                                    <rect x="0" y="0" width="4" height="4" />
                                    <rect x="6" y="0" width="10" height="4" />
                                    <rect x="0" y="6" width="4" height="4" />
                                    <rect x="6" y="6" width="10" height="4" />
                                </svg>
                            </a>

                            <a href="category-2cols.html" class="btn-layout">
                                <svg width="10" height="10">
                                    <rect x="0" y="0" width="4" height="4" />
                                    <rect x="6" y="0" width="4" height="4" />
                                    <rect x="0" y="6" width="4" height="4" />
                                    <rect x="6" y="6" width="4" height="4" />
                                </svg>
                            </a>

                            <a href="category.html" class="btn-layout">
                                <svg width="16" height="10">
                                    <rect x="0" y="0" width="4" height="4" />
                                    <rect x="6" y="0" width="4" height="4" />
                                    <rect x="12" y="0" width="4" height="4" />
                                    <rect x="0" y="6" width="4" height="4" />
                                    <rect x="6" y="6" width="4" height="4" />
                                    <rect x="12" y="6" width="4" height="4" />
                                </svg>
                            </a>

                            <a href="category-4cols.html" class="btn-layout active">
                                <svg width="22" height="10">
                                    <rect x="0" y="0" width="4" height="4" />
                                    <rect x="6" y="0" width="4" height="4" />
                                    <rect x="12" y="0" width="4" height="4" />
                                    <rect x="18" y="0" width="4" height="4" />
                                    <rect x="0" y="6" width="4" height="4" />
                                    <rect x="6" y="6" width="4" height="4" />
                                    <rect x="12" y="6" width="4" height="4" />
                                    <rect x="18" y="6" width="4" height="4" />
                                </svg>
                            </a>
                        </div><!-- End .toolbox-layout -->
                    </div><!-- End .toolbox-right -->
                </div><!-- End .toolbox -->

                <?php
                    require_once 'list-produts.php';
                ?>

            </div><!-- End .col-lg-9 -->
            <!-- Sidebar -->
            <?php
                require_once 'sidebar.php';
            ?>
            <!-- End sitebar -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End .page-content -->