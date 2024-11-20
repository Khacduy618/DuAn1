<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tổng hợp bình luận</title>
    <link rel="stylesheet" href="../assets/site/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/site/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h2 { text-align: center; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin: auto; font-size: 14px; }
        th, td { text-align: left; padding: 8px 12px; }
        th { background-color: #000; color: #fff; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        td button { background-color: #00aaff; color: #fff; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <h2>Tổng hợp bình luận</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Hàng hóa</th>
                <th>Số bình luận</th>
                <th>Cũ nhất</th>
                <th>Mới nhất</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reviews as $review): ?>
            <tr>
                <td><?= $review['product_name'] ?></td>
                <td><?= $review['review_count'] ?></td>
                <td><?= $review['oldest_review'] ?></td>
                <td><?= $review['latest_review'] ?></td>
                <td>
    <button class="details-button">
        <?php if (!empty($review['product_id'])): ?>
            <a href="?act=login&action=detail&product_id=<?=$review['product_id'] ?>" style="color: #fff; text-decoration: none;">
    Chi tiết <i class="la la-angle-right"></i>
</a>

        <?php else: ?>
            <span>Không có dữ liệu</span>
        <?php endif; ?>
    </button>
</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>