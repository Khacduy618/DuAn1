<?php
abstract class Dcontroller{
    public $load;
    
    public function __construct()
    {
        $this->load = new Load();
        // define("BASE_URL","http://localhost:8080/DuAn1");
    }
    abstract public function render(string $nameView, array $model);
    
    function hash_pass($pass){
        return md5($pass);
    }
    function check_SERVER(){
        echo '<pre>';
        echo print_r($_SERVER).'<br>';
        echo '</pre>';
    }
    function check_server_method($method,$ve_controller_nao){
        if($_SERVER['REQUEST_METHOD'] != $method){
            session_destroy();
            $_SESSION['msg']= "Loi check_server_method nhap tu form";
            header('Location: '.BASE_URL.'/'. $ve_controller_nao);
        }
    }
    function check_post_variable($post_variable,$ve_controller_nao){
        if(!($_POST[$post_variable])?? false){
            session_destroy();
            $_SESSION['msg']= "Loi check_post_variable nhap tu form";
            header('Location: '.BASE_URL.'/'. $ve_controller_nao);
        }
    }
                                                                                                                                                                                                                                                        function kiem_tra_co_ky_tu_dat_biet($input){
                                                                                                                                                                                                                                                        if (preg_match('/[\'^£$%&*()}{#~?><>,|=_+¬-]/', $input)) { 
                                                                                                                                                                                                                                                                return true;
                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                return false;
                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                        function kiem_tra_soluong_kytu($input){
                                                                                                                                                                                                                                                            if (strlen($input)<=5) { 
                                                                                                                                                                                                                                                                    return true;
                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                    return false;
                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                        function check_input_space($input){
                                                                                                                                                                                                                                                            if (preg_match('/[\'^£$%&*()}{#~?><>,|=_+¬-]/', $input)) { 
                                                                                                                                                                                                                                                                    return true;
                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                    return false;
                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                        function check_get_variable($post_variable,$ve_controller_nao){
                                                                                                                                                                                                                                                            if(!($_GET[$post_variable])?? false){
                                                                                                                                                                                                                                                                session_destroy();
                                                                                                                                                                                                                                                                header('Location: '.BASE_URL.'/'. $ve_controller_nao);
                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                    protected function check_input_len($input){
                                                                                                                                                                                                                                                                                                                                                                        if (strlen($input)<=5) { 
                                                                                                                                                                                                                                                                                                                                                                                return true;
                                                                                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                                                                                return false;
                                                                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                                                                    }
    

                                                                                                                                                                                                                                                                                                                                                                    protected function  setSecurityHash($data_set){
                                                                                                                                                                                                                                                                                                                                                                        return password_hash($data_set, PASSWORD_BCRYPT, ['cost' => 12]);
                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                    protected function getSecurityHash($input,$storedHash){
                                                                                                                                                                                                                                                                                                                                                                        return password_verify($input, $storedHash);
                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                    protected function setSecurityEncryption($data_set, $key) {
                                                                                                                                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                                                                                                                                        $encryptedData = openssl_encrypt($data_set, "AES-128-ECB", $key);
                                                                                                                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                                                                                                                                        $encryptedDataBase64 = base64_encode($encryptedData);
                                                                                                                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                                                                                                                        return $encryptedDataBase64;
                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                    protected function getSecurityEncryption($input, $key) {
                                                                                                                                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                                                                                                                                        $encryptedData = base64_decode($input);
                                                                                                                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                                                                                                                                        $decryptedData = openssl_decrypt($encryptedData, "AES-128-ECB", $key);
                                                                                                                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                                                                                                                        return $decryptedData;
                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                    protected function isAesEncrypted($data_member) {
                                                                                                                                                                                                                                                                                                                                                                        if (is_string($data_member)) {
                                                                                                                                                                                                                                                                                                                                                                            return base64_decode($data_member, true) !== false && strlen($data_member) % 4 === 0;
                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                        return false; 
                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                    protected function decryptArray($data, $key) {
                                                                                                                                                                                                                                                                                                                                                                        return array_map(function ($item) use ($key) {
                                                                                                                                                                                                                                                                                                                                                                            if (is_array($item)) {
                                                                                                                                                                                                                                                                                                                                                                                return $this->decryptArray($item, $key);
                                                                                                                                                                                                                                                                                                                                                                                           }
                                                                                                                                                                                                                                                                                                                                                                            if ($this->isAesEncrypted($item)) {
                                                                                                                                                                                                                                                                                                                                                                                return $this->getSecurityEncryption($item, $key); 
                                                                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                                                                            return $item; 
                                                                                                                                                                                                                                                                                                                                                                        }, $data);
                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                                                                                                                    
    #begin check and isset and init variable                                                                                                                                                                                                                                                                                                                                                   
    function cvldl($input,$soluongkytu,$ve_controller_nao){
        if (strlen($input)<= $soluongkytu) { 
            return htmlspecialchars($input);
        } else {
            $redirect_url = BASE_URL . '/' . $ve_controller_nao;
            header('Location: ' . $redirect_url);
            exit;
        }
    }
    function cvld($input, $ve_controller_nao) {
        if (preg_match('/[\'^£$%&*()}{#~?><>,|=_+¬-]/', $input)) { 
            return htmlspecialchars($input);
        } else {
            $redirect_url = BASE_URL . '/' . $ve_controller_nao;
            header('Location: ' . $redirect_url);
            exit;
        }
    }
    function iipv($post_variable, $ve_controller_nao) {
        if (isset($_POST[$post_variable]) && !empty($_POST[$post_variable])) {
            return htmlspecialchars($_POST[$post_variable]);
        } else {
            $redirect_url = BASE_URL . '/' . $ve_controller_nao;
            $_SESSION['msg']= "Loi iipv nhap tu form";
            header('Location: ' . $redirect_url);
            exit;
        }
    }
    function iifnv($post_variable,$ve_controller_nao){
        if(($_FILES[$post_variable])?? false){
            return $_FILES[$post_variable]['name'];
        }else{
            $redirect_url = BASE_URL . '/' . $ve_controller_nao;
            $_SESSION['msg']= "Loi ten hinh nhap tu form";
            header('Location: ' . $redirect_url);
            exit;
        }
    }
    function iiftnv($post_variable, $ve_controller_nao) {
        if (isset($_FILES[$post_variable]) && !empty($_FILES[$post_variable]['tmp_name'])) {
            return $_FILES[$post_variable]['tmp_name']; 
        } else {
            $redirect_url = BASE_URL . '/' . $ve_controller_nao;
            $_SESSION['msg'] = "Lỗi giá trị form Hình ảnh";
            header('Location: ' . $redirect_url);
            exit;
        }
    }
    
    function iigv($get_variable,$ve_controller_nao){
        if(isset($_POST[$get_variable]) && !empty($_POST[$get_variable])){
            return htmlspecialchars($_GET[$get_variable]);
        }else{
            $redirect_url = BASE_URL . '/' . $ve_controller_nao;
            header('Location: ' . $redirect_url);
            exit;
        }
    }
    function ciipv($post_variable,$soluongkytu = 5, $ve_controller_nao) {
        // kiem tra bien string post co ton tai, ky tu dac biet, so luong ky
        $post = $_POST[$post_variable];
        
        $cvld = (strlen($post)<= $soluongkytu)? false : true;
        $cvldl = (preg_match('/[\'^£$%&*()}{#~?><>,|=_+¬-]/', $post) == false )? true: false;
        
        if ($cvldl != false  && $cvld != false  &&isset($post) && !empty($post)) {
            return htmlspecialchars($post);
        } else {
            $redirect_url = BASE_URL . '/' . $ve_controller_nao;
            $_SESSION['msg']= "Loi ciipv gia tri nhap tu form $post_variable";
            header('Location: ' . $redirect_url);
            exit;
        }
    }
    function lciipv($post_variable,$soluongkytu = 5, $ve_controller_nao) {
        // kiem tra bien post link co ton tai, ky tu dac biet, so luong ky
        $post = $_POST[$post_variable];
        
        $cvld = (strlen($post)<= $soluongkytu)? false : true;
        $cvldl = (preg_match('/[\'^£$%*()}{#~?><>,|=_+¬-]/', $post) == false )? true: false;
        
        if ($cvldl != false  && $cvld != false  &&isset($post) && !empty($post)) {
            return $post;
        } else {
            $redirect_url = BASE_URL . '/' . $ve_controller_nao;
            $_SESSION['msg']= "Loi lciipv gia tri nhap tu form";
            header('Location: ' . $redirect_url);
            exit;
        }
    }
    function intpv($post_variable, $ve_controller_nao) {
        // kiem tra bien post có là kiểu int ko, so nguyên
        $post = $_POST[$post_variable];
        $int_value = filter_var($post, FILTER_VALIDATE_INT);
        if ($int_value === false) {
            $redirect_url = BASE_URL . '/' . $ve_controller_nao;
            $_SESSION['msg']= "Loi intpv gia tri nhap tu form ";
            header('Location: ' . $redirect_url);
            exit;
        } else {
            return $post;
        }
    }
    function cccpv($post_variable1,$post_variable2, $ve_controller_nao) {
        // kiem tra 2 biên post chat-string có giống nhau ko
        if ($post_variable1 === $post_variable2) {
            return true;
        } else {
            $redirect_url = BASE_URL . '/' . $ve_controller_nao;
            $_SESSION['msg']= "Loi gia tri nhap tu form";
            header('Location: ' . $redirect_url);
            exit;
        }
    }
    #end check and isset and init variable

    #begin move_upload_file unlink
    function mulfnew_return($file_name,$file_tmp_name,$part_upload,$ve_controller_nao){
        //dung ok
        if(!file_exists(rtrim($part_upload,'/'))) mkdir(rtrim($part_upload,'/'));
        $file_parts = explode('.', $file_name);
        $file_parts[0]= $file_parts[0].'_'.time(); 
        $new_file_name = implode('.', $file_parts); 
        $mulfnew = move_uploaded_file($file_tmp_name,$part_upload.$new_file_name);
        if($mulfnew == false){
             $_SESSION['msg']= "ko the load_up_file den ".$part_upload;
             $redirect_url = BASE_URL . '/' . $ve_controller_nao;
            header('Location: ' . $redirect_url);
        }else{
            return $new_file_name;
        }
    }
    function mulfnew(&$file_name_out,$file_tmp_name,$part_upload,$ve_controller_nao){
        //con phai test them, param file_name_out ,Lay args là Chinh $_POST['HinhAnh']['name] có lúc thì fill trên đatabase là 1 array , ở part_upload cũng là 1 array, hay nè
        if(!file_exists(rtrim($part_upload,'/'))) mkdir(rtrim($part_upload,'/'));
        $file_name_out = explode('.', $file_name_out);
        $file_name_out[0]= $file_name_out[0].'_'.time(); 
        $file_name_out = implode('.', $file_name_out); 
        $mulfnew = move_uploaded_file($file_tmp_name,$part_upload.$file_name_out);
        if($mulfnew == false){
             $_SESSION['msg']= "ko the load_up_file den ".$part_upload;
             $redirect_url = BASE_URL . '/' . $ve_controller_nao;
            header('Location: ' . $redirect_url);
        }
    }
    function ulfold($TenImgOld,$part_upload,$ve_controller_nao){
        $filename = $part_upload.$TenImgOld;
        if(file_exists($filename)) $chk_unlink = unlink($filename);
        $chk_unlink = true;
        if($chk_unlink  == false)  {
            $_SESSION['msg'] = "ko the unlink file tu ".$part_upload ; 
            $redirect_url = BASE_URL . '/' . $ve_controller_nao;
            header('Location: ' . $redirect_url);
        }
    }
    #end
    
    public function day_ve_home_huy_session_cookie(){
        header('Location: ' . BASE_URL);
        session_destroy();
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time() - 3600, '/');
                setcookie($name, '', time() - 3600, '/', $_SERVER['SERVER_NAME']);
            }
        }
    }
    public function day_ve_controller($ve_controller_nao){
        header('Location: '.BASE_URL.'/'. $ve_controller_nao);
    }
    // public function simple_page_html_dom($link){
    //     //https://simplehtmldom.sourceforge.io/docs/1.9/index.html
    //     $arrContentOption = [
    //         'ssl' => [
    //             "verify" => false,
    //             "verify_peer_name" => false
    //         ]
    //     ];
    //     $content = file_get_html(
    //         $link,false,stream_context_create($arrContentOption)
    //     );
    //     return $content;
    // }
    
}

?>