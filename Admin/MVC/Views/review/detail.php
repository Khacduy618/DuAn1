<div class="review-container">
    <h2 class="page-title">Review Details</h2>
    
    <div class="product-info">
        <span class="me-3">Product: <strong><?= isset($productName) ? $productName : 'Undefined'; ?></strong></span>
        <button class="btn btn-danger btn-delete-selected <?=!isset($_SESSION['privilege']['review']['delete']) ? 'disabled' : ''?>">
            <i class="la la-trash"></i> Delete Selected
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th width="5%"><input type="checkbox" class="select-all" /></th>
                    <th width="10%">Rating</th>
                    <th width="45%">Content</th>
                    <th width="15%">Date</th>
                    <th width="15%">User</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($comments)): ?>
                    <?php foreach ($comments as $comment): ?>
                    <tr>
                        <td><input type="checkbox" class="review-checkbox" /></td>
                        <td>
                            <div class="rating">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <i class="la la-star <?= $i <= $comment['rating'] ? 'checked' : '' ?>"></i>
                                <?php endfor; ?>
                            </div>
                        </td>
                        <td><?= $comment['content']; ?></td>
                        <td><?= $comment['date']; ?></td>
                        <td><?= $comment['user']; ?></td>
                        <td>
                            <a class="btn btn-sm btn-danger delete-button <?=!isset($_SESSION['privilege']['review']['delete']) ? 'disabled' : ''?>" 
                               onclick="return confirm('Are you sure you want to delete this review?');"
                               href="?mod=review&act=delete&comment_id=<?= $comment['id']; ?>">
                                <i class="la la-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No reviews found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="btn-back">
        <a href="?mod=review" class="btn btn-secondary">
            <i class="la la-arrow-left"></i> Back
        </a>
    </div>
</div>