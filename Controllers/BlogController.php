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
         $popular_posts = $this->blog_model->popular_post() ;
         $key_word =  ''; 
         $itemsPerPage = 5 ; 
         $total = $this->blog_model->TotalBlogs() ; 
         $currentPage = isset($_GET['page'])? $_GET['page'] : 1;
         $totalPages = ceil($total[0]['total'] / $itemsPerPage);
         $offset = ($currentPage - 1) * $itemsPerPage;
         $sql = "SELECT * FROM blogs LIMIT $offset, $itemsPerPage";
         $blogs_content = $this->blog_model->list_post($sql );
         if(isset($_POST['key_word'])){
             $key_word = $_POST['key_word']; 
             $blogs_content = $this->blog_model->search_blog($key_word);
         }
         //product popular
         $product_populars = $this->blog_model->product_top() ;
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
        $product_populars = $this->blog_model->product_top() ;
        require_once('Views/index.php');
    }
}
?>