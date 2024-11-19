<?php 
    require_once("MVC/Models/login.php"); // ko biet ông build kiểu gì tôi ko đổi lỗi thì thêm Admin/vào
    // này của DUy ten hơi khác 
    class LoginController {

        public function admin()
        {
            require_once("MVC/Views/admin/index.php");
        }
    }
?>