<?php
require_once "Models/home.php";
class HomeController
{
     var $home_model;
    public function __construct()
    {
        $this->home_model = new Home();
    }

    function list()
    {
        $smartphone = $this->home_model->pro_category(1);
        $tablet = $this->home_model->pro_category(2);
        $Laptop = $this->home_model->pro_category(3);
        $cate = $this->home_model->getsCategory();

        $iphone =$this->home_model->cateproducts(4);
        $samsung =$this->home_model->cateproducts(5);
        $xiaomi =$this->home_model->cateproducts(6);
        $oppo =$this->home_model->cateproducts(7);
        $ipad =$this->home_model->cateproducts(8);
        $samsungtablet =$this->home_model->cateproducts(9);
        $macbook =$this->home_model->cateproducts(11);

        $trendingView[] =$this->home_model->listproduct_trendingView(6,0,4);
        $trendingView[] =$this->home_model->listproduct_trendingView(6,0,5);
        $trendingView[] =$this->home_model->listproduct_trendingView(6,0,6);
        $trendingView[] =$this->home_model->listproduct_trendingView(6,0,7);
        $trendingView[] =$this->home_model->listproduct_trendingView(6,0,11);

        $trendingSellAll =$this->home_model->listproduct_trendingSell_all();
        
        $trendingSell[] =$this->home_model->takeHotSell(6,0,4);
        $trendingSell[] =$this->home_model->takeHotSell(6,0,5);
        $trendingSell[] =$this->home_model->takeHotSell(6,0,6);
        
        $trendingSell[] =$this->home_model->takeHotSell(6,0,7);
        $trendingSell[] =$this->home_model->takeHotSell(6,0,11);
        require_once('Views/index.php');
    }
}