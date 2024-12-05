<?php
require_once("model.php");
class Blog extends Model
{
    var $table = "blogs";
    var $contents = "blog_id";
    function update_blog_view($id){
        $sql = "UPDATE $this->table SET blog_view = blog_view +  1 WHERE $this->contents = ? " ;
        return pdo_execute($sql , $id ) ;
    }
    function popular_post() {
        $sql = "SELECT * FROM $this->table ORDER BY blog_view DESC LIMIT 0, 4";
        return pdo_query($sql);
    }
    function get_related_blog($id_pro){
         $sql = "SELECT * FROM $this->table  WHERE blog_pro_id = ?";
        return pdo_query($sql, $id_pro);
    }
    function select_comments($blog_id) { 
    $sql = "SELECT * 
            FROM comments 
            JOIN user 
            ON comments.comment_userEmail = user.user_email 
            WHERE comment_blog_id = ?";
    return pdo_query($sql, $blog_id); 
}
}
?>