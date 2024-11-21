<?php
require_once("MVC/Models/product.php");
class ProductController
{
    var $product_model;
    public function __construct()
    {
        $this->product_model = new product();
    }
    public function list()
    {
        $data = $this->product_model->All();
        require_once("MVC/Views/admin/index.php");
    }
     
   
}