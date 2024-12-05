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
        $id = $_GET['id_blog']; 
        $comments = $this->blog_model->select_comments($id) ; 
        $popular_posts = $this->blog_model->popular_post();  
        $content_blog = $this->blog_model->findBy($id);
        $pro_id = $content_blog['blog_pro_id'];
        $related_blogs = $this->blog_model->get_related_blog($pro_id);
        $this->blog_model->update_blog_view($id);
        require_once('Views/index.php');
    }
}
?>