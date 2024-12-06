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
        $related = $this->product_model->related_product($data['product_cat'], $data['product_id']);
        require_once('Views/index.php');
    }

}