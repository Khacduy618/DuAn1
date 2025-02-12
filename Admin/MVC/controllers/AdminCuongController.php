<?php 
    require_once __DIR__ . "/../Models/AdminCuongModel.php";
    class AdminCuongController {
    private $Blog;
    public $target_dir = '../uploaded/'; // Thư mục lưu ảnh

    public function __construct() {
        $this->Blog = new Blog(); // Khởi tạo đối tượng Blog
    }
    public function list() {
        $blogs = $this->Blog->All(); // Lấy tất cả blog
        
        require_once __DIR__ . "/../Views/admin/index.php"; // Gọi view
    }
    public function add(){
        if (isset($_POST['submit'])) { 
            $blog_title = $_POST['title']; // Lấy tiêu đề từ form
            $blog_image = $_FILES['image']['name']; // Lấy tên file ảnh
            $target_file = $this->target_dir . basename($blog_image); // Đường dẫn lưu ảnh
            // Kiểm tra kiểu tệp hợp lệ
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];

            // Kiểm tra tệp tải lên
            if (in_array($imageFileType, $valid_extensions)) {
                // Di chuyển tệp từ thư mục tạm thời đến thư mục đích
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    echo "The file " . htmlspecialchars($blog_image) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    return; // Dừng lại nếu có lỗi
                }
            } else {
                echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
                return; // Dừng lại nếu loại tệp không hợp lệ
            }
            $blog_pro_id = $_POST['blog_pro_id']; 
            $blog_content = $_POST['content'];
            $user_email = $_SESSION['login']['user_email']; // Lấy email từ session
            if($blog_title &&  $blog_image &&  $blog_content && $user_email ){
                $this->Blog->addBlog($blog_title, $blog_image, $blog_pro_id , $blog_content, $user_email);
                 header("Location: ?mod=blog&act=add"); 
            }
            else echo "Error" ;
            exit;
        }
        $products = $this->Blog->getAllProducts();
        $author_email = $this->Blog->getAuthor();
        // Gọi view thêm blog
        require_once __DIR__ . "/../Views/admin/index.php";
        }
        public function edit() {
            $blogId = $_GET['id'];
            $blog = $this->Blog->findByID($blogId);
            $products = $this->Blog->getAllProducts();
            if (isset($_POST['submit'])) {
                // Initialize image name with existing image
                $blog_image = $blog['blog_image'];
                if($_FILES['image']['name']){
                // Only process new image if one was uploaded
                $blog_image = $_FILES['image']['name']; // Lấy tên file ảnh
                
                $target_file = $this->target_dir . basename($blog_image); // Đường dẫn lưu ảnh
            // Kiểm tra kiểu tệp hợp lệ
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];

                 // Kiểm tra tệp tải lên
                 if (in_array($imageFileType, $valid_extensions)) {
                // Di chuyển tệp từ thư mục tạm thời đến thư mục đích
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    echo "The file " . htmlspecialchars($blog_image) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    return; // Dừng lại nếu có lỗi
                }
                } else {
                 echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
                 return; // Dừng lại nếu loại tệp không hợp lệ
               }
            }
                $blogData = [
                    'title' => $_POST['title'],
                    'image' => $blog_image,
                    'blog_pro_id' => $_POST['blog_pro_id'],
                    'content' => $_POST['content']
                ];
                if ($this->validateBlogData($blogData, false)) {
                    $this->Blog->editBlog(
                        $blogData['title'],
                        $blogData['image'],
                        $blogData['blog_pro_id'],
                        $blogData['content'],
                        $blogId
                    );
                    header("Location: ?mod=blog&act=list");
                    exit;
                }
            }
            require_once __DIR__ . "/../Views/admin/index.php";
        }
        
        private function validateBlogData($data, $checkEmail = true) {
            $required = ['title', 'content']; // Removed 'image' from required fields
            if ($checkEmail) {
                $required[] = 'user_email';
            }
        
            foreach ($required as $field) {
                if (empty($data[$field])) {
                    return false;
                }
            }
            return true;
        }
    public function soft_delete(){
         $id_blog = $_GET['id'];
         $this->Blog->softDeleteBlog($id_blog);
         header("Location: ?mod=blog&act=list"); 
    }
    public function recycle_bin(){
         $blogsDeleted = $this->Blog->getBlogsDeleted();
         require_once __DIR__ . "/../Views/admin/index.php"; 
    }
    public function back_up(){
         $id_blog = $_GET['id'];
         $this->Blog->back_up($id_blog);
         header("Location: ?mod=blog&act=recycle"); 
    }
    public function force_delete(){
         $id_blog = $_GET['id'];
         $this->Blog->forceDeleteBlog($id_blog);
         header("Location: ?mod=blog&act=recycle");
    }
}

class Comment{ 
    private $Blog;
    public $target_dir = '../uploaded/';
     public function __construct() {
        $this->Blog = new Blog(); // Khởi tạo đối tượng Blog
    }
    public function comment_index(){
        $id = $_GET['id'];
        $comments = $this->Blog->getAllCommentsById($id);
        require_once __DIR__ . "/../Views/admin/index.php"; 
    }
     public function soft_delete(){
         $id_comment = $_GET['id'];
         $this->Blog->softDeleteComment($id_comment);
         header("Location: ?mod=blog&act=list"); 
    }
    public function recycle_bin(){
         $comments = $this->Blog->getCommentsDeleted();
         require_once __DIR__ . "/../Views/admin/index.php"; 
    }
    public function back_up(){
         $id_comment = $_GET['id'];
         $this->Blog->comment_back_up($id_comment);
         header("Location: ?mod=comment&act=recycle"); 
    }
    public function force_delete(){
         $id_comment = $_GET['id'];
         $this->Blog->forceDeleteBlog($id_comment);
         header("Location: ?mod=blog&act=recycle");
    }
}
?>