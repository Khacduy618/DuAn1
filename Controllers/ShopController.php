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

        if (isset($_GET['keyword'])) {
            $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
            $product_cat = isset($_GET['product_cat']) ? $_GET['product_cat'] : 0;
            $paren_id = isset($_GET['paren_id']) ? $_GET['paren_id'] : 0;
            
            $orderdata = $this->shop_model->getPaginationAndOrderData();
            $data = $this->shop_model->loadall_product($keyword, $orderdata['orderCondition'], $product_cat, $orderdata['itemPerPage'], $orderdata['offset']);
            $data_count = $this->shop_model->count_sp();
            $data_sum = $data_count;
        } else {
            $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
            $product_cat = isset($_GET['product_cat']) ? $_GET['product_cat'] : 0;
            $paren_id = isset($_GET['paren_id']) ? $_GET['paren_id'] : 0;
            
            $orderdata = $this->shop_model->getPaginationAndOrderData();
            $data = $this->shop_model-> loadall_product($keyword, $orderdata['orderCondition'], $product_cat, $orderdata['itemPerPage'], $orderdata['offset']);
            $data_count = $this->shop_model->count_sp();
            $data_sum = $data_count;
            
            }
        
        require_once('Views/index.php');
    }
}
?>