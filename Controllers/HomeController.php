<?php
require_once("Models/home.php");
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
        require_once('Views/index.php');
    }
}