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
       //tạo các biến và gọi danh sách theo từng section ra vào các biến tại đây. ví dụ:
    //    $data_sanpham1 = $this->home_model->sanpham_danhmuc(0,8,1);
        require_once('Views/index.php');
    }
}