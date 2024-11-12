<?php
require_once("Models/cart.php");
class CartController
{
    var $cart_model;
    public function __construct()
    {
        $this->cart_model = new Cart();
    }
    function list_cart()
    {
        
        require_once('Views/index.php');
    }
    function add_cart()
    {
      //xử lý add cart
    }
    function update_cart()
    {
       //xử lý update cart
    }
    function delete_cart()
    {
       //Xử lý delete cart
    }
    function deleteall_cart()
    {
        //Xử lý del all cart
    }
}