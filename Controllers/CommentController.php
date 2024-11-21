<?php
require_once("Models/comment.php");
class commentControlller
{
    private $comment_model;
    public function __construct()
    {
       $this->comment_model = new Comment();
    }
    function comment_exc(){
        $blog_id = $_POST['blog_id'] ; 
        $user_email = $_SESSION['login']['user_email']; 
        $message = $_POST['message'] ; 
        $this->comment_model->_comment($blog_id ,  $user_email  , $message) ;
        header('Location: ?act=blog_detail&id_blog=' . urlencode($blog_id));
        exit; 
     }

}



?>