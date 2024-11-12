<?php
require_once __DIR__ . "/../Models/home.php";
class HomeController
{
    var $home_model;
    public function __construct()
    {
       $this->home_model = new Home();
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

        // var_dump($iphone);
        require_once('Views/index.php');
    }
}