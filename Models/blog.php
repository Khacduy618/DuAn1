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
   function select_comments(){ 
        $sql = "SELECT * FROM user JOIN comments  ON comments.comment_userEmail = user.user_email;";
        return pdo_query($sql);
   }
}
?>