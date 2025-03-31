<?php
require_once("Models/shop.php");

class ShopController
{
    var $shop_model;
    
    public function __construct()
    {
        $this->shop_model = new Shop();
    }

    function list()
    {   
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        $product_cat = isset($_GET['product_cat']) ? $_GET['product_cat'] : 0;
        $paren_id = isset($_GET['paren_id']) ? $_GET['paren_id'] : 0;
        
        $orderdata = $this->shop_model->getPaginationAndOrderData();
        $data = $this->shop_model->loadall_product($keyword, $orderdata['orderCondition'], $product_cat, $orderdata['itemPerPage'], $orderdata['offset']);
        $data_count = $this->shop_model->count_sp();
        $data_sum = $data_count;
        
        // Lấy dữ liệu đánh giá
        require_once "Models/reviews.php";
        $reviewModel = new Review();
        
        // Lấy tất cả đánh giá từ database
        $allReviews = $this->getAllProductReviews($reviewModel);
        
        // Xử lý dữ liệu đánh giá
        $reviewsCount = [];
        $ratings = [];
        
        foreach ($allReviews as $review) {
            $productId = $review['product_id'];
            
            // Đếm số lượng đánh giá cho mỗi sản phẩm
            if (!isset($reviewsCount[$productId])) {
                $reviewsCount[$productId] = 0;
            }
            $reviewsCount[$productId]++;
            
            // Tính tổng số sao
            if (!isset($ratings[$productId])) {
                $ratings[$productId] = 0;
            }
            $ratings[$productId] += $review['rating'];
        }
        
        // Tính trung bình số sao
        foreach ($ratings as $productId => $totalRating) {
            if ($reviewsCount[$productId] > 0) {
                $ratings[$productId] = $totalRating / $reviewsCount[$productId];
            }
        }
        
        require_once('Views/index.php');
    }

    private function getAllProductReviews($reviewModel) {
        try {
            return $reviewModel->getAllProductReviews();
        } catch (Exception $e) {
            return [];
        }
    }
}
?>