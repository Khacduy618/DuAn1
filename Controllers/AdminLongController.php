<?php
spl_autoload_register(function($class){
    include_once('./libs/'.$class.'.php');
});
class AdminLongController extends Dcontroller{
    private $model = "AdminLongModel";
    private $table = "user";
    private $controllerHasError = '?act=adminLong&ctlr=AdminLongController&method=login';
    private $part_upload = "assets/upload/user_imgs/";

    public function __construct()
        {
            $message = array();
            $data = array();
            parent::__construct();
            
        }

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
        
        public function sign_up(){

            //$this->load->view('cpanel/header');
            // Session::init();
            if(Session::get("Login")==true){
                header("Location: ?act=adminLong&ctlr=AdminLongController&method=dashboard");
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
            $username = ($_POST['username']);
            $password = md5($_POST['password']);
            $table_admin = $this->table;
            $loginmodel = $this->load->model($this->model);

            $count = $loginmodel->login($table_admin,$username,$password);
            
            if($count==0){
                $message['msg'] = 'Tài khoản hoặc mật khẩu sai xin hãy kiểm tra lại';
                header("Location: ?act=adminLong&ctlr=AdminLongController&method=login");
            }else{
                $result = $loginmodel->getLogin($table_admin,$username,$password);
                // Session::init();
                Session::set('login',true);
                Session::set('username',$result[0]['user_full_name']);
                Session::set('useremail',$result[0]['user_email']);
                Session::set('userrole',$result[0]['user_role']);
                // echo $result[0]['username'];
                // echo $result[0]['password'];
                header("Location: ?act=adminLong&ctlr=AdminLongController&method=dashboard");
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
            $this->load->view('cpanel/account/profile',['data'=>$result]);
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
            parent::ulfold($model->select_all_by_email_user($this->table,Session::get('useremail'))[0]['user_images'],$this->part_upload,$this->controllerHasError);
            $data = ['user_name' => $user_name,'user_full_name' => $user_full_name,'user_images' => $up_images_name];
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

        
        public function render(string $nameView, array $model){

        }
}