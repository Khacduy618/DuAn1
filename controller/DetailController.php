<?php
require_once("Models/Detail.php");
class DetailController
{
    var $detail_model;
    public function __construct()
    {
       $this->detail_model = new Detail();
    }
    
    function list()
    {

        // Xử lý data categories
        $id = $_GET['id'];

        $data = $this->detail_model->detail_sp($id);

        // Xử lý data sp liên quan
        require_once('view/index.php');
    }
}