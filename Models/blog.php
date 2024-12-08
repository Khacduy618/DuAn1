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
        $sql = "SELECT * FROM $this->table ORDER BY blog_view DESC LIMIT 0, 10";
        return pdo_query($sql);
    }
    function list_post($sql) {
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
   function TotalBlogs(){
     $sql = "SELECT COUNT(*) as total FROM blogs";
     return pdo_query($sql);
   }
   function search_blog($keyword){
     $sql = "SELECT * FROM blogs 
           JOIN products ON blogs.blog_pro_id = products.product_id 
           WHERE blog_title LIKE ? OR product_name LIKE ? 
       " ;
    return pdo_query($sql , '%'.$keyword.'%' , '%'.$keyword.'%') ; 
   }
   function product_top() {
            $sql = "SELECT p.*, COALESCE(SUM(bd.pro_count), 0) AS total_sold
FROM products p
LEFT JOIN bill_details bd ON p.product_id = bd.pro_id
WHERE p.product_status = 1 AND p.product_count > 0
GROUP BY p.product_id
ORDER BY total_sold DESC
LIMIT 5
                ";
            return pdo_query($sql);
        }
        function related_product($cat, $id) {
        $sql = "SELECT p.*
                FROM products p
                JOIN categories c ON p.product_cat = c.category_id 
                WHERE product_cat = ? AND product_id != ?";
        return pdo_query($sql, $cat, $id);
    }
    function detail_sp($id)
    {
        $sql =  "SELECT * from products where pro_id = ? ";
        return pdo_query_one($sql, $id);
    }
}
?>