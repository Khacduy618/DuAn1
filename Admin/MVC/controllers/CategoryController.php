<?php
    require_once 'MVC/Models/category.php';
    require_once 'MVC/Models/AdminVyModel.php';

    class CategoryController{
        private $model;
        private $adminVyModel;
        public function __construct(){
            $this->model = new Category();
            $this->adminVyModel = new AdminVyModel();
        }   



        public function list($keyword="", $status="", $orderCondition="", $item_per_page="", $offset=""){
            $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
            $status = isset($_GET['status']) ? $_GET['status'] : '';
            $orderdata = $this->model->getPaginationAndOrderData();
            $categories = $this->model->list($keyword, $status, $orderdata['orderCondition'], $orderdata['itemPerPage'], $orderdata['offset']);
            $data_count = $this->model->count_category();
            $data_sum = $data_count;
            require_once 'MVC/Views/admin/index.php';
        }

        public function add(){
            $parent_categories = $this->model->list_parent();
            require_once 'MVC/Views/admin/index.php';
        }

        public function store(){
            if (empty($_POST['category_name']) || empty($_POST['category_desc']))  {
                $_SESSION['msg'] = 'Fill in all required fields!';
                header('Location: ?mod=category&act=add');
                exit;
            }
            
            try {
                $name = $_POST['category_name'];
                $desc = $_POST['category_desc'];
                $parent_id = (!empty($_POST['parent_id'])) ? $_POST['parent_id'] : NULL;
                $status = isset($_POST['category_status']) ? 1 : 0;
                
                $category_img = $_FILES['category_img']['name'];
                $category_img_tmp = $_FILES['category_img']['tmp_name'];
                $category_img = $this->adminVyModel->handleImageUpload($category_img, $category_img_tmp);
                
                $this->model->store($name, $desc, $parent_id, $status, $category_img);
                
                $_SESSION['msg'] = 'Category added successfully!';
                header('Location: ?mod=category&act=list');
                exit;
            } catch (Exception $e) {
                $_SESSION['msg'] = 'Failed to add category! Error: ' . $e->getMessage();
                header('Location: ?mod=category&act=add');
                exit;
            }
        }

        public function delete(){
            $id = $_POST['id'];
            $this->model->delete($id);
            header('Location: ?mod=category&act=list');
            exit;
        }

        public function edit(){
            $id = $_GET['id'];
            $parent_categories = $this->model->list_parent();
            $category = $this->model->edit($id);
            require_once 'MVC/Views/admin/index.php';
        }

        public function update() {
            // Kiểm tra có ID không
            if (!isset($_POST['id'])) {
                $_SESSION['msg'] = 'Category ID not found!';
                header('Location: ?mod=category&act=list');
                exit;
            }

            $id = $_POST['id'];
            
            if (empty($_POST['category_name']) || empty($_POST['category_desc'])) {
                $_SESSION['msg'] = 'Please fill in all required fields!';
                header('Location: ?mod=category&act=edit&id='.$id);
                exit;
            }
            
            try {
                // Lấy thông tin category hiện tại
                $current_category = $this->model->edit($id);
                if (!$current_category) {
                    throw new Exception("Category not found!");
                }

                $name = $_POST['category_name'];
                $desc = $_POST['category_desc'];
                $parent_id = (!empty($_POST['parent_id'])) ? $_POST['parent_id'] : NULL;
                $status = isset($_POST['category_status']) ? 1 : 0;
                
                // Xử lý ảnh
                $category_img = $current_category['category_img']; // Giữ ảnh cũ
                
                if (!empty($_FILES['category_img']['name'])) {
                    $category_img = $_FILES['category_img']['name'];
                    $category_img_tmp = $_FILES['category_img']['tmp_name'];
                    $category_img = $this->adminVyModel->handleImageUpload($category_img, $category_img_tmp);
                }
                
                // Debug information
                error_log("Updating category: ID=$id, Name=$name, Desc=$desc, Parent=$parent_id, Status=$status, Image=$category_img");
                
                $result = $this->model->update($id, $name, $desc, $parent_id, $status, $category_img);
                
                if ($result) {
                    $_SESSION['msg'] = 'Category updated successfully!';
                    header('Location: ?mod=category&act=list');
                } else {
                    throw new Exception("Update failed!");
                }
                exit;
            } catch (Exception $e) {
                $_SESSION['msg'] = 'Failed to update category! Error: ' . $e->getMessage();
                header('Location: ?mod=category&act=edit&id='.$id);
                exit;
            }
        }

       

        
    }

?>