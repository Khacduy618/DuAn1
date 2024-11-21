<h2>Chi tiết bình luận</h2>
<div class="table-container">
    <button class="btn-delete-selected">Xóa mục đã chọn</button>
    <span style="margin-left: 20px;">Hàng hóa:
        <strong><?= isset($productName) ? $productName : 'Không xác định'; ?></strong></span>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th><input type="checkbox" /></th>
                <th>Đánh giá</th>
                <th>Nội dung</th>
                <th>Ngày BL</th>
                <th>Người BL</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($comments)): ?>
            <?php foreach ($comments as $comment): ?>
            <tr>
                <td><input type="checkbox" /></td>
                <td><?= $comment['rating']; ?> sao</td>
                <td><?= $comment['content']; ?></td>
                <td><?= $comment['date']; ?></td>
                <td><?= $comment['user']; ?></td>
                <td>
                    <a class="delete-button" onclick="return confirm('Are you sure about remove this review?');"
                        href="?mod=review&act=delete&comment_id=<?= $comment['id']; ?>">
                        <i class="la la-trash"></i> Xóa
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="6">Không có bình luận nào</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>


<div class="btn-back">
    <a href="index.php">Quay lại</a>
</div>