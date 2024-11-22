<?php 
    require_once("MVC/Models/login.php");

    class LoginController {

        public function admin()
        {   
            require_once("MVC/Views/admin/index.php");
        }
    }
?>