<?php 
spl_autoload_register(function($class){
    include_once('./libs/'.$class.'.php');
});
use Random\Engine\Secure;
class AdminLongModel extends Dmodel{
    public function __construct(){
        parent::__construct();

    }
    public function login($table_admin,$username,$password){
        $sql = "SELECT * FROM $table_admin WHERE user_name=? AND user_password=? ";
        return $this->getConn()->affectedRows($sql,$username,$password); 
        
    }
    public function getLogin($table_admin,$username,$password){
        $sql = "SELECT * FROM $table_admin WHERE user_name=? AND user_password=? ";
        return $this->getConn()->selectUser($sql,$username,$password); 
    }
    public function select_all_by_email_user($table,$user_email){
        $sql = "SELECT * FROM $table WHERE user_email = :user_email ";
        $data = [
            ':user_email' => $user_email
        ];
        return $this->getConn()->select($sql,$data); 
    }
    // protected function check_ip(string $ip,array $session,array $cookie){
    //     return new AdminLongController();
    // }

    // category product
    public function call_categoryByList($table_category_product){
        $sql = "SELECT * FROM $table_category_product ORDER BY id_category_product DESC";
        return $this->getConn()->select($sql); // $table_product đối so cua select($table)
        
        // $sql = "SELECT * FROM product ORDER BY id_product DESC"; // DESC ASC
        // $result = $this->getConn()->select($sql);
        // return $result;

        // $query = $this->getConn()->query($sql); /*mysql_query($connect,$sql); */
        // $result = $query->fetchAll();
        // return $result;
    }
    
    /*
    public function getProduct($tableProduct,$condition){
        $sql = "SELECT * $tableProduct WHERE product_id='$condition'";
        return $this->query->select($sql);
    }
    */
    /*
    public function call_categoryById($table_product,$id){
        $sql = "SELECT * FROM $table_product WHERE id_product=:id"; //  ko dc :$id , cu phap voi sql , id_product là cột 1 trong db-tbl
        
        $data = array(':id' => $id);

        return $this->getConn()->select($sql,$data);
    }
    */

    public function call_categoryByList_home($table_category_product){
        $sql = "SELECT * FROM $table_category_product ORDER BY id_category_product DESC";
        return $this->getConn()->select($sql);
    }

    public function call_categoryById($table_category_product,$cond){

        $sql = "SELECT * FROM $table_category_product WHERE category_id = :category_id"; 
        $data = [':category_id' => $cond];
        return $this->getConn()->select($sql,$data);

        return $this->getConn()->select($sql);
    }

    public function call_categoryById_home($table_category_product,$table_product,$id){
        // $cond = "$table_category_product.id_category_product = $table_product.id_category_product AND $table_product.id_category_product = '$id' ";
        // $sql = "SELECT * FROM $table_category_product,$table_product WHERE $cond ORDER BY $table_product.id_product DESC"; 
        $sql = "SELECT * FROM $table_category_product,$table_product WHERE $table_category_product.id_category_product=$table_product.id_category_product AND $table_product.id_category_product = '$id' ORDER BY $table_product.id_product DESC";


        return $this->getConn()->select($sql);
    }
    /*
    public function cateGoryById($table_product,$id){
        $sql = "SELECT * FROM $table_product WHERE id_product=:id"; //  ko dc :$id , cu phap voi sql , id_product là cột 1 trong db-tbl
        $statement = $this->getConn()->prepare($sql);
        $statement->bindParam(':id',$id); //  bindParam() ràn bộc parameter, thay thế :id bằng $id
        $statement->execute();
        return $statement->fetchAll();
    }
    */

    public function call_insert_category($table_category_product,$data){
        return $this->getConn()->insert($table_category_product,$data);
    }

    public function call_update_category($table_category_product,$data,$cond){

        return $this->getConn()->update($table_category_product,$data,"category_id =".$cond);
    }
    public function call_delete_category($table_category_product,$cond){

        return $this->getConn()->delete($table_category_product,$cond);
    }
    public function call_delete_category_soft($table_category_product,$data,$cond){
        // đang dùng xóa mềm
        return $this->getConn()->update($table_category_product,$data,"category_id = ".$cond);
    }
    public function call_list_category_product($table_category_product){
        $sql = "SELECT * FROM $table_category_product ORDER BY category_id DESC";
        return $this->getConn()->select($sql); 
    }
    // category product end

    // category post
    public function call_insert_category_post($table_post,$data){
        
        return $this->getConn()->insert($table_post,$data);
    }

    public function call_list_category_post($table_post){
        $sql = "SELECT * FROM $table_post ORDER BY id_category_post DESC";
        return $this->getConn()->select($sql); 
    }

    public function call_list_category_post_home($table_post){
        $sql = "SELECT * FROM $table_post ORDER BY id_category_post DESC";
        return $this->getConn()->select($sql); 
    }

    public function call_delete_category_post($table_post,$cond){
        return $this->getConn()->delete($table_post,$cond);
    }

    public function call_categoryById_post($table_post,$cond){
        $sql = "SELECT * FROM $table_post WHERE $cond"; 


        return $this->getConn()->select($sql);
    }

    public function call_update_category_post($table_post,$data,$cond){

        return $this->getConn()->update($table_post,$data,$cond);
    }

    // category post end

    //product

    // public function call_list_hot_product_index($table_product,$cond){
    //     $sql = "SELECT * FROM $table_product WHERE $cond ORDER BY $table_product.id_product DESC "; 

    //     return $this->getConn()->select($sql);
    // } hot_product co ddieu kien

    //code chua toi uu , co the doi
    // public function call_list_product_in_category_menu_index($table_category_product,$table_product,$cond){
    //     $sql = "SELECT * FROM $table_category_product,$table_product WHERE $cond ORDER BY $table_product.id_product DESC "; 

    //     return $this->getConn()->select($sql);
    // }

    public function call_list_product_hot_index($table_product){
        $sql = "SELECT * FROM $table_product WHERE hot_product = 1 ORDER BY $table_product.id_product DESC "; 
        
        return $this->getConn()->select($sql);
    }

    public function call_list_product_index($table_product){
        $sql = "SELECT * FROM $table_product ORDER BY $table_product.product_id DESC "; 
        // $sql = "SELECT * FROM $table_product ORDER BY $table_product.product_id DESC "; 

        return $this->getConn()->select($sql);
    }

    public function call_related_product_home($table_category_product,$table_product,$cond_related){
        $sql = "SELECT * FROM $table_category_product,$table_product WHERE $cond_related"; 

        return $this->getConn()->select($sql);
    }

    public function call_detals_product_home($table_category_product,$table_product,$cond){
        $sql = "SELECT * FROM $table_category_product,$table_product WHERE $cond ORDER BY $table_product.id_product DESC";
        return $this->getConn()->select($sql); 
    }

    public function call_list_product_home($table_product){
        $sql = "SELECT * FROM $table_product ORDER BY $table_product.id_product DESC "; 

        return $this->getConn()->select($sql);
    }

    public function call_productById_home($table_category_post,$table_product,$id){
        $sql = "SELECT * FROM $table_category_post,$table_product WHERE $table_category_post.id_category_product=$table_product.id_category_product AND $table_product.id_category_product = '$id' ORDER BY $table_product.id_product DESC";
        return $this->getConn()->select($sql);
    }

    public function call_insert_product($table_product,$data){

        
        return $this->getConn()->insert($table_product,$data);
    }

    public function call_list_product($table_product,$table_category_product){     
        $sql = "SELECT * FROM $table_product,$table_category_product WHERE $table_product.id_category_product=$table_category_product.id_category_product ORDER BY $table_product.id_product DESC";
        return $this->getConn()->select($sql); 
    }

    public function call_delete_product($table_product,$cond){
        // ko được dùng nhé xóa mềm thôi
        return $this->getConn()->delete($table_product,"product_id = ".$cond);
    }
    public function call_delete_product_soft($table_product,$data,$cond){
        // đang dùng xóa mềm
        return $this->getConn()->update($table_product,$data,"product_id = ".$cond);
    }


    

    public function call_productById($table_product,$cond){

        $sql = "SELECT * FROM $table_product WHERE product_id = :product_id"; 
        $data = [':product_id' => $cond];
        return $this->getConn()->select($sql,$data);
        
    }
    public function call_productById_jion($table_product,$table_category_product,$cond){

        $sql = "SELECT * FROM $table_product,$table_category_product WHERE $table_product.product_cat=$table_category_product.category_id AND $table_product.product_id = :product_id"; 
        $data = [':product_id' => $cond];
        return $this->getConn()->select($sql,$data);
        
    }

    public function call_update_product($table_product,$data,$cond){

        return $this->getConn()->update($table_product,$data,"product_id = $cond");
    }

    // end product

    // order
    public function insert_order($table_order,$data_order){
        return $this->getConn()->insert($table_order,$data_order);
    }
    // end order

    //  post

    public function call_list_post_index($table_post){
        $sql = "SELECT * FROM $table_post ORDER BY id_post DESC LIMIT 5";
        return $this->getConn()->select($sql); 
    }

    public function call_related_post_home($table_category_post,$table_post,$cond_related){
        $sql = "SELECT * FROM $table_category_post,$table_post WHERE $cond_related ORDER BY $table_post.id_post DESC";
        return $this->getConn()->select($sql); 
    }

    public function call_detals_post_home($table_category_post,$table_post,$cond){
        $sql = "SELECT * FROM $table_category_post,$table_post WHERE $cond ORDER BY $table_post.id_post DESC";
        return $this->getConn()->select($sql); 
    }

    public function call_list_post_home($table_post){
        $sql = "SELECT * FROM $table_post ORDER BY $table_post.id_post DESC";
        return $this->getConn()->select($sql);
    }

    public function call_categoryByList_post($table_category_post){
        $sql = "SELECT * FROM $table_category_post ORDER BY id_category_post DESC";
        return $this->getConn()->select($sql);        
    }

    public function call_byid_post($table_post,$cond){

        $sql = "SELECT * FROM $table_post WHERE $cond"; 

        return $this->getConn()->select($sql);
    }

    public function call_insert_post($table_post,$data){
        
        return $this->getConn()->insert($table_post,$data);
    }

    public function call_list_post($table_post,$table_category_post){
        //vi để lấy ra tên danh mục san phâm thay vi id danh muc san pham
        $sql = "SELECT * FROM $table_post,$table_category_post WHERE $table_post.id_category_post=$table_category_post.id_category_post ORDER BY $table_post.id_post DESC";
        return $this->getConn()->select($sql); 
    }

    public function call_postById_home($table_category_post,$table_post,$id){
        $sql = "SELECT * FROM $table_category_post,$table_post WHERE $table_category_post.id_category_post=$table_post.id_category_post AND $table_post.id_category_post = '$id' ORDER BY $table_post.id_post DESC";
        return $this->getConn()->select($sql);
    }

    public function call_delete_post($table_post,$cond){
        return $this->getConn()->delete($table_post,$cond);
    }

    public function call_update_post($table_post,$data,$cond){

        return $this->getConn()->update($table_post,$data,$cond);
    }

    // post end

    // user
    public function call_update_user($table_user,$data,$cond){
        return $this->getConn()->update($table_user,$data,"user_email = '$cond'"); 
    }
    public function call_insert_user($table_user,$data){
        
        return $this->getConn()->insert($table_user,$data);
    }
    // user end
    
}