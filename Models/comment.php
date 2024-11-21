<?php
require_once("model.php");
class Comment{ 
    function _comment($blog_id  , $user_email ,  $message   ){
        $sql  = "INSERT INTO comments( comment_blog_id ,  comment_userEmail ,  comment_content )VALUES(? , ? , ? )" ; 
        return pdo_execute($sql ,  $blog_id , $user_email , $message) ; 
    }
}



?>