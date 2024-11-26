<?php 
require_once 'model.php';
class Blog extends Model{ 
           var $table  = 'blogs';
           var $contents =  'blog_id' ; 
        function All()
    {
        $query = "select * from $this->table where active = 1 ORDER BY $this->contents DESC";
        return pdo_query($query);
        
    }
    function findByID($id_blog){
        $query = "select * from blogs where blog_id = ?";
        return pdo_query_one($query, $id_blog);
    }
    function countCommentofBlog($id) {
    $query = "SELECT COUNT(*) as total FROM comments WHERE comment_blog_id = ? AND active = 1";
    $result = pdo_query($query, $id); 
    return $result[0]['total'] ?? 0; 
}
    function getBlogsDeleted()
    {
        $query = "select * from $this->table where active = 0 ORDER BY $this->contents DESC";
        return pdo_query($query);
        
    }
        public function getAuthor(){
             $sql = "SELECT user_email FROM user WHERE user_role >= 1";
             return pdo_query($sql); 
        }
        public function addBlog($blog_title  , $blog_image , $blog_pro_id, $blog_content , $author_email){
            $sql = "INSERT INTO blogs (blog_title, blog_image, blog_pro_id , blog_content, author_email) 
            VALUES ( ? ,  ?  , ? , ? ,  ?)";
            pdo_execute($sql ,$blog_title  ,  $blog_image , $blog_pro_id , $blog_content , $author_email  );
        }
        public function editBlog($blog_title  , $blog_image , $blog_pro_id, $blog_content  , $blog_id){
            $sql = "UPDATE blogs  SET blog_title = ?, 
            blog_image = ?, 
            blog_pro_id = ?, 
            blog_content = ?
        WHERE blog_id = ?";
            pdo_execute($sql ,$blog_title  ,  $blog_image , $blog_pro_id , $blog_content, $blog_id );
        }
        public function getAllProducts(){
            $sql = "SELECT product_name , product_id FROM products WHERE product_status = 1";
            return pdo_query($sql);
        }
        public function softDeleteBlog($id){ 
             $sql = "UPDATE blogs SET active = 0 WHERE blog_id = ?";
            pdo_execute($sql, $id);
        }
        public function getAllCommentsById($id){
             $sql = "SELECT * from comments WHERE comment_blog_id = ? AND active = 1";
            return pdo_query($sql , $id);
        }
        public function back_up($id){
             $sql = "UPDATE blogs SET active = 1 WHERE blog_id = ?";
            pdo_execute($sql, $id);
        }
        public function forceDeleteBlog($id){
             $sql = "DELETE FROM blogs WHERE blog_id = ?";
            pdo_execute($sql, $id);
        }

        public function softDeleteComment($id){ 
             $sql = "UPDATE comments SET active = 0 WHERE comment_id = ?";
            pdo_execute($sql, $id);
        }
        public function comment_back_up($id){
             $sql = "UPDATE comments SET active = 1 WHERE comment_id = ?";
            pdo_execute($sql, $id);
        }
        public function forceDeleteComment($id){
             $sql = "DELETE FROM comments WHERE comment_id = ?";
            pdo_execute($sql, $id);
        }
         function getCommentsDeleted()
        {
        $query = "select * from comments where active = 0 ORDER BY comment_id DESC";
        return pdo_query($query);
       }
        
    }
    
?>