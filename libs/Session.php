<?php 
    class Session{
        
        public static function init(){
            session_start();
        }

        public static function set($key,$val){
            $_SESSION[$key] = $val;
        }

        public static function get($key){
            if(isset($_SESSION[$key])){
                return $_SESSION[$key];
            }else{
                return false;
            }
        }

        public static function checkSession(){
            // self::init();
            $userrole = self::get('userrole');
            // $username = self::get('username');
            if(self::get('login')== false || $userrole !== 9){
            // if(self::get('login')== false || $userrole !== 9 || $username !== "leduylong"){
                self::destroy();
                header("Location: ?act=adminLong&ctlr=AdminLongController&method=login");
                return;
            }
        }
        public static function checkSession2(){
            // self::init();
            $userrole = self::get('userrole');
            // $username = self::get('username');
            if(self::get('login')== false || $userrole !== 8){
            // if(self::get('login')== false || $userrole !== 8 || $username !== "leduylong2"){
                self::destroy();
                header("Location: ?act=adminLong&ctlr=AdminLongController&method=login");
                return;
            }
        }

        public static function destroy(){
            session_destroy();
        }

        public static function unset($key){
            session_unset($key);
        }

    }

?>