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
                            Showing <span>9 of 56</span> Products
                        </div><!-- End .toolbox-info -->
                    </div><!-- End .toolbox-left -->

                    <div class="toolbox-right">
                        <div class="toolbox-sort">
                            <label for="sortby">Sort by:</label>
                            <div class="select-custom">
                                <select name="sortby" id="sortby" class="form-control">
                                    <option value="popularity" selected="selected">Most Popular</option>
                                    <option value="rating">Most Rated</option>
                                    <option value="date">Date</option>
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