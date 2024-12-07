<div class="container mt-4">
    <h2 class="mb-4">Edit Blog Post</h2>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title"
                value="<?= htmlspecialchars($blog['blog_title']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="blog_pro_id" class="form-label">Related Product</label>
            <select class="form-select" id="blog_pro_id" name="blog_pro_id" required>
                <?php foreach ($products as $product) { ?>
                <option value="<?= $product['product_id'] ?>"
                    <?= ($product['product_id'] == $blog['blog_pro_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($product['product_name']) ?>
                </option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <div class="row align-items-center">
                <div class="col-auto">
                    <img src="../uploaded/<?= htmlspecialchars($blog['blog_image']) ?>" alt="Current image"
                        class="img-thumbnail" style="max-width: 100px;">
                </div>
                <div class="col">
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    <small class="text-muted">Leave empty to keep current image</small>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <div class="main-container">
                <textarea name="content" id="editor">
                 <?= htmlspecialchars($blog['blog_content']) ?>
                </textarea>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Author</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($blog['author_email']) ?>" readonly
                disabled>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" name="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Save Changes
            </button>
            <a href="?mod=blog&act=list" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Cancel
            </a>
        </div>
    </form>
</div>