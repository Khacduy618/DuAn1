<?php
require_once("MVC/Models/product.php");
require_once("MVC/Models/category.php");
require_once("MVC/Models/adminVyModel.php");
class ProductController
{
    public $product_model;
    public $category_model;
    public function __construct()
    {
        $this->product_model = new product();
        $this->category_model = new Category();
        $this->adminVyModel = new adminVyModel();
    }
    public function list()
    {
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';
        $product_cat = isset($_GET['product_cat']) ? $_GET['product_cat'] : '';
        $orderdata = $this->product_model->getPaginationAndOrderData();
        $data = $this->product_model->list($keyword, $orderdata['orderCondition'], $product_cat, $status, $orderdata['itemPerPage'], $orderdata['offset']);
        $data_count = $this->product_model->count_sp();
        $data_sum = $data_count;
        $categories = $this->category_model->All();
        require_once("MVC/Views/admin/index.php");
    }

    public function add(){
        $categories = $this->category_model->All();
        require_once("MVC/Views/admin/index.php");
    }

    public function store(){
        if (empty($_POST['product_name']) || empty($_POST['product_price']) || empty($_POST['product_discount']) || empty($_POST['product_count']) || empty($_POST['product_cat']))  {
            $_SESSION['msg'] = 'Fill in all required fields!';
            header('Location: ?mod=product&act=add');
            exit;
        }
        
        try {
            $name = $_POST['product_name'];
            $price = $_POST['product_price'];
            $discount = $_POST['product_discount'];
            $count = $_POST['product_count'];
            $cat = $_POST['product_cat'];
            $status = isset($_POST['product_status']) ? 1 : 0;
            
            $product_img = $_FILES['product_img']['name'];
            $product_img_tmp = $_FILES['product_img']['tmp_name'];
            $product_img = $this->adminVyModel->handleImageUpload($product_img, $product_img_tmp);
            
            $this->product_model->store($name, $price, $discount, $count, $cat, $status, $product_img);
            
            $_SESSION['msg'] = 'Product added successfully!';
            header('Location: ?mod=product&act=list');
            exit;
        } catch (Exception $e) {
            $_SESSION['msg'] = 'Failed to add product! Error: ' . $e->getMessage();
            header('Location: ?mod=product&act=add');
            exit;
        }
    }

    public function edit(){
        $id = $_GET['id'];
        $product = $this->product_model->edit($id);
        $categories = $this->category_model->All();
        require_once("MVC/Views/admin/index.php");
    }
    
    public function delete(){
        $id = $_GET['id'];
        $this->product_model->delete($id);
        header('Location: ?mod=product&act=list');
        exit;
    }

    public function update(){
        $id = $_POST['id'];
        $name = $_POST['product_name'];
        $price = $_POST['product_price'];
        $discount = $_POST['product_discount'];
        $count = $_POST['product_count'];
        $cat = $_POST['product_cat'];
        $status = isset($_POST['product_status']) ? 1 : 0;

        if (!empty($_FILES['product_img']['name'])) {
            $product_img = $_FILES['product_img']['name'];
            $product_img_tmp = $_FILES['product_img']['tmp_name'];
            $product_img = $this->adminVyModel->handleImageUpload($product_img, $product_img_tmp);
        } else {
            $current_product = $this->product_model->edit($id);
            $product_img = $current_product['product_img'];
        }
        
        try {
            $this->product_model->update($id, $name, $price, $discount, $count, $cat, $status, $product_img);
            
            $_SESSION['msg'] = 'Product updated successfully!';
            header('Location: ?mod=product&act=list');
            exit;
        } catch (Exception $e) {
            $_SESSION['msg'] = 'Failed to update product! Error: ' . $e->getMessage();
            header('Location: ?mod=product&act=edit&id=' . $id);
            exit;
        }
    }
     
   
}