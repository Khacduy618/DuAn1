<?php 
    require_once("Admin/MVC/Models/AdminLongModel.php");
    class AdminLongController {

        public function index()
        {
            // header("Access-Control-Allow-Origin: *");
            // header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
            // header("Access-Control-Allow-Headers: Content-Type, Authorization");
            
            // // Serve the Vue app
            // $vue_app_path = '../Views/admin_view_long/vue-app/dist/index.html';
            // if (file_exists($vue_app_path)) {
            //     readfile($vue_app_path);
            // } else {
            //     echo "Vue app not built. Please run 'npm run build' in the vue-app directory.";
            // }
            require_once("Admin/MVC/Views/admin_view_long/public/index.php");
        }
    }
?>