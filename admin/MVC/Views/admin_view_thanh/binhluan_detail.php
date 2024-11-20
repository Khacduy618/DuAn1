<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết bình luận</title>
    <link rel="stylesheet" href="../assets/site/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/site/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h2 { text-align: center; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin: auto; font-size: 14px; }
        th, td { text-align: left; padding: 8px 12px; }
        th { background-color: #000; color: #fff; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        td form { display: inline; }
        td button { background-color: #ff0000; color: #fff; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; }
        button a { color: #fff; text-decoration: none; }
    </style>
</head>
<body>
<h2>Chi tiết bình luận</h2>
<div class="table-container">
    <button class="btn-delete-selected">Xóa mục đã chọn</button>
    <span style="margin-left: 20px;">Hàng hóa: <strong><?= isset($productName) ? $productName : 'Không xác định'; ?></strong></span>
    
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
                        <form action="?act=login&action=delete&comment_id=<?= $comment['id']; ?>" method="POST">
                            <button class="delete-button" type="submit">
                                <i class="la la-trash"></i> Xóa
                            </button>
                        </form>
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
    <a href="?act=login">Quay lại</a>
</div>

</body>
</html>
