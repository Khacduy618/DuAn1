<?php
require_once("Models/product.php");

class ProductController
{
    var $product_model;

    public function __construct()
    {
       $this->product_model = new Product();
    }
    
    function list() {
        $id = isset($_GET["id"]) ? $_GET["id"] : 0;
        $data = $this->product_model->findById($id);
        require_once('Views/index.php');
    }
}