<?php

use Random\Engine\Secure;

    class Login extends DController{

        public function __construct()
        {
            $message = array();
            $data = array();
            
            parent::__construct();
        }

        public function render($nameView, $model){

        }

        public function index(){
            $this->login();

        }
        public function login(){

            //$this->load->view('cpanel/header');
            Session::init();
            if(Session::get("Login")==true){
                header("Location:".BASE_URL."/Login/dashboard");
            }
            $this->load->callView('admin/cpanel/login');

            //$this->load->view('cpanel/footer');
        }
        
        public function sign_up(){

            //$this->load->view('cpanel/header');
            Session::init();
            if(Session::get("Login")==true){
                header("Location: index.php?controller=Login&action=dashboard");
            }
            $this->load->callView('admin/cpanel/signup');

            //$this->load->view('cpanel/footer');
        }

        public function dashboard(){
            Session::checkSession();
            $this->load->callView('admin/cpanel/header');
            $this->load->callView('admin/cpanel/menu');
            $this->load->callView('admin/cpanel/dashboard');
            $this->load->callView('admin/cpanel/footer');
        }

        // public function non_dashboard(){
        //     echo 'this is non-dashboard';
        // }

        public function auttc_login(){ // authentication_login
            $username = md5($_POST['user_name']);
            $password = md5($_POST['user_password']);
            $table_admin = 'user';
            $loginmodel = $this->load->callModel('LoginModels');

            $count = $loginmodel->login($table_admin,$username,$password);

            if($count==0){
                $message['msg'] = 'Tài khoản hoặc mật khẩu sai xin hãy kiểm tra lại';
                header("Location: index.php?controller=Login&action=auttc_login");
            }else{
                $result = $loginmodel->getLogin($table_admin,$username,$password);
                Session::init();
                Session::set('login',true);
                Session::set('username',$result[0]['username']);
                Session::set('userid',$result[0]['admin_id']);
                // echo $result[0]['username'];
                // echo $result[0]['password'];
                header("Location: index.php?controller=Login&action=dashboard");
            }
        }

        public function logOut(){
            Session::init();
            Session::destroy();
            header("Location: index.php?controller=Login&action=index");
        }

    }
?>
