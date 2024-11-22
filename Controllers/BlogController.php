<?php
require_once("Models/blog.php");
class BlogController
{
    private $blog_model;
    public function __construct()
    {
       $this->blog_model = new Blog();
    }
    function Blog_View(){
         $blogs_content = $this->blog_model->list();
         $popular_posts = $this->blog_model->popular_post() ; 
         require_once('Views/index.php');
    }
    function Blog_Detail(){
        $comments = $this->blog_model->select_comments() ; 
        $id = $_GET['id_blog']; 
        $popular_posts = $this->blog_model->popular_post();  
        $content_blog = $this->blog_model->findBy($id);
        $this->blog_model->update_blog_view($id);
        require_once('Views/index.php');
    }
}
?>