<?php
require_once "Models/home.php";
require_once "Models/reviews.php";

class HomeController
{
    var $home_model;
    var $review_model;

    public function __construct()
    {
        // Khởi tạo các model
        $this->home_model = new Home();
        $this->review_model = new Review();
    }

    function list()
    {
        // Lấy các sản phẩm theo danh mục
        $smartphone = $this->home_model->pro_category(1);
        $tablet = $this->home_model->pro_category(2);
        $Laptop = $this->home_model->pro_category(3);
        $iphone = $this->home_model->cateproducts(4);
        $samsung = $this->home_model->cateproducts(5);
        $xiaomi = $this->home_model->cateproducts(6);
        $oppo = $this->home_model->cateproducts(7);
        $ipad = $this->home_model->cateproducts(8);
        $samsungtablet = $this->home_model->cateproducts(9);
        $macbook = $this->home_model->cateproducts(11);


        // Các sản phẩm giảm giá và yêu thích
        $sale_product = $this->home_model->pro_discount();
        $favorite_rv = $this->home_model->favorite_reviews();
        $sell_pr = $this->home_model->Selling_product();
        $New_pr = $this->home_model->New_Product();
        $reviewsByProduct = [];
        $ratings = [];
        $reviewsCount = [];
        $products = array_merge(
            $smartphone,
            $tablet,
            $Laptop,
            $iphone,    
            $samsung,
            $xiaomi,
            $oppo,
            $ipad,
            $samsungtablet,
            $macbook
        );

        foreach ($products as $product) {
            $reviews = $this->review_model->getReviewsByProduct($product['product_id'], 'latest'); 
            $reviewsByProduct[$product['product_id']] = $reviews;

            $ratingData = $this->review_model->getAverageRating($product['product_id']);
            $ratings[$product['product_id']] = $ratingData['rating'];
            $reviewsCount[$product['product_id']] = $ratingData['count'];
        }
        require_once('Views/index.php');
    }
}
?>