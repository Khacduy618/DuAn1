<?php
require_once 'controllers/AdminThanhController.php';

$action = $_GET['action'] ?? 'index';
$controller = new AdminThanhController();

switch ($action) {
    case 'index':
        $reviews = $controller->index();
        include 'Views/admin_view_thanh/binhluan_list.php';
        break;

    case 'detail':
        $productId = $_GET['product_id'] ?? 0;
        if ($productId > 0) {
            $controller->detail($productId);
        } else {
            echo 'Product ID không hợp lệ!';
        }
        break;

    case 'delete':
        $commentId = $_GET['comment_id'] ?? 0;
        $controller->delete($commentId);
        break;

    default:
        echo "Hành động không hợp lệ!";
        break;
}

?>
