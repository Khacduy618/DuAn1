<?php
    if(!empty($_GET['msg'])){
        $msg = unserialize(urldecode($_GET['msg']));
        foreach($msg as $key => $value){
            echo '<span style="color:blue;font-weight:bold">'.$value.'</span>';
        }
    }
    if(!empty($_SESSION['msg'])){
        echo '<span style="color:blue;font-weight:bold">'.$_SESSION['msg'].'</span>';
        unset($_SESSION['msg']);
    }
?>
<div class="container-fluid py-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold">Edit Product</h2>
        </div>
        <div class="card-body">
            <?php
            if (isset($product) && is_array($product)) {
                extract($product);
            ?>
            <form action="?mod=product&act=update" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$product_id?>">
                <div class="row gap-3">
                    <!-- Product Name -->
                    <div class="col-md-5 mb-3">
                        <label for="product_name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="product_name" name="product_name" value="<?=$product_name?>" required>
                    </div>

                    <!-- Product Price -->
                    <div class="col-md-5 mb-3">
                        <label for="product_price" class="form-label">Price (VND) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="product_price" name="product_price" min="0" value="<?=$product_price?>" required>
                    </div>

                    <!-- Product Discount -->
                    <div class="col-md-5 mb-3">
                        <label for="product_discount" class="form-label">Discount (%)</label>
                        <input type="number" class="form-control" id="product_discount" name="product_discount" min="0" max="100" value="<?=$product_discount?>">
                    </div>

                    <!-- Product Stock -->
                    <div class="col-md-5 mb-3">
                        <label for="product_count" class="form-label">Stock Quantity</label>
                        <input type="number" class="form-control" id="product_count" name="product_count" min="0" value="<?=$product_count?>">
                    </div>

                    <!-- Product Category -->
                    <div class="col-md-5 mb-3">
                        <label for="product_cat" class="form-label">Category <span class="text-danger">*</span></label>
                        <select class="form-select" id="product_cat" name="product_cat" required>
                            <?php foreach($categories as $category): ?>
                                <option value="<?= $category['category_id'] ?>" <?php echo ($product_cat == $category['category_id']) ? 'selected' : ''; ?>>
                                    <?= $category['category_name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Product Status -->
                    <div class="col-md-5 mb-3">
                        <label class="form-label">Status</label>
                        <input type="checkbox" class="form-check-input" value="1" name="product_status" id="product_status" <?php echo ($product_status == 1) ? 'checked' : ''; ?>>
                        <label for="product_status">Active</label>
                    </div>

                    <!-- Product Image -->
                    <div class="col-5 mb-3">
                        <label for="product_img" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="product_img" name="product_img" accept="image/*">
                        <div class="form-text">Recommended size: 800x800 pixels</div>
                        <div class="mt-2">
                            <img src="<?php echo BASE_URL ?>/uploaded/<?=$product_img?>" class="img-thumbnail" style="max-height: 150px;" id="preview_imgProduct">
                        </div>
                    </div>
                </div>

                <!-- Form Buttons -->
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Product
                        </button>
                        <a href="?mod=product&act=list" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
            </form>
            <?php
            } else {
                echo '<p class="text-danger fw-bold">Product not found!</p>';
            }
            ?>
        </div>
    </div>
</div>

<!-- Image Preview Script -->
<script>
document.getElementById('product_img').onchange = function(evt) {
    const preview = document.getElementById('preview_imgProduct');
    const [file] = this.files;
    
    if (file) {
        preview.src = URL.createObjectURL(file);
    }
};
</script>
