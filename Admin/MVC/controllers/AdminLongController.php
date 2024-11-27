<?php
// spl_autoload_register(function($class){
//     include_once('./libs/'.$class.'.php');
// });
class AdminLongController extends Dcontroller{
    private $model = "AdminLongModel";
    private $table = "user";
    private $tableProduct = "products";
    private $tableCategoryProduct = "categories";
    private $tableProductsDetails = "products_details";
    private $controllerHasError = '?mod=product&act=list_product';
    private $part_upload = '../uploaded/'; //"assets/upload/user_imgs/" bản không team
    private $role_default = 0;
    private $keySecurity = "123";
    private $userimages_default = "user.png";

    public function __construct()
        {
            $message = array();
            $msg = '';
            $data = array();
            parent::__construct();
            
        }

        protected function set_role_default($role){ $this->role_default = $role; }

        public function index(){
            $this->login();

        }
        public function login(){
            //$this->load->view('cpanel/header');
            // Session::init();
            // if(Session::get("Login")==true){
            //     header("Location: ?act=adminLong&ctlr=AdminLongController&method=dashboard");
            //     // này khoi đang nhập zo cho lẹ , nhớ tắt
            // }
            $this->load->view('cpanel/login');

            //$this->load->view('cpanel/footer');
        }

                                                                                                                                                                                                                                                                                                                                                protected function getSecurity($input){
                                                                                                                                                                                                                                                                                                                                                    return parent::getSecurityEncryption($input,$this->keySecurity);
                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                protected function setSecurity($data_set){
                                                                                                                                                                                                                                                                                                                                                    return parent::setSecurityEncryption($data_set,$this->keySecurity);
                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                protected function getDecryptArray($result){
                                                                                                                                                                                                                                                                                                                                                    return parent::decryptArray($result, $this->keySecurity);
                                                                                                                                                                                                                                                                                                                                                }
        
        public function sign_up(){

            //$this->load->view('cpanel/header');
            // Session::init();
            if(Session::get("Login")==true && Session::get('userrole') === 9){
                header("Location: ?act=adminLong&ctlr=AdminLongController&method=dashboard");
                return;
            }
            $this->load->view('cpanel/signup');

            //$this->load->view('cpanel/footer');
        }

        public function dashboard(){
            Session::checkSession();
            $this->load->view('cpanel/header');
            $this->load->view('cpanel/menu');
            $this->load->view('cpanel/dashboard');
            $this->load->view('cpanel/footer');
        }
        public function dashboard2() {
            Session::checkSession2();
            $current_page = 0; $limit =0; $offset = 0;
            $current_page = isset($_GET['current_page']) ? (int)$_GET['current_page'] : 1; // Lấy trang hiện tại
            $limit = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 6; // Số mục trên mỗi trang
            $offset = ($current_page - 1) * $limit; // Tính offset để truy vấn
            
        
            // Lấy dữ liệu sản phẩm theo trang
            $admin = new Admin();
            $data = $admin->index($offset, $limit,$current_page);
        
            // Truyền dữ liệu vào view
            $this->load->view('cpanel2/dashboard2', ['renderTableProduct' => $data]);
        }

        // public function non_dashboard(){
        //     echo 'this is non-dashboard';
        // }

        

        public function auttc_login(){ // authentication_login
            parent::check_server_method('POST',$this->controllerHasError);
            parent::ciipv('username', 3, $this->controllerHasError);
            parent::ciipv('password', 3, $this->controllerHasError);
            $username = $this->setSecurity($_POST['username']);
            $password = md5($_POST['password']);
            $loginmodel = $this->load->model($this->model);

            $count = $loginmodel->login($this->table,$username,$password);
            
            if($count==0){
                Session::set('msg','Tài khoản hoặc mật khẩu sai xin hãy kiểm tra lại');
                header("Location: ?act=adminLong&ctlr=AdminLongController&method=login");
            }else{
                $result = $loginmodel->getLogin($this->table,$username,$password);
                // Session::init();
                Session::set('login',true);
                Session::set('username', $this->getSecurity($result[0]['user_full_name']));
                Session::set('useremail',$result[0]['user_email']);
                $_SESSION['userrole'] =$result[0]['user_role'];
                if($_SESSION['userrole'] === 9)
                    header("Location: ?act=adminLong&ctlr=AdminLongController&method=dashboard");
                elseif($_SESSION['userrole'] === 8)
                    header("Location: ?act=adminLong&ctlr=AdminLongController&method=dashboard2");
                else
                    header("Location: ?act=home");
            }
        }

        public function auttc_signup(){
            $model = $this->load->model($this->model);
            // parent::check_server_method('POST',$this->controllerHasError);
            // parent::check_post_variable('btn_update',$this->controllerHasError);
            //user 6 field 7 từ form confirmpassword
            $username = parent::ciipv('username', 3, $this->controllerHasError);
            $password = parent::ciipv('password', 3, $this->controllerHasError);
            $confirmpassword = parent::ciipv('confirmpassword', 3, $this->controllerHasError);
            parent::cccpv($password,$confirmpassword,$this->controllerHasError);
            $fullname = parent::ciipv('fullname', 3, $this->controllerHasError);
            $email = parent::ciipv('email', 3, $this->controllerHasError);
            $userimages_default = $this->userimages_default;
            $role_default = $this->role_default;
            //user 6 field
            $data = ['user_name' =>$this->setSecurity($username),'user_full_name' =>$this->setSecurity($fullname),'user_images' => $this->setSecurity($userimages_default),'user_password'=>md5($password),'user_email'=>$email,'user_role'=>$role_default];
            $result = $model->call_insert_user($this->table, $data);
            if($result){
                $_SESSION['msg'] = "Chúc Mừng Bạn Đã Đăng Ký Thành Công 🤩🤩!";
                header("Location: ".'?act=adminLong&ctlr=AdminLongController&method=sign_up');
                exit();
            }else{
                $_SESSION['msg'] = "Đăng Ký thất bại 😅😅!";
                header("Location: ".'?act=adminLong&ctlr=AdminLongController&method=sign_up');
                exit();
            }
        }

        public function logOut(){
            // Session::init();
            Session::destroy();
            header("Location: ?act=adminLong&ctlr=AdminLongController&method=login");
        }
        public function proFile(){
            Session::checkSession();
            $this->load->view('cpanel/header');
            $this->load->view('cpanel/menu');
            $loginmodel = $this->load->model($this->model);
            $result = $loginmodel->select_all_by_email_user($this->table,Session::get('useremail'));
            $decryptedResult = $this->getDecryptArray($result);
            $this->load->view('cpanel/account/profile',['data'=>$decryptedResult]);
            $this->load->view('cpanel/footer');
        }
        public function proFileEdit(){
            Session::checkSession();
            $model = $this->load->model($this->model);
            // parent::check_server_method('POST',$this->controllerHasError);
            // parent::check_post_variable('btn_update',$this->controllerHasError);
            $user_name = parent::ciipv('user_name', 3, $this->controllerHasError);
            $user_full_name = parent::ciipv('user_full_name', 3, $this->controllerHasError);
            $up_images_name = parent::iifnv('up_images', $this->controllerHasError);
            $up_images_tmp_name = (parent::iiftnv('up_images', $this->controllerHasError)); 
            parent::mulfnew($up_images_name,$up_images_tmp_name,$this->part_upload,$this->controllerHasError);
            parent::ulfold($this->getDecryptArray($model->select_all_by_email_user($this->table,Session::get('useremail')))[0]['user_images'],$this->part_upload,$this->controllerHasError);
            $data = ['user_name' => $this->setSecurity($user_name),'user_full_name' => $this->setSecurity($user_full_name),'user_images' => $this->setSecurity($up_images_name)];
            $result = $model->call_update_user($this->table, $data, Session::get('useremail'));
            if($result){
                $_SESSION['msg'] = "Sua du lieu thanh cong!";
                header("Location: " . BASE_URL . '?act=adminLong&ctlr=AdminLongController&method=proFile');
                exit();
            }else{
                $_SESSION['msg'] = "Sua du lieu that bai!";
                header("Location: " . BASE_URL . $this->controllerHasError);
                exit();
            }
        }
        public function add_product(){
            $model = $this->load->model($this->model);
            // $result = $model->call_productById($this->tableProduct,6); này để xem tên các trường db
            $resultSelectBox = $model->call_list_category_product($this->tableCategoryProduct);
            // $this->load->view('cpanel/product/add_product',['productbyid' => $result,'category' => $resultSelectBox]);  này để xem tên các trường db
            $this->load->view('admin/index',['category' => $resultSelectBox]);
            $this->load->view('admin/menu');
        }
        public function insert_product(){
            $model = $this->load->model($this->model);
            $product_name = parent::ciipv('product_name', 3, $this->controllerHasError);
            $product_price = parent::intpv('product_price', $this->controllerHasError);
            $view_count = parent::intpv('view_count', $this->controllerHasError);
            $product_discount = parent::intpv('product_discount', $this->controllerHasError);
            $product_count = parent::intpv('product_count', $this->controllerHasError);
            $product_cat = parent::intpv('product_cat', $this->controllerHasError);
            $product_img_name = parent::iifnv('product_img_upload', $this->controllerHasError);
            $product_img_tmp = parent::iiftnv('product_img_upload', $this->controllerHasError);
            parent::mulfnew($product_img_name,$product_img_tmp,$this->part_upload,$this->controllerHasError);
            $data = ['product_status' => 1,'product_name'=>$product_name,'product_price'=>$product_price,'view_count'=>$view_count,'product_discount'=>$product_discount,'product_count'=>$product_count,'product_cat'=>$product_cat,'product_img'=>$product_img_name];
            $result = $model->call_insert_product($this->tableProduct,$data);
            if($result){
                $_SESSION['msg'] = "Them du lieu thanh cong!";
                header("Location: " . BASE_URL . 'Admin/?mod=product&act=list_product');
                exit();
            }else{
                $_SESSION['msg'] = "Them du lieu that bai!";
                header("Location: " . BASE_URL. 'Admin/' . $this->controllerHasError);
                exit();
            }
        }
        public function delete_product($param){
            $model = $this->load->model($this->model);
            $data = ['product_status' => 0];
            $result = $model->call_delete_product_soft($this->tableProduct,$data,$param);
            if($result){
                $_GET['msg'] = "Xóa mềm sản phẩm thành công!";
                header("Location: " . BASE_URL. 'Admin/?mod=product');
                exit();
            }else{
                $_GET['msg'] = "Xóa mềm sản phẩm thất bại!";
                header("Location: " . BASE_URL . 'Admin/?mod=product');
                exit();
            }
        }
        public function edit_product($param){
            $model = $this->load->model($this->model);
            
            $result = $model->call_productById_jion($this->tableProduct,$this->tableCategoryProduct,$param);
            $resultSelectBox = $model->call_list_category_product($this->tableCategoryProduct);
            // $this->load->view('cpanel/product/edit_product',['productbyid' => $result,'category' => $resultSelectBox]);
            $this->load->view('admin/index',['productbyid' => $result,'category' => $resultSelectBox]);
            $this->load->view('admin/menu');
            // $this->load->view('product/list',['product' => $result]);
            
        }
        public function update_product($param){
            $model = $this->load->model($this->model);
            $product_name = parent::ciipv('product_name', 3, $this->controllerHasError);
            $product_price = parent::intpv('product_price', $this->controllerHasError);
            $view_count = parent::intpv('view_count', $this->controllerHasError);
            $product_discount = parent::intpv('product_discount', $this->controllerHasError);
            $product_count = parent::intpv('product_count', $this->controllerHasError);
            $product_cat = parent::intpv('product_cat', $this->controllerHasError);
            $product_status = parent::intpv('product_status', $this->controllerHasError);
            $product_img_name = parent::iifnv('product_img_upload', $this->controllerHasError);
            $product_img_tmp = parent::iiftnv('product_img_upload', $this->controllerHasError);
            parent::mulfnew($product_img_name,$product_img_tmp,$this->part_upload,$this->controllerHasError);
            parent::ulfold($model->call_productById($this->tableProduct,$param)[0]['product_img'],$this->part_upload,$this->controllerHasError);
            $data = ['product_status' => $product_status,'product_name'=>$product_name,'product_price'=>$product_price,'view_count'=>$view_count,'product_discount'=>$product_discount,'product_count'=>$product_count,'product_cat'=>$product_cat,'product_img'=>$product_img_name];
            $result = $model->call_update_product($this->tableProduct,$data,$param);
            if($result){
                $_GET['msg'] = "Sua du lieu thanh cong!";
                header("Location: " . BASE_URL . 'Admin/?mod=product&act=list_product');
                exit();
            }else{
                $_GET['msg'] = "Sua du lieu that bai!";
                header("Location: " . BASE_URL . $this->controllerHasError);
                exit();
            }
        }
        public function add_category(){
            $model = $this->load->model($this->model);
            $result = $model->call_list_category_product($this->tableCategoryProduct);
            $this->load->view('admin/index',['categorySelectBox'=>$result]);
            $this->load->view('admin/menu');
        }
        public function insert_category(){
            $model = $this->load->model($this->model);
            // $category_desc = parent::ciipv('category_desc', 3, $this->controllerHasError);
            // $internal_link = parent::lciipv('internal_link', 3, $this->controllerHasError);
            $category_name = parent::ciipv('category_name', 3, $this->controllerHasError);
            $category_desc = $_POST['category_desc'];
            $internal_link = $_POST['internal_link'];
            $parent_id = parent::intpv('parent_id', $this->controllerHasError);
            $category_img_name = parent::iifnv('category_img', $this->controllerHasError);
            $category_img_tmp = parent::iiftnv('category_img', $this->controllerHasError);
            parent::mulfnew($category_img_name,$category_img_tmp,$this->part_upload,$this->controllerHasError);
            $data = ['category_status' => 1,'category_name'=>$category_name,'category_desc'=>$category_desc,'parent_id'=>$parent_id,'internal_link'=>$internal_link,'category_img'=>$category_img_name];
            $result = $model->call_insert_category($this->tableCategoryProduct,$data);
            if($result){
                $_SESSION['msg'] = "Them du lieu thanh cong!";
                header("Location: " . BASE_URL . 'Admin/?mod=category&act=list_category');
                exit();
            }else{
                $_SESSION['msg'] = "Them du lieu that bai!";
                header("Location: " . BASE_URL . $this->controllerHasError);
                exit();
            }
        }
        public function list_category(){
            $model = $this->load->model($this->model);
            $result = $model->call_list_category_product($this->tableCategoryProduct);
            $this->load->view('admin/index',['category' => $result]);
            $this->load->view('admin/menu');
            
        }
        public function delete_category($param){
            $model = $this->load->model($this->model);
            $data = ['category_status' => 0];
            $result = $model->call_delete_category_soft($this->tableCategoryProduct,$data,$param);
            if($result){
                $_GET['msg'] = "Xóa mềm danh mục thành công!";
                header("Location: " . BASE_URL . 'Admin/?mod=category&act=list_category');
                exit();
            }else{
                $_GET['msg'] = "Xóa mềm danh mục thất bại!";
                header("Location: " . BASE_URL . 'Admin/?mod=category&act=list_category');
                exit();
            }
        }
        public function edit_category($param){
            $model = $this->load->model($this->model);
            $result = $model->call_categoryById($this->tableCategoryProduct,$param);
            $resultSelectBox = $model->call_list_category_product($this->tableCategoryProduct);
            $this->load->view('admin/index',['categorybyid' => $result,'categorySelectBox'=>$resultSelectBox]);
            $this->load->view('admin/menu');
        }
        public function update_category($param){
            $model = $this->load->model($this->model);
            // $category_desc = parent::ciipv('category_desc', 3, $this->controllerHasError);
            // $internal_link = parent::lciipv('internal_link', 3, $this->controllerHasError);
            $category_name = parent::ciipv('category_name', 3, $this->controllerHasError);
            $category_desc = $_POST['category_desc'];
            $internal_link = $_POST['internal_link'];
            $parent_id = parent::intpv('parent_id', $this->controllerHasError);
            $category_status = parent::intpv('category_status', $this->controllerHasError);
            $category_img_name = parent::iifnv('category_img', $this->controllerHasError);
            $category_img_tmp = parent::iiftnv('category_img', $this->controllerHasError);
            parent::mulfnew($category_img_name,$category_img_tmp,$this->part_upload,$this->controllerHasError);
            parent::ulfold($model->call_categoryById($this->tableCategoryProduct,$param)[0]['category_img'],$this->part_upload,$this->controllerHasError);
            $data = ['category_status' => $category_status,'category_name'=>$category_name,'category_desc'=>$category_desc,'parent_id'=>$parent_id,'internal_link'=>$internal_link,'category_img'=>$category_img_name];
            $result = $model->call_update_category($this->tableCategoryProduct,$data,$param);
            if($result){
                $_SESSION['msg'] = "Sua du lieu thanh cong!";
                header("Location: " . BASE_URL . 'Admin/?mod=category&act=list_category');
                exit();
            }else{
                $_SESSION['msg'] = "Sua du lieu that bai!";
                header("Location: " . BASE_URL . $this->controllerHasError);
                exit();
            }
        }
        //phần ajax
        public function insert_product_ajax() {
            header("Access-Control-Allow-Origin: *");
            header('Content-Type: application/json');
            header("Access-Control-Allow-Methods: POST");
            header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $model = $this->load->model($this->model);
                $data = [
                    'product_name' => $_POST['product_name'],
                    'product_price' => $_POST['product_price'],
                    'product_discount' => $_POST['product_discount'],
                    'product_status' => $_POST['product_status'],
                    'product_cat' => $_POST['product_cat'],
                    'product_img' => $_POST['product_img'],
                ];
                $result = $model->call_insert_product($this->tableProduct, $data);
                echo json_encode([
                    'success' => $result ? true : false,
                    'message' => $result ? 'Thêm sản phẩm thành công' : 'Thêm sản phẩm thất bại'
                ]);
                exit;
            }
        }
        public function get_categories_product_ajax() {
            header("Access-Control-Allow-Origin: *");
            header('Content-Type: application/json');
            header("Access-Control-Allow-Methods: POST");
            header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");
            $model = $this->load->model($this->model);
            $categories = $model->call_list_category_product($this->tableCategoryProduct);
            echo json_encode($categories);
            exit;
        }
        public function edit_product_ajax() {
            header("Access-Control-Allow-Origin: *");
            header('Content-Type: application/json');
            header("Access-Control-Allow-Methods: POST");
            header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");
            error_log("Received POST data: " . print_r($_POST, true));
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                echo json_encode([
                    'success' => false,
                    'message' => 'Phương thức không được hỗ trợ'
                ]);
                return;
            }
            $product_id = $_POST['product_id'] ?? '';
            if (empty($product_id)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Thiếu product_id'
                ]);
                return;
            }

            // Chuẩn bị data để update
            $data = [];
            
            // Chỉ thêm các trường có giá trị vào data
            if (!empty($_POST['product_name'])) {
                $data['product_name'] = $_POST['product_name'];
            }
            if (isset($_POST['product_price']) && $_POST['product_price'] !== '') {
                $data['product_price'] = floatval($_POST['product_price']);
            }
            if (isset($_POST['product_discount'])) {
                $data['product_discount'] = floatval($_POST['product_discount']);
            }
            if (isset($_POST['product_status'])) {
                $data['product_status'] = intval($_POST['product_status']);
            }
            if (!empty($_POST['category_id'])) {
                $data['product_cat'] = intval($_POST['category_id']);
            }
            if (!empty($_POST['product_img'])) {
                $data['product_img'] = $_POST['product_img'];
            }

            error_log("Prepared data for update: " . print_r($data, true));

            if (empty($data)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Không có dữ liệu để cập nhật'
                ]);
                return;
            }

            $model = $this->load->model($this->model);
            $result = $model->update_product_for_ajax($this->tableProduct, $data, $product_id);

            echo json_encode([
                'success' => $result,
                'message' => $result ? 'Cập nhật thành công' : 'Cập nhật thất bại',
                'debug' => [
                    'post_data' => $_POST,
                    'processed_data' => $data,
                    'product_id' => $product_id
                ]
            ]);
        }
        public function get_product_ajax_debug() { // dùng để debug
            header("Access-Control-Allow-Origin: *");
            header('Content-Type: application/json');
            header("Access-Control-Allow-Methods: POST");
            header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
                $product_id = $_POST['product_id'];
                $model = $this->load->model($this->model);
                $product = $model->getProductById($this->tableProduct,$product_id);
                header('Content-Type: application/json');
                $debug = [
                    'product_id' => $product_id,
                    'product_data' => $product,
                    'sql_query' => $model->last_query ?? null,
                    'error' => error_get_last()
                ];
                echo json_encode($debug);
                exit;
            }
        }
        
        public function upload_file_ajax() {
            header("Access-Control-Allow-Origin: *");
            header('Content-Type: application/json'); 
            header("Access-Control-Allow-Methods: POST");
            header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");
            try {
                if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                    throw new Exception('Chỉ chấp nhận phương thức POST');
                }
                if (!isset($_FILES['product_img']) || $_FILES['product_img']['error'] !== UPLOAD_ERR_OK) {
                    throw new Exception('Không tìm thấy file upload hoặc có lỗi khi upload');
                }
                $file = $_FILES['product_img'];
                $filename = $file['name'];
                $tmp_name = $file['tmp_name'];
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime_type = finfo_file($finfo, $tmp_name);
                finfo_close($finfo);
                $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($mime_type, $allowed_types)) {
                    throw new Exception('Chỉ chấp nhận file ảnh (JPG, PNG, GIF)');
                }
                if ($file['size'] > 5 * 1024 * 1024) {
                    throw new Exception('File không được lớn hơn 5MB');
                }
                $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                $new_filename = uniqid() . '.' . $extension;
                $upload_dir = '../uploaded/';
                if (!is_dir($upload_dir)) {
                    if (!mkdir($upload_dir, 0777, true)) {
                        throw new Exception('Không thể tạo thư mục upload');
                    }
                }
                $upload_path = $upload_dir . $new_filename;
                if (!move_uploaded_file($tmp_name, $upload_path)) {
                    throw new Exception('Không thể lưu file. Vui lòng kiểm tra quyền thư mục.');
                }
        
                echo json_encode([
                    'success' => true,
                    'filename' => $new_filename,
                    'message' => 'Upload thành công'
                ]);
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
            }
        }
        public function upload_file_ajax_edit() {
            header("Access-Control-Allow-Origin: *");
            header('Content-Type: application/json'); 
            header("Access-Control-Allow-Methods: POST");
            header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");
            $response = array('success' => false, 'message' => '', 'filename' => '');
            try {
                if (!isset($_FILES['product_img'])) {
                    throw new Exception('Không tìm thấy file upload');
                }
                $file = $_FILES['product_img'];
                $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;
                
                if (!$product_id) {
                    throw new Exception('Thiếu product_id');
                }
                if ($file['error'] !== UPLOAD_ERR_OK) {
                    throw new Exception('Lỗi upload file: ' . $file['error']);
                }
                $allowed_types = array('image/jpeg', 'image/png', 'image/gif', 'image/webp');
                if (!in_array($file['type'], $allowed_types)) {
                    throw new Exception('Định dạng file không được hỗ trợ');
                }
                if ($file['size'] > 5 * 1024 * 1024) {
                    throw new Exception('Kích thước file quá lớn (tối đa 5MB)');
                }
                $model = $this->load->model($this->model);
                $oldProduct = $model->call_productById($this->tableProduct, $product_id);
                if ($oldProduct && !empty($oldProduct[0]['product_img'])) {
                    $oldImagePath = $this->part_upload . '/' . $oldProduct[0]['product_img'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $filename = 'product_' . time() . '_' . uniqid() . '.' . $extension;
                $upload_path = $this->part_upload . '/' . $filename;
                if (!move_uploaded_file($file['tmp_name'], $upload_path)) {
                    throw new Exception('Không thể lưu file');
                }
                $response['success'] = true;
                $response['message'] = 'Upload thành công';
                $response['filename'] = $filename;
            } catch (Exception $e) {
                $response['message'] = $e->getMessage();
            }
            echo json_encode($response);
            exit;
        }
        
        
        
        public function list_product(){
            $current_page = 0; $limit =0; $offset = 0;
            $current_page = isset($_GET['current_page']) ? (int)$_GET['current_page'] : 1; // Lấy trang hiện tại
            $limit = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 6; // Số mục trên mỗi trang
            $offset = ($current_page - 1) * $limit; // Tính offset để truy vấn
            $admin = new Admin();
            
            $data = $admin->index($offset, $limit,$current_page);
            $this->load->view('admin/index', ['renderTableProduct' => $data]);
            unset($admin);
        }
        public function delete_product_ajax($param){
            header("Access-Control-Allow-Origin: *");
            header('Content-Type: application/json'); 
            header("Access-Control-Allow-Methods: POST");
            header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");
            $model = $this->load->model($this->model);
            $data = ['product_status' => 0];
            $result = $model->call_delete_product_soft($this->tableProduct,$data,$param);
            if($result){
                $_GET['msg'] = "Xóa mềm sản phẩm thành công!";
                header("Location: " . BASE_URL . 'Admin/?mod=product');
                exit();
            }else{
                $_GET['msg'] = "Xóa mềm sản phẩm thất bại!";
                header("Location: " . BASE_URL . 'Admin/?mod=product');
                exit();
            }
        }
        public function get_product_ajax() {
            header("Access-Control-Allow-Origin: *");
            header('Content-Type: application/json'); 
            header("Access-Control-Allow-Methods: POST");
            header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
                $product_id = $_POST['product_id'];
                $model = $this->load->model($this->model);
                $product = $model->getProductById($this->tableProduct,$this->tableCategoryProduct, $product_id);
                
                if ($product) {
                    echo json_encode([
                        'success' => true,
                        'data' => $product
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Không tìm thấy sản phẩm'
                    ]);
                }
                exit;
            }
        }


        public function render(string $nameView, array $model){

        }
}


class Admin extends Dcontroller{
    private $model = 'Hanghoa';
    private $tableProduct = 'products';
    public function __construct()
    {
        parent::__construct();
    }
               
    public function index($offset,$limit,$current_page){
        require_once ('MVC/Models/AdminLongModel.php');
        $model = new $this->model();
        $records_total = $model->call_affectedRows_pagination($this->tableProduct);
        $totalPage = ceil($records_total / $limit);
        $data = $model->renderAll($offset,$limit);
        $base_url = BASE_URL;
        $htmlContent = '
        <style>
        .action-popup{position:absolute;background:white;box-shadow:0 2px 10px rgba(0,0,0,0.1);border-radius:5px;padding:8px;display:none;z-index:1000;}.action-popup button{display:block;width:100%;padding:8px 16px;border:none;background:none;text-align:left;cursor:pointer;}.action-popup button:hover{background-color:#f8f9fa;}.edit-popup{display:none;position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);background:white;padding:20px;border-radius:8px;box-shadow:0 2px 10px rgba(0,0,0,0.1);z-index:1000;}.popup-overlay{display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,0.5);z-index:999;}
        </style>
        ';
        $htmlContent .= '
        <style>
        .product-img-container { position: relative; display: inline-block; } .product-description { display: none; position: absolute; top: 50%; left: 100%; transform: translateY(-50%); background-color: rgba(0, 0, 0, 0.8); color: white; padding: 10px; border-radius: 5px; min-width: 200px; max-width: 300px; z-index: 1000; margin-left: 10px; white-space: pre-wrap; word-wrap: break-word; } .product-description::before { content: \'\' ; position: absolute; left: -10px; top: 50%; transform: translateY(-50%); border-width: 10px; border-style: solid; border-color: transparent rgba(0, 0, 0, 0.8) transparent transparent; } .product-img:hover + .product-description { display: block; } .product-description:hover { display: block; }
        </style>';
        $htmlContent .= '<div class="container-fluid" id="list">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Danh sách sản phẩm</h3>
            <button class="btn btn-primary" onclick="openAddPopup()">
                <i class="fas fa-plus"></i> Thêm sản phẩm
            </button>
        </div>
        <table class="table table-light bg-white" style="border-radius: 15px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
           <thead>
              <tr style="background-color: #f8f9fa;">
                 <td style="border-top-left-radius: 15px;"><input id="checkAll" type="checkbox" class=""></td>
                 <td>Mã Hàng Hóa</td>
                 <td>Tên Hàng Hóa</td>
                 <td>Đơn Giá</td>
                 <td>Giảm Giá</td>
                 <td class="text-center">Hình</td>
                 <td>Hiển Thị</td>
                 <td>Số Lượt Xem</td>
                 <td>Thuộc Danh Mục</td>
                 <td style="border-top-right-radius: 15px;">Ngày Tạo</td>
              </tr>
           </thead>
           <tbody>';

        foreach($data as $key => $row)
        {
            extract($row);
            $data_desc = [
                'screen_cam' => "Màn hình: " . $screen_cam . "\n",
                'os' => "Hệ điều hành: " . $os . "\n",
                'gpu' => "Card đồ họa: " . $gpu . "\n", 
                'cpu' => "Vi xử lý: " . $cpu . "\n",
                'pin' => "Pin: " . $pin . "\n",
                'colors' => "Màu sắc: " . $colors . "\n",
                'sizes' => "Kích thước: " . $sizes . "\n",
                'ram' => "RAM: " . $ram . "\n",
                'rom' => "Bộ nhớ trong: " . $rom . "\n",
                'bluetooth' => "Bluetooth: " . $bluetooth . "\n"
            ];
            $htmlContent .= "<tr>
                <td>
                    <input type='checkbox' id='checkboxProduct{$product_id}' class='checkboxProduct' 
                        onchange='toggleActionPopup(this, {$product_id})'>
                    <div id='actionPopup{$product_id}' class='action-popup'>
                        <button onclick='editProduct({$product_id})'>
                            <i class='fas fa-edit'></i> Edit
                        </button>
                        <button onclick='deleteProduct({$product_id})'>
                            <i class='fas fa-trash'></i> Delete
                        </button>
                    </div>
                </td>
                <td>{$product_id}</td>
                <td>{$product_name}</td>
                <td>" .Utility::setNumber($product_price) . "</td>
                <td>". $product_discount . "%</td>
                <td class='d-flex flex-column align-items-center position-relative'>
                    <div class='product-img-container'>
                        <img class='img-fluid product-img' 
                             max-width='200px' 
                             height='auto' 
                             src='{$base_url}/uploaded/{$product_img}' 
                             alt='{$product_name}'
                             data-description='".json_encode($data_desc)."'>
                        <div class='product-description'></div>
                    </div>
                    <btn class='btn btn-dark mt-2' #id='{$pro_d_id}' value='{$pro_d_id}'>Mô Tả</btn>
                </td>
                <td>" . ($product_status == 1 ? '<input type="checkbox" checked>' : '<input type="checkbox">') . "</td>
                <td>{$view_count}</td>
                <td>
                    <select class='form-select' id='MaLoai'>
                        <option value='{$product_cat}'>{$category_name}</option>
                    </select>
                </td>
                <td>{$created_at}</td>
            </tr>";
            
        }
        $htmlContent .= '
            <div class="pagination_custem">
                <ul class="pagination mt-2 ">
                
            ';
            
            $url_tmp = BASE_URL . 'Admin/?mod=product&act=list_product&';
            if ($current_page > 2) {
                $htmlContent .= '<li class="page-item"><a class="page-link" href="' . $url_tmp. 'per_page=' . $limit . '&current_page=1#list">&laquo;</a></li>';
            }

            // Nút về trang trước
            if ($current_page > 1) {
                $htmlContent .= '<li class="page-item"><a class="page-link"  href="' . $url_tmp. 'per_page=' . $limit . '&current_page=' . ($current_page - 1) . '#list">&lsaquo;</a></li>';
            }

            // Vòng lặp tạo các nút trang
            
            for ($i = 1; $i <= $totalPage; $i++) {
                if ($i == $current_page) {
                    // Trang hiện tại
                    $htmlContent .= '<li class="page-item active"><a href="'.$url_tmp.'#list" class="page-link" style="background-color: #1A1A1A; border: none;">' . $i . '</a></li>';
                } elseif ($i >= $current_page - 2 && $i <= $current_page + 2) {
                    // Các trang lân cận
                    $htmlContent .= '<li class="page-item"><a class="page-link" href="' . $url_tmp. 'per_page=' . $limit . '&current_page=' . $i . '#list">' . $i . '</a></li>';
                }
            }
            if ($current_page < $totalPage - 1) {
                $htmlContent .= '<li class="page-item"><a class="page-link"  href="' . $url_tmp. 'per_page=' . $limit . '&current_page=' . ($current_page + 1) . '#list">&rsaquo;</a></li>';
            }
            if ($current_page < $totalPage - 2) {
                $htmlContent .= '<li id="lastPageEnd1" class="page-item"><a class="page-link" href="' . $url_tmp. 'per_page=' . $limit . '&current_page=' . $totalPage . '#list">&raquo;</a></li>';
            }

        $htmlContent .= '
                
            
                <li id="lastPageEnd2" class="page-item"><a class="page-link" href="' . $url_tmp. 'per_page=' . $limit . '&current_page=' . $totalPage . '#list">' . $totalPage . '</a></li>
            </ul>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const lastPageEnd1 = document.getElementById("lastPageEnd1");
                const lastPageEnd2 = document.getElementById("lastPageEnd2");
                
                if (!lastPageEnd1) {
                    lastPageEnd2.style.display = "none";
                }else{
                    lastPageEnd1.style.display = "block";
                }
            });
        </script>
        ';

        $htmlContent .= "
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productImages = document.querySelectorAll('.product-img');
            
            productImages.forEach(img => {
                const description = img.getAttribute('data-description');
                const descriptionDiv = img.nextElementSibling;
                
                if (description) {
                    try {
                        const descObj = JSON.parse(description);
                        let formattedDesc = '';
                        for (let key in descObj) {
                            if (descObj[key].trim() !== ':' && descObj[key].trim() !== '') {
                                formattedDesc += descObj[key];
                            }
                        }
                        descriptionDiv.style.whiteSpace = 'pre-line';
                        descriptionDiv.textContent = formattedDesc;
                    } catch(e) {
                        descriptionDiv.textContent = 'Lỗi hiển thị thông tin sản phẩm';
                    }
                } else {
                    descriptionDiv.textContent = 'Không có mô tả cho sản phẩm này';
                }
                
                // Xử lý khi chuột rời khỏi vùng mô tả
                img.parentElement.addEventListener('mouseleave', function(e) {
                    const rect = this.getBoundingClientRect();
                    const isInDescription = e.clientX > rect.right &&
                                          e.clientY >= rect.top &&
                                          e.clientY <= rect.bottom;
                    
                    if (!isInDescription) {
                        descriptionDiv.style.display = 'none';
                    }
                });
            });
        });
        </script>
        ";




        $htmlContent .= '</tbody>
           </table>
        </div>';
        $htmlContent .= '<div class="popup-overlay"></div>';
        $htmlContent .= '
        <script>
            document.getElementById("checkAll").addEventListener("change", function() {
                const isChecked = this.checked;
                const checkboxes = document.querySelectorAll("table tbody input[class=\'checkboxProduct\']");
                checkboxes.forEach(checkbox => {
                    checkbox.checked = isChecked;
                });
            });
            const BASE_URL = "' . BASE_URL . '";
            function toggleActionPopup(checkbox, productId) {
                const popup = document.getElementById(`actionPopup${productId}`);
                if (checkbox.checked) {
                    document.querySelectorAll(".action-popup").forEach(p => p.style.display = "none");
                    popup.style.display = "block";
                    const rect = checkbox.getBoundingClientRect();
                    popup.style.top = `${rect.bottom + window.scrollY + 5}px`;
                    popup.style.left = `${rect.left + window.scrollX}px`;
                } else {
                    popup.style.display = "none";
                }
            }
            function deleteProduct(productId) {
                if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) {
                    window.location.href = `${BASE_URL}/Admin?mod=product&act=delete_product_ajax&param=${productId}`;
                }
            }

            document.addEventListener("click", function(event) {
                if (!event.target.closest(".checkboxProduct") && !event.target.closest(".action-popup")) {
                    document.querySelectorAll(".action-popup").forEach(popup => popup.style.display = "none");
                    document.querySelectorAll(".checkboxProduct").forEach(cb => cb.checked = false);
                }
            });
        </script>';
        ;
        // ajax popup edit
        $htmlContent .= '<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>';
        $htmlContent .= '
        <style>
            .edit-popup{display:none;position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);background:white;padding:20px;border-radius:8px;box-shadow:0 2px 10px rgba(0,0,0,0.1);z-index:1001;width:500px;max-width:90%}.popup-overlay{display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,0.5);z-index:1000}.modal-header{display:flex;justify-content:space-between;align-items:center;padding-bottom:1rem;border-bottom:1px solid #dee2e6}.modal-footer{padding-top:1rem}
        </style>
        ';
        $htmlContent .= '
        <div id="editPopup" class="edit-popup">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh sửa sản phẩm</h5>
                    <button type="button" class="close" onclick="closeEditPopup()">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="editProductForm">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" id="edit_product_id" name="product_id">
                                <div class="form-group">
                                    <label>Tên sản phẩm:</label>
                                    <input type="text" id="edit_product_name" name="product_name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Hình Ảnh:</label>
                                    <input type="file" id="edit_product_img" name="product_img" class="form-control">
                                    <button type="button" id="btnEditUpload" class="btn btn-secondary mt-2">
                                        <i class="fas fa-upload"></i> Upload Ảnh
                                    </button>
                                </div>
                                <div class="form-group">
                                    <label>Giá:</label>
                                    <input type="number" id="edit_product_price" name="product_price" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Giảm giá (%):</label>
                                    <input type="number" id="edit_product_discount" name="product_discount" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Trạng thái:</label>
                                    <select id="edit_product_status" name="product_status" class="form-control">
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Danh Mục:</label>
                                    <select id="edit_product_cat" name="category_id" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                            <button type="button" class="btn btn-secondary" onclick="closeEditPopup()">Đóng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="editPopupOverlay" class="popup-overlay"></div>
        ';
        $htmlContent .= "
        <script>
        function editProduct(productId) {
            document.getElementById('editPopupOverlay').style.display = 'block';
            document.getElementById('editPopup').style.display = 'block';
            
            // Đầu tiên load thông tin sản phẩm
            $.ajax({
                url: '" . BASE_URL . "/Admin/?mod=product&act=get_product_ajax&param=true',
                type: 'POST',
                data: { product_id: productId },
                dataType: 'json',
                success: function(productResponse) {
                    if (productResponse.success && productResponse.data) {
                        const product = productResponse.data;
                        
                        // Sau đó mới load danh mục và set selected value
                        $.ajax({
                            url: '" . BASE_URL . "/Admin/?mod=product&act=get_categories_product_ajax&param=true',
                            type: 'POST',
                            dataType: 'json',
                            success: function(categoriesResponse) {
                                const categorySelect = document.getElementById('edit_product_cat');
                                categorySelect.innerHTML = categoriesResponse.map(cat => 
                                    `<option value='\${cat.category_id}' \${cat.category_id == product.category_id ? 'selected' : ''}>\${cat.category_name}</option>`
                                ).join('');
                            }
                        });

                        // Fill các trường khác của form
                        $('#edit_product_id').val(product.product_id);
                        $('#edit_product_name').val(product.product_name);
                        $('#edit_product_price').val(product.product_price);
                        $('#edit_product_discount').val(product.product_discount);
                        $('#edit_product_status').val(product.product_status);
                        
                        // Hiển thị ảnh hiện tại nếu có
                        if (product.product_img) {
                            const previewImg = document.createElement('img');
                            previewImg.src = `" . BASE_URL . "uploaded/\${product.product_img}`;
                            previewImg.style.width = '130px';
                            previewImg.style.height = '130px';
                            previewImg.style.margin = '10px';
                            const imgContainer = document.getElementById('edit_product_img').parentElement;
                            const existingImg = imgContainer.querySelector('img');
                            if (existingImg) {
                                imgContainer.removeChild(existingImg);
                            }
                            imgContainer.appendChild(previewImg);
                        }
                    }
                }
            });
        }

        function closeEditPopup() {
            document.getElementById('editPopupOverlay').style.display = 'none';
            document.getElementById('editPopup').style.display = 'none';
            document.getElementById('editProductForm').reset();
        }

        // Xử lý upload ảnh trong edit popup
        document.getElementById('btnEditUpload').addEventListener('click', function() {
            const fileInput = document.getElementById('edit_product_img');
            const productId = document.getElementById('edit_product_id').value;
            
            if (fileInput.files.length > 0) {
                const formData = new FormData();
                formData.append('product_img', fileInput.files[0]);
                formData.append('product_id', productId);
                
                $.ajax({

                    url: '" . BASE_URL . "/Admin/?mod=product&act=upload_file_ajax_edit&param=true',
                    type: 'POST',   
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        try {
                            const result = typeof response === 'string' ? JSON.parse(response) : response;
                            if (result.success) {
                                alert('Upload file thành công!');
                                const previewImg = document.createElement('img');
                                previewImg.src = `" . BASE_URL . "uploaded/\${result.filename}`;
                                previewImg.style.width = '130px';
                                previewImg.style.height = '130px';
                                previewImg.style.margin = '10px';
                                
                                const container = fileInput.parentElement;
                                const existingImg = container.querySelector('img');
                                if (existingImg) {
                                    container.removeChild(existingImg);
                                }
                                
                                // Chuyển input file thành text và lưu tên file
                                const textInput = document.createElement('input');
                                textInput.type = 'text';
                                textInput.id = fileInput.id;
                                textInput.name = fileInput.name;
                                textInput.value = result.filename;
                                textInput.className = fileInput.className;
                                textInput.readOnly = true;
                                
                                container.replaceChild(textInput, fileInput);
                                container.appendChild(previewImg);
                            } else {
                                alert('Upload thất bại: ' + result.message);
                            }
                        } catch(e) {
                            console.error('Error:', e);
                            alert('Có lỗi xảy ra khi xử lý phản hồi từ server');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        alert('Có lỗi xảy ra khi upload file');
                    }
                });
            } else {
                alert('Vui lòng chọn file ảnh trước khi upload');
            }
        });

        // Xử lý submit form edit
        $('#editProductForm').on('submit', function(e) {
            e.preventDefault();
            
            // Log dữ liệu trước khi gửi
            const formData = {
                product_id: $('#edit_product_id').val(),
                product_name: $('#edit_product_name').val(),
                product_price: $('#edit_product_price').val(),
                product_discount: $('#edit_product_discount').val(),
                product_status: $('#edit_product_status').val(),
                category_id: $('#edit_product_cat').val(),
                product_img: $('#edit_product_img').val()
            };

            // Log để kiểm tra
            Object.entries(formData).forEach(([key, value]) => {
                console.log(`\${key}: \${value}`);
            });

            $.ajax({
                url: '" . BASE_URL . "/Admin/?mod=product&act=edit_product_ajax&param=true',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    console.log('Server response:', response);
                    if (response && response.success) {
                        alert('Cập nhật sản phẩm thành công!');
                        closeEditPopup();
                        location.reload();
                    } else {
                        alert('Lỗi: ' + (response ? response.message : 'Không xác định'));
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error details:', {
                        xhr: xhr,
                        status: status,
                        error: error
                    });
                    alert('Có lỗi xảy ra khi gửi yêu cầu');
                }
            });
        });
        
        </script>
        ";
        // ajax insert
        $htmlContent .= '
        <style>
            .popup-overlay{display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,0.5);z-index:999}.edit-popup{display:none;position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);background:white;padding:20px;border-radius:8px;box-shadow:0 2px 10px rgba(0,0,0,0.1);z-index:1000;width:80%;max-width:800px}
        </style>
        ';
        $htmlContent .= '
        <div id="addPopupOverlay" class="popup-overlay"></div>
        <div id="addPopup" class="edit-popup">
            <h3>Thêm Sản Phẩm Mới</h3>
            <form id="addProductForm">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="add_product_name">Tên Sản Phẩm:</label>
                            <input type="text" id="add_product_name" name="product_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="add_product_img">Hình Ảnh:</label>
                            <input type="file" id="add_product_img" name="product_img" class="form-control" >
                            <button type="button" id="btnUpload" class="btn btn-secondary mt-2">
                                <i class="fas fa-upload"></i>   Upload Ảnh
                            </button>
                        </div>
                        <div class="form-group">
                            <label for="add_product_price">Giá Sản Phẩm:</label>
                            <input type="number" id="add_product_price" name="product_price" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="add_product_discount">Giảm Giá (%):</label>
                            <input type="number" id="add_product_discount" name="product_discount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="add_product_status">Trạng thái:</label>
                            <select id="add_product_status" name="product_status" class="form-control" disabled>
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="add_product_cat">Danh Mục:</label>
                            <select id="add_product_cat" name="product_cat" class="form-control">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
                    <button type="button" class="btn btn-secondary" onclick="closeAddPopup()">Đóng</button>
                </div>
            </form>
        </div>
        ';
        $htmlContent .= '
        <script>
        function openAddPopup() {
            document.getElementById("addPopupOverlay").style.display = "block";
            document.getElementById("addPopup").style.display = "block";
            $.ajax({
                url: "' . BASE_URL . '/Admin/?mod=product&act=get_categories_product_ajax&param=true",
                type: "POST",
                dataType: "json",
                success: function(response) {
                    const categorySelect = document.getElementById("add_product_cat");
                    categorySelect.innerHTML = response.map(cat => 
                        `<option value="${cat.category_id}">${cat.category_name}</option>`
                    ).join("");
                },
                error: function(xhr, status, error) {
                    console.error("Error loading categories:", error);
                }
            });
        }
        function closeAddPopup() {
            const overlay = document.getElementById("addPopupOverlay");
            const popup = document.getElementById("addPopup");
            const form = document.getElementById("addProductForm");
            const statusSelect = document.getElementById("add_product_status");
            if (overlay) {
                overlay.style.display = "none";
            }
            if (popup) {
                popup.style.display = "none";
            }
            if (form) {
                form.reset();
            }
            if (statusSelect) {
                statusSelect.disabled = true;
                statusSelect.value = "0";
            }
            const previewImg = popup.querySelector("img");
            if (previewImg) {
                previewImg.remove();
            }
        }

        document.getElementById("btnUpload").addEventListener("click", function() {
            const fileInput = document.getElementById("add_product_img");
            const statusSelect = document.getElementById("add_product_status");
            console.log("File input:", fileInput.files);
            if (fileInput.files.length > 0) {
                const formData = new FormData();
                formData.append("product_img", fileInput.files[0]);
                console.log("FormData entries:");
                for (let pair of formData.entries()) {
                    console.log(pair[0] + " : " + pair[1]);
                }
                
                $.ajax({
                    url: "' . BASE_URL . '/Admin/?mod=product&act=upload_file_ajax&param=true",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log("Success response:", response);
                        try {
                            const result = typeof response === "string" ? JSON.parse(response) : response;
                            if (result.success) {
                                alert("Upload file thành công!");
                                const previewImg = document.createElement("img");
                                
                                previewImg.src = `' . BASE_URL . '/uploaded/${result.filename}`;
                                previewImg.style.width = "130px";
                                previewImg.style.height = "130px";
                                previewImg.style.margin = "10px";
                                fileInput.parentElement.appendChild(previewImg);
                                statusSelect.disabled = false;
                                statusSelect.value = "1";

                                // Tạo input text mới
                                const container = fileInput.parentElement;
                                const textInput = document.createElement("input");
                                textInput.type = "text";
                                textInput.id = fileInput.id;
                                textInput.name = fileInput.name;
                                textInput.value = result.filename;
                                textInput.className = fileInput.className;
                                textInput.readOnly = true;
                                
                                container.replaceChild(textInput, fileInput);
                                
                                
                            } else {
                                alert("Upload thất bại: " + result.message);
                            }
                        } catch(e) {
                            console.error("Parse error:", e);
                            console.log("Raw response:", response);
                            alert("Có lỗi xảy ra khi xử lý phản hồi từ server");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                        alert("Có lỗi xảy ra khi upload file");
                    }
                });
            } else {
                alert("Vui lòng chọn file ảnh trước khi upload");
            }
        });
        document.getElementById("addProductForm").addEventListener("submit", function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            $.ajax({
                url: "' . BASE_URL . '/Admin/?mod=product&act=insert_product_ajax&param=true",
                type: "POST",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(response) {
                    try {
                        if(response.success) {
                            alert("Thêm sản phẩm thành công!");
                            closeAddPopup(); 
                            setTimeout(() => {
                                location.reload(); 
                            }, 100);
                        } else {
                            alert("Có lỗi xảy ra: " + response.message);
                        }
                    } catch(e) {
                        console.error("Error:", e);
                        alert("Có lỗi xảy ra khi xử lý phản hồi từ server");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                    alert("Có lỗi xảy ra khi gửi yêu cầu");
                }
            });
        });
        </script>
        ';

        $htmlContent .= "
        <style>
        .product-img-container {
            position: relative;
            display: inline-block;
        }

        .product-description {
            display: none;
            position: absolute;
            top: 50%;
            left: 100%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 10px;
            border-radius: 5px;
            min-width: 200px;
            max-width: 300px;
            z-index: 1000;
            margin-left: 10px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .product-description::before {
            content: '';
            position: absolute;
            left: -10px;
            top: 50%;
            transform: translateY(-50%);
            border-width: 10px;
            border-style: solid;
            border-color: transparent rgba(0, 0, 0, 0.8) transparent transparent;
        }

        .product-img:hover + .product-description {
            display: block;
        }

        .product-description:hover {
            display: block;
        }
        </style>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productImages = document.querySelectorAll('.product-img');
            
            productImages.forEach(img => {
                const description = img.getAttribute('data-description');
                const descriptionDiv = img.nextElementSibling;
                
                if (description) {
                    try {
                        const descObj = JSON.parse(description);
                        let formattedDesc = '';
                        for (let key in descObj) {
                            if (descObj[key].trim() !== ':' && descObj[key].trim() !== '') {
                                formattedDesc += descObj[key];
                            }
                        }
                        descriptionDiv.style.whiteSpace = 'pre-line';
                        descriptionDiv.textContent = formattedDesc;
                    } catch(e) {
                        descriptionDiv.textContent = 'Lỗi hiển thị thông tin sản phẩm';
                    }
                } else {
                    descriptionDiv.textContent = 'Không có mô tả cho sản phẩm này';
                }
                
                // Xử lý khi chuột rời khỏi vùng mô tả
                img.parentElement.addEventListener('mouseleave', function(e) {
                    const rect = this.getBoundingClientRect();
                    const isInDescription = e.clientX > rect.right &&
                                          e.clientY >= rect.top &&
                                          e.clientY <= rect.bottom;
                    
                    if (!isInDescription) {
                        descriptionDiv.style.display = 'none';
                    }
                });
            });
        });
        </script>";

        return $htmlContent;
    }

    public function render(string $nameView, array $model)
    {
        
    }
}
class Utility {
    /**
     * Phương thức kiểm tra đối tượng có phải là thể hiện của lớp cụ thể hay không
     *  
     * 
     * */ 
    public static function checkInstanceOf($object, $className) {
        if (is_object($object) && class_exists($className)) {
            return $object instanceof $className;
        }
        return false;
    }
    public static function showServer(): void{
        echo '<pre>';
        var_dump($_SERVER);
        echo '</pre>';
    }
    public static function showObject($Object): void{
        echo '<pre>';
        var_dump($Object);
        echo '</pre>';
    }
    public static function showString(string $string): void {
        echo '<pre>';
        printf($string);
        echo '</pre>';
    }
    public static function  setNumber($interger){
        return number_format($interger,0,'.',',').'đ';
      }
    
}

