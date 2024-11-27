<div class="container-fluid">
    <!-- Header Section -->
    <div class="align-items-center mb-3">
        <h2>Products Management</h2>
    </div>
    <!-- Search and Filter Section -->
    <div class="row mb-3  justify-content-around">
        <div class="col-md-3">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" v-model="searchQuery" placeholder="Search items...">
            </div>
        </div>
    </div>

    <div class="row" id="1">
        <?php echo $renderTableProduct; ?>
    </div>
</div>