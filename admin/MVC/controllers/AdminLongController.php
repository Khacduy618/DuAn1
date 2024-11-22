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
    private $controllerHasError = 'Admin/?mod=product';
    private $part_upload = __DIR__."/../../../uploaded/"; //"assets/upload/user_imgs/" bản không team
    
    private $role_default = 0;
    private $keySecurity = "123";
    private $userimages_default = "user.jpg";

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
            //     header("Location: ?mod=product&act=dashboard");
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
            if(Session::get("Login")==true){
                header("Location: ?mod=product&act=dashboard");
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

        // public function non_dashboard(){
        //     echo 'this is non-dashboard';
        // }

        

        public function auttc_login(){ // authentication_login
            $username = $this->setSecurity($_POST['username']);
            $password = md5($_POST['password']);
            $table_admin = $this->table;
            $loginmodel = $this->load->model($this->model);

            $count = $loginmodel->login($table_admin,$username,$password);
            
            if($count==0){
                $message['msg'] = 'Tài khoản hoặc mật khẩu sai xin hãy kiểm tra lại';
                header("Location: ?mod=product&act=login");
            }else{
                $result = $loginmodel->getLogin($table_admin,$username,$password);
                // Session::init();
                Session::set('login',true);
                Session::set('username', $this->getSecurity($result[0]['user_full_name']));
                Session::set('useremail',$result[0]['user_email']);
                Session::set('userrole',$result[0]['user_role']);
                if(Session::get('userrole') !== 9)
                    header("Location: ?act=home");
                else
                    header("Location: ?mod=product&act=dashboard");
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
                $_GET['msg'] = "Chúc Mừng Bạn Đã Đăng Ký Thành Công 🤩🤩!";
                header("Location: " . BASE_URL . '?mod=product&act=sign_up');
                exit();
            }else{
                $_GET['msg'] = "Đăng Ký thất bại 😅😅!";
                header("Location: " . BASE_URL . '?mod=product&act=sign_up');
                exit();
            }
        }

        public function logOut(){
            // Session::init();
            Session::destroy();
            header("Location: ?mod=product&act=login");
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
                $_GET['msg'] = "Sua du lieu thanh cong!";
                header("Location: " . BASE_URL . 'Admin/?mod=product&act=proFile');
                exit();
            }else{
                $_GET['msg'] = "Sua du lieu that bai!";
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
                header("Location: " . BASE_URL . $this->controllerHasError);
                exit();
            }
        }
        public function list_product(){
            $model = $this->load->model($this->model);
            $result = $model->call_list_product_index($this->tableProduct);
            // $resultDecsBox = $model->call_list_product_index_jion_detail($this->tableProduct,$this->tableProductsDetails);
            $this->load->view('admin/index',['product' => $result]);
            // $this->load->view('admin/index',['product' => $result,'descbox' => $resultDecsBox]);
            $this->load->view('admin/menu');
            // $this->load->view('product/list',['product' => $result]);
            
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


        

        
        public function render(string $nameView, array $model){

        }
}