<?php
require_once __DIR__ . "/../Models/home.php";
class HomeController
{
    var $home_model;
    public function __construct()
    {
       $this->home_model = new HomeModel();
    }
    
    function list()
    {
        // $cat = $this->home_model->getSubCategories()
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

        // $trendingSell[] = ($this->home_model->listproduct_trendingSell(6, 0, 4))?? ["no data"];
        // $trendingSell[] = ($this->home_model->listproduct_trendingSell(6, 0, 5))?? ["no data"];
        // $trendingSell[] = ($this->home_model->listproduct_trendingSell(6, 0, 6))?? ["no data"];
        // $trendingSell[] = ($this->home_model->listproduct_trendingSell(6, 0, 7))?? ["no data"];
        // $trendingSell[] = ($this->home_model->listproduct_trendingSell(6, 0, 11))?? ["no data"];
        // array_unshift($trendingSell[0],["top-tv-tab"]); $trendingSell[0][] = ["top-tv-link"];
        // array_unshift($trendingSell[1],["top-computers-tab"]); $trendingSell[1][] = ["top-computers-link"];
        // array_unshift($trendingSell[2],["top-phones-tab"]); $trendingSell[2][] = ["top-phones-link"];
        // array_unshift($trendingSell[3],["top-watches-tab"]); $trendingSell[3][] = ["top-watches-link"];
        // array_unshift($trendingSell[4],["top-acc-tab"]); $trendingSell[4][] = ["top-acc-link"];
        $categories = [4, 5, 6, 7, 11];
        $categoryTabs = [
            "top-tv-tab" => "top-tv-link",
            "top-computers-tab" => "top-computers-link",
            "top-phones-tab" => "top-phones-link",
            "top-watches-tab" => "top-watches-link",
            "top-acc-tab" => "top-acc-link"
        ];
        foreach ($categories as $index => $categoryId) {
            $data = $this->home_model->listproduct_trendingSell(6, 0, $categoryId) ?? ["no data"];
            $trendingSell[] = $data;
            $tabKey = array_keys($categoryTabs)[$index];  
            $linkKey = $categoryTabs[$tabKey];             
            array_unshift($trendingSell[$index], [$tabKey]); 
            $trendingSell[$index][] = [$linkKey];         
        }

        // echo "<pre>";
        // print_r($trendingSell);
        // echo "</pre>";
       

        require_once('Views/index.php');
    }
}