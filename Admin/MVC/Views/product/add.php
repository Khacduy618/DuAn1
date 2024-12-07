<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="m-0 font-weight-bold">Add New Product</h2>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <form action="?mod=product&act=store" method="POST" enctype="multipart/form-data">
                <div class="row gap-3">
                    <!-- Product Name -->
                    <div class="col-md-5 mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" required>
                    </div>

                    <!-- Product Price -->
                    <div class="col-md-5 mb-3">
                        <label for="product_price" class="form-label">Price (VND)</label>
                        <input type="number" class="form-control" id="product_price" name="product_price" min="0" required>
                    </div>

                    <!-- Product Discount -->
                    <div class="col-md-5 mb-3">
                        <label for="product_discount" class="form-label">Discount (%)</label>
                        <input type="number" class="form-control" id="product_discount" name="product_discount" min="0" max="100" value="0">
                    </div>

                    <!-- Product Stock -->
                    <div class="col-md-5 mb-3">
                        <label for="product_count" class="form-label">Stock Quantity</label>
                        <input type="number" class="form-control" id="product_count" name="product_count" min="0" value="0">
                    </div>

                    <!-- Product Category -->
                    <div class="col-md-5 mb-3">
                        <label for="product_cat" class="form-label">Category</label>
                        <select class="form-select" id="product_cat" name="product_cat" required>
                            <option value="">Select Category</option>
                            <?php foreach($categories as $category): ?>
                                <option value="<?= $category['category_id'] ?>">
                                    <?= $category['category_name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Product Status -->
                    <div class="col-md-5 mb-3">
                        <label class="form-label">Status</label>
                        <input type="checkbox" class="form-check-input" id="product_status" name="product_status">
                        <label for="product_status">Active</label>
                    </div>

                    <!-- Product Image -->
                    <div class="col-5 mb-3">
                        <label for="product_img" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="product_img" name="product_img" accept="image/*" required>
                        <div class="form-text">Recommended size: 800x800 pixels</div>
                    </div>

                    <!-- Preview Image -->
                    <div class="col-12 mb-3">
                        <div id="imagePreview" class="mt-2" style="max-width: 200px;">
                            <img id="preview_imgProduct" src="#" alt="Preview" style="max-width: 100%; display: none;">
                        </div>
                    </div>
                </div>

                <!-- Form Buttons -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-2"></i>Save Product
                    </button>
                    <a href="?mod=product&act=list" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Image Preview Script -->
<script>
document.getElementById('product_img').onchange = function(evt) {
    const preview = document.getElementById('preview_imgProduct');
    preview.style.display = 'block';
    const [file] = this.files;
    
    if (file) {
        preview.src = URL.createObjectURL(file);
    }
};
</script>
