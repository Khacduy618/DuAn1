<?php
require_once("MVC/Models/review.php");
class ReviewController {

     private $review_model;
     
    public function __construct()
    {
        $this->review_model = new Review();
    }
    public function list() {
        $reviews = $this->review_model->getReviews();
        require_once 'MVC/Views/admin/index.php';
       
    }
     public function detail() {
        $id = $_GET['product_id'];
        if ($id) {
            $product = $this->review_model->findProductByID($id);
            if ($product) {
                $productName = $product['product_name'];  
            } else {
                $productName = 'khong co san pham';
            }
            $comments = $this->review_model->commentFindByProId($id);
            require_once  'MVC/Views/admin/index.php';  
            
        } else {
            echo 'Product ID không hợp lệ!';
        }
    }
    public function delete() {
        $commentID = $_GET['comment_id'];
        if ($commentID) {
            $this->review_model->delComment($commentID);
            header('location: ?mod=review');
        } else {
            echo "Có lỗi xảy ra khi xóa bình luận!";
        }
    }
}


?>