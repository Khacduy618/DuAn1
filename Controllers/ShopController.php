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

        if (isset($_POST['keyword'])) {
            $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
            $product_cat = isset($_GET['product_cat']) ? $_GET['product_cat'] : 0;
            
            $orderdata = $this->shop_model->getPaginationAndOrderData();
            $data = $this->shop_model->loadall_product($keyword, $orderdata['orderCondition'], $product_cat, $orderdata['itemPerPage'], $orderdata['offset']);
            $data_noibat = $this->shop_model->products_topSell();
            $data_count = $this->shop_model->count_sp();
            $data_sum = $data_count;
        } else {
            $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
            $product_cat = isset($_GET['product_cat']) ? $_GET['product_cat'] : 0;
            $orderdata = $this->shop_model->getPaginationAndOrderData();
            $data = $this->shop_model-> loadall_product($keyword, $orderdata['orderCondition'], $product_cat, $orderdata['itemPerPage'], $orderdata['offset']);
            $data_count = $this->shop_model->count_sp();
            $data_sum = $data_count;
            
            }
        
        require_once('Views/index.php');
    }
}
?>