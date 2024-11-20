<?php
require_once __DIR__ . '/../Models/ReviewModel.php';
class ReviewController {
    public function index() {
        $reviewModel = new ReviewModel();
        $reviews = $reviewModel->getReviews(); 
        return $reviews;
    }
     public function detail($productId) {
    
        if ($productId) {
            $productModel = new ProductModel();
            $product = $productModel->getProductById($productId);  
            if ($product) {
                $productName = $product['product_name'];  
            } else {
                $productName = 'Không xác định'; 
            }
    
            
            $reviewModel = new ReviewModel();
            $comments = $reviewModel->getCommentsByProductId($productId);  
    
            require_once __DIR__ . '/../Views/binhluan_detail.php';  
        } else {
            echo 'Product ID không hợp lệ!';
        }
    }
    public function delete($commentId) {
        $reviewModel = new ReviewModel();
        if ($reviewModel->deleteCommentById($commentId)) {
            header('Location: ' . $_SERVER['HTTP_REFERER']); 
        } else {
            echo "Có lỗi xảy ra khi xóa bình luận!";
        }
    }
}


?>
