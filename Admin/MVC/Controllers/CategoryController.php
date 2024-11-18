<?php
    require_once './Models/category.php';

    class CategoryController
    {
        var $category_model;
        function __construct()
        {
            $this->category_model = new Category();
        }

        public function list()
        {
            $data = array();
            $data = $this->category_model->All(); 
            require_once("MVC/Views/Admin/index.php");
        }

        public function add()
        {
            require_once("MVC/Views/Admin/index.php");
        }

        public function store()
        {
            $data = array(
                'category_name' => $_POST['category_name'],
                'category_desc' => $_POST['category_desc'],
                'category_img' => $_POST['category_img'],
                'parent_id' => $_POST['parent_id']
            );
            foreach ($data as $key => $value) {
                if (strpos($value, "'") != false) {
                    $value = str_replace("'", "\'", $value);
                    $data[$key] = $value;
                }
            }
            $this->category_model->store($data);
        }
        public function detail()
        {
            $id = isset($_GET['id']) ? $_GET['id'] : 5;
            $data = $this->category_model->findBy($id);
            require_once("MVC/Views/Admin/index.php");
        }
        public function delete()
        {
            if (isset($_GET['id'])) {
                $this->category_model->delete($_GET['id']);
            }
        }
        public function edit()
        {
            $id = isset($_GET['id']);
            $data = $this->category_model->findBy($id);
            require_once("MVC/Views/Admin/index.php");
        }
        public function update()
        {
            $data = array(
                'category_name' => $_POST['category_name'],
                'category_desc' => $_POST['category_desc'],
                'category_img' => $_POST['category_img'],
                'parent_id' => $_POST['parent_id']
            );
            foreach ($data as $key => $value) {
                if (strpos($value, "'") != false) {
                    $value = str_replace("'", "\'", $value);
                    $data[$key] = $value;
                }
            }
            $this->category_model->update($data);
        }

    }
    

?>