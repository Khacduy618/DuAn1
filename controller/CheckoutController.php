<?php
require_once("Models/checkout.php");
class CheckoutController
{
    var $checkout_model;
    public function __construct()
    {
        $this->checkout_model = new Checkout();
    }
    function list()
    {
      //Xử lý
    }
    function  save()
    {
       //
    }
    function order_complete()
    {
       //
        require_once('view/index.php');
    }
}
