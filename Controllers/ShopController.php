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
        // $data = $this->shop_model->listpro(1);
        require_once('Views/index.php');
    }
}