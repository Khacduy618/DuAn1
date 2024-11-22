<?php 
    require_once("MVC/Models/AdminVyModel.php");
    class AdminVyController {

        private $model;

        public function __construct()
        {
            $this->model = new AdminVyModel();
        }

        // Lấy danh sách người dùng
        public function list()
        {   
            
            $listuser = $this->model->getAllUser(); // Lấy dữ liệu từ model
            
             require_once("MVC/Views/admin/index.php");
        }

        public function add(){
            require_once("MVC/Views/admin/index.php");
        }


        // Thêm người dùng
        public function store()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Lấy dữ liệu từ form
                $user_name = $_POST['user_name'];
                $user_full_name = $_POST['user_full_name'];
                $user_email = $_POST['user_email'];
                $user_password = $_POST['user_password'];
                $user_phone = $_POST['user_phone'];

                // Lấy ảnh từ form (kiểm tra file ảnh có tồn tại)
                $user_images = $_FILES['user_images']['name'];  // Tên file ảnh
                $user_images_tmp = $_FILES['user_images']['tmp_name'];  // Đường dẫn tạm thời của file ảnh

                // Thêm người dùng vào cơ sở dữ liệu
                $this->model->addUser($user_name, $user_full_name, $user_email, $user_password, $user_phone, $user_images, $user_images_tmp);
                header('Location: ?act=listuser'); // Chuyển hướng sau khi thêm thành công
                exit;
            }
        }


        // Chỉnh sửa người dùng
        public function edit()
        {
            $user_email= $_GET['user_email'];
            $user = $this->model->getUserByEmail($user_email); // Lấy thông tin người dùng
            if (!$user) {
                // Nếu không tìm thấy người dùng, chuyển hướng về danh sách người dùng
                header('Location: ?act=list');
                exit;
            }
            require_once("MVC/Views/admin/index.php");
        }

        // Cập nhật người dùng
        public function update()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Lấy dữ liệu từ form
                $user_name = $_POST['user_name'];
                $user_email = $_POST['user_email'];
                $user_phone = $_POST['user_phone'];
                $user_role = $_POST['user_role'];
                $user_status = $_POST['user_status'];
                $current_user_images = $_POST['current_user_images']; // Ảnh cũ (nếu không có ảnh mới)

                // Lấy ảnh từ form (kiểm tra file ảnh có tồn tại)
                $user_images = $_FILES['user_images']['name'];  // Tên file ảnh
                $user_images_tmp = $_FILES['user_images']['tmp_name'];  // Đường dẫn tạm thời của file ảnh

                // Nếu không có ảnh mới, giữ ảnh cũ
                if (empty($user_images)) {
                    $user_images = $current_user_images;  // Giữ ảnh cũ
                }

                // Cập nhật người dùng
                $this->model->updateUser($user_name, $user_email, $user_phone, $user_images, $user_images_tmp, $user_role, $user_status);
                
                header('Location: ?mod=user&act=list'); // Chuyển hướng sau khi cập nhật thành công
                exit;
            }
        }


        // Xóa người dùng
        public function delete()
        {   
            $user_email = $_GET['user_email'];
            $this->model->deleteUser($user_email);
            header('Location: ?mod=user&act=list'); // Chuyển hướng sau khi xóa thành công
            exit;
        }

        // Xóa những người dùng được chọn
        public function deleteSelectedUsers()
        {
            if (!empty($_POST['user_email'])) {
                foreach ($_POST['user_email'] as $user_email) {
                    $this->model->deleteUser($user_email);
                }
            }
            header('Location: ?mod=user&act=listuser'); // Chuyển hướng sau khi xóa
            exit;
        }
    }
?>