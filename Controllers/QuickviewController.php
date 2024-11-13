<?php
require_once("Models/quickview.php");

class QuickviewController
{
    var $quickview_model;
    public function __construct()
    {
       $this->quickview_model = new Quickview();
    }
    
    function list()
    {
    $this->categoryController->renderCategoryMenu();

        require_once('Views/quickview.php');
    }
}