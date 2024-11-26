<div class="container-fluid p-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-pencil-square"></i> Create New Blog Post
            </h5>
        </div>
        
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-7 me-5">
                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="form-label fw-bold">
                                <i class="bi bi-type-h1"></i> Post Title
                            </label>
                            <input type="text" name="title" 
                                   class="form-control form-control-lg" 
                                   id="title" 
                                   placeholder="Enter post title"
                                   required>
                        </div>

                        <!-- Content -->
                        <div class="mb-4">
                            <label for="content" class="form-label fw-bold">
                                <i class="bi bi-file-text"></i> Content
                            </label>
                            <textarea name="content" 
                                      class="form-control" 
                                      id="content" 
                                      rows="12"
                                      placeholder="Write your blog content here..."
                                      required></textarea>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-4">
                        <!-- Image Upload -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="bi bi-image"></i> Featured Image
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="image-preview mb-3 text-center">
                                    <img id="preview" src="assets/img/placeholder.png" 
                                         class="img-fluid rounded" 
                                         style="max-height: 200px; display: none;">
                                </div>
                                <div class="input-group">
                                    <input name="image" 
                                           type="file" 
                                           class="form-control" 
                                           id="image"
                                           accept="image/*"
                                           required>
                                </div>
                                <small class="text-muted">
                                    Recommended size: 1200x630px, Max: 2MB
                                </small>
                            </div>
                        </div>

                        <!-- Product Selection -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="bi bi-tag"></i> Related Product
                                </h6>
                            </div>
                            <div class="card-body">
                                <select name="blog_pro_id" 
                                        class="form-select" 
                                        required>
                                    <option value="">Select a product...</option>
                                    <?php foreach ($products as $item): ?>
                                    <option value="<?= $item['product_id'] ?>">
                                        <?= htmlspecialchars($item['product_name']) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex gap-2 mt-3">
                    <button type="submit" name="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Publish Post
                    </button>
                    <a class="btn btn-outline-secondary" href="?mod=blog&act=list">
                        <i class="bi bi-arrow-left"></i> Back to List
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>