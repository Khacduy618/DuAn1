<?php 
// spl_autoload_register(function($class){
//     include_once('./libs/'.$class.'.php');
// });
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
    public function call_list_product_index_jion($table_product,$table_category_product,$table_products_details){
        $sql = "SELECT * FROM $table_product
        join $table_category_product ON $table_product.product_cat=$table_category_product.category_id 
        join $table_products_details ON $table_product.product_id=$table_products_details.pro_id
         ORDER BY $table_product.product_cat DESC "; 
        // $sql = "SELECT * FROM $table_product ORDER BY $table_product.product_id DESC "; 

        return $this->getConn()->select($sql);
    }
    public function call_list_product_index_jion_detail($table_product,$table_product_detail){
        $sql = "SELECT * FROM $table_product 
        JOIN $table_product_detail ON $table_product.product_id=$table_product_detail.pro_id
         ORDER BY $table_product.product_cat DESC ";
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
    public function getProductById_debug($table_product,$product_id) { // dùng để debug
        try {
            $sql = "SELECT * FROM $table_product WHERE product_id = :product_id";
            $stmt = $this->getConn()->prepare($sql);
            $stmt->bindParam(':product_id', $product_id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            error_log("SQL Query: " . $sql);
            error_log("Product ID: " . $product_id);
            error_log("Query Result: " . print_r($result, true));
            return $result;
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return false;
        }
    }
    public function getProductById($table_product,$table_category_product, $product_id) {
        try {
            $sql = "SELECT * FROM $table_product
                    JOIN $table_category_product ON $table_product.product_cat = $table_category_product.category_id
                    WHERE product_id = :product_id";
            $stmt = $this->getConn()->prepare($sql);
            $stmt->bindParam(':product_id', $product_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return false;
        }
    }
    

    public function call_update_product($table_product,$data,$cond){

        return $this->getConn()->update($table_product,$data,"product_id = $cond");
    }

    public function update_product_for_ajax($table,$data,$product_id){
            try {
                // Log dữ liệu để debug
                error_log("Updating product with data: " . print_r($data, true));
                error_log("Product ID: " . $product_id);
                 // Tạo câu SQL UPDATE
                $updateFields = [];
                foreach ($data as $key => $value) {
                    $updateFields[] = "$key = :$key";
                }
                $sql = "UPDATE $table SET " . implode(', ', $updateFields) . " WHERE product_id = :product_id";
                
                // Thêm product_id vào data để bind
                $data['product_id'] = $product_id;
                
                error_log("SQL Query: " . $sql);
                error_log("Bind params: " . print_r($data, true));
                 // Thực hiện update
                $result = $this->getConn()->update($table, $data, "product_id = '$product_id'");
                
                error_log("Update result: " . ($result ? "true" : "false"));
                
                return $result;
            } catch (Exception $e) {
                error_log("Error in call_update_product: " . $e->getMessage());
                return false;
            }
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
class Hanghoa extends Dmodel implements IEntity
{
    public function __construct()
    {
        parent::__construct();
    }
    public function rules(): array
    {
        return [];
    }
    public function renderAll(int $offset,int $limit){
        $sql = "
        SELECT products.*, categories.*, products_details.* 
        FROM products
        JOIN categories ON products.product_cat = categories.category_id
        JOIN products_details ON products_details.pro_id = products.product_id
        ORDER BY created_at DESC
        LIMIT :offset , :limit
        ";
        $data = [':offset' => (int)$offset,':limit' => (int)$limit];
        return $this->getConn()->select_settype($sql,$data);
    }
    public function call_affectedRows_pagination($table){
        $sql = "SELECT * FROM $table";
        $statement = $this->getConn()->prepare($sql);
        $statement->execute();
        return $statement->rowCount();
    }
    public function add()
    {
        
    }
    
    public function update()
    {
        
    }
    public function detele()
    {
        
    }
    public function createObject_setProperty($classname)
    {
        return $this->getConn()->pdo_select_all_object('hanghoa','NgayTao',$classname);
    }
}

class Thongke extends Dmodel 
{
    public function __construct()
    {
        parent::__construct();
    }
    public function rules(): array
    {
        return [];
    }
    public function thong_ke_hang_hoa(){
        $sql = "
            select a.MaLoai, b.TenLoai, count(*) as SoLuong, 
            min(a.DonGia) as giaMin,
            max(a.DonGia) as giaMax,
            avg(a.DonGia) as giaAVG
            from hanghoa as a 
            join loai as b
            on a.MaLoai = B.MaLoai
            group by a.MaLoai, b.MaLoai;
        ";
        return $this->getConn()->pdo_query($sql);
    }
    
    public function thong_ke_binh_luan(){
        $sql = "
            select 
            hh.MaHH, hh.TenHH, count(*) SoLuong,
            min(bl.NgayBL) as CuNhat,
            max(bl.NgayBL) as MoiNhat 
            from binhluan as bl
            join hanghoa as hh
            on bl.MaHH = hh.MaHH
            group by HH.MaHH, HH.TenHH
            having SoLuong > 0;
        ";
        return $this->getConn()->pdo_query($sql);
    }
    public function createObject_setProperty($classname,$bang_thong_ke = [])
    {
        $sql ='';
        switch($bang_thong_ke)
        {
            case 'binhluan':
                $sql = "
                    select 
                    hh.MaHH, hh.TenHH, count(*) SoLuong,
                    min(bl.NgayBL) as CuNhat,
                    max(bl.NgayBL) as MoiNhat 
                    from binhluan as bl
                    join hanghoa as hh
                    on bl.MaHH = hh.MaHH
                    group by HH.MaHH, HH.TenHH
                    having SoLuong > 0;
                ";
                break;
            case 'hanghoa':
                $sql = "
                    select a.MaLoai, b.TenLoai, count(*) as SoLuong, 
                    min(a.DonGia) as giaMin,
                    max(a.DonGia) as giaMax,
                    avg(a.DonGia) as giaAVG
                    from hanghoa as a 
                    join loai as b
                    on a.MaLoai = B.MaLoai
                    group by a.MaLoai, b.MaLoai;
                ";
                break;
            default :
                $sql = "select * from hanghoa";
                break;
                
        }
        return $this->getConn()->pdo_query_object($sql,$classname);
    }
}
class Khachhang extends Dmodel implements IEntity
{
    public function __construct()
    {
        parent::__construct();
    }
    public function rules(): array
    {
        return [];
    }
    
    public function renderAll(int $offset,int $limit)
    {
        return $this->getConn()->pdo_select_all('user','user_email desc');
    }
    public function add()
    {

    }
    
    public function update()
    {
        
    }
    public function detele()
    {
        
    }
    public function createObject_setProperty($classname)
    {
        return $this->getConn()->pdo_select_all_object('khachhang','NgayTao',$classname);
    }
}

class Loai extends Dmodel implements IEntity
{
    public function __construct()
    {
        parent::__construct();
    }
    public function rules(): array
    {
        return [];
    }
    public function renderAll(int $offset,int $limit){
        return $this->getConn()->pdo_select_all('loai','NgayTao desc');
    }
    public function add()
    {
        
    }
    
    public function update()
    {
        
    }
    public function detele()
    {
        
    }
    public function createObject_setProperty($classname)
    {
        return $this->getConn()->pdo_select_all_object('loai','NgayTao',$classname);
    }
}

class RegisterModel extends Models 
{
    public string $ho = '';
    public string $ten = '';
    public string $email = '';
    // public string $maKH = '';
    public string $matkhau = '';
    public string $nhaplaimatkhau = '';




    public function rules(): array
    {
        return [
            'ho' => [self::RULES_REQUIRED],
            'ten' => [self::RULES_REQUIRED],
            'email' => [self::RULES_REQUIRED,self::RULES_EMAIL],
            // 'maKH' => [self::RULES_REQUIRED,[self::RULES_MIN,'min'=>8],[self::RULES_MAX,'max'=>15] ],
            'matkhau' => [self::RULES_REQUIRED,[self::RULES_MIN,'min'=>8],[self::RULES_MAX,'max'=>15] ],
            'nhaplaimatkhau' => [self::RULES_REQUIRED,[self::RULES_MATCH,'match'=>'password' ] ],
        ];
    }

    public function select_all()
    {
        $db = new DatabaseManager('mysql:host=localhost;dbname=setup_database', 'root', '');
        return $db->pdo_select_all('taikhoan', 'NgayTao desc');
    }


    public function register()
    {
        echo 'applied đăng ký';
    }
    
}

class Hoadon extends Dmodel implements IEntity
{
    public function __construct()
    {
        parent::__construct();
    }
    public function rules(): array
    {
        return [];
    }
    public function renderAll(int $offset,int $limit)
    {
        return $this->getConn()->pdo_select_all('hoadon','NgayTao desc');
    }
    public function add()
    {
        
    }
    
    public function update()
    {
        
    }
    public function detele()
    {
        
    }
    public function createObject_setProperty($classname)
    {
        return $this->getConn()->pdo_select_all_object('hoadon','NgayTao',$classname);
    }
}

class Danhmucbaiviet extends Dmodel implements IEntity
{
    public function __construct()
    {
        parent::__construct();
    }
    public function rules(): array
    {
        return [];
    }
    public function renderAll(int $offset,int $limit)
    {
        return $this->getConn()->pdo_select_all('danhmucbaiviet','NgayTao desc');
    }
    public function add()
    {
        
    }
    
    public function update()
    {
        
    }
    public function detele()
    {
        
    }
    public function createObject_setProperty($classname)
    {
        return $this->getConn()->pdo_select_all_object('danhmucbaiviet','NgayTao',$classname);
    }
}

class Chitiethoadon extends Dmodel implements IEntity
{
    public function __construct()
    {
        parent::__construct();
    }
    public function rules(): array
    {
        return [];
    }
    public function renderAll(int $offset,int $limit)
    {
        return $this->getConn()->pdo_select_all('chitiethoadon','NgayTao desc');
    }
    public function add()
    {
        
    }
    
    public function update()
    {
        
    }
    public function detele()
    {
        
    }
    public function createObject_setProperty($classname)
    {
        return $this->getConn()->pdo_select_all_object('chitiethoadon','NgayTao',$classname);
    }
}

class Binhluan extends Dmodel implements IEntity
{
    public function __construct()
    {
        parent::__construct();
    }
    public function rules(): array
    {
        return [];
    }
    public function renderAll(int $offset,int $limit)
    {
        return $this->getConn()->pdo_select_all('binhluan','NgayTao desc');
    }
    public function add()
    {
        
    }
    
    public function update()
    {
        
    }
    public function detele()
    {
        
    }
    public function createObject_setProperty($classname)
    {
        return $this->getConn()->pdo_select_all_object('binhluan','NgayTao',$classname);
    }
}
class Baiviet extends Dmodel implements IEntity
{
    public function __construct()
    {
        parent::__construct();
    }
    public function rules(): array
    {
        return [];
    }
    public function renderAll(int $offset,int $limit)
    {
        return $this->getConn()->pdo_select_all('baiviet','NgayTao desc');
    }
    public function add()
    {
        
    }
    public function update()
    {
        
    }
    public function detele()
    {
        
    }
    public function createObject_setProperty($classname)
    {
        return $this->getConn()->pdo_select_all_object('baiviet','NgayTao',$classname);
    }
}

class ContactForm extends Models
{
    public string $subject = '';
    public string $email = '';
    public string $body = '';

    public function rules(): array
    {
        return [
            'subject' => [self::RULES_REQUIRED],
            'email' => [self::RULES_REQUIRED,self::RULES_EMAIL],
            'body' => [self::RULES_REQUIRED ],
        ];
    }

    public function labels(): array
    {
        return [
            'subject' => 'Chủ Đề',
            'email' => "Email",
            'body' => "Nội Dung"
        ];
    }

    public function send()
    {
        return true;
    }


}
class DangKyModel extends Models //extends DbModel
{
    public string $ho = '';
    public string $ten = '';
    public string $email = '';
    public string $matkhau = '';
    public string $nhaplaimatkhau = '';

    public function rules(): array
    {
        return [
            'ho' => [self::RULES_REQUIRED],
            'ten' => [self::RULES_REQUIRED],
            'email' => [self::RULES_REQUIRED,self::RULES_EMAIL],
            // 'maKH' => [self::RULES_REQUIRED,[self::RULES_MIN,'min'=>8],[self::RULES_MAX,'max'=>15] ],
            'matkhau' => [self::RULES_REQUIRED,[self::RULES_MIN,'min'=>8],[self::RULES_MAX,'max'=>15] ],
            'nhaplaimatkhau' => [self::RULES_REQUIRED,[self::RULES_MATCH,'match'=>'matkhau' ] ],
        ];
    }

    public function register()
    {
        echo 'applied đăng ký';
    }
}
class DangNhapModel extends Models
{
    public string $email = '';
    public string $matkhau = '';

    public function rules(): array
    {
        return [
            'email' => [self::RULES_REQUIRED,self::RULES_EMAIL],
            // 'maKH' => [self::RULES_REQUIRED,[self::RULES_MIN,'min'=>8],[self::RULES_MAX,'max'=>15] ],
            'matkhau' => [self::RULES_REQUIRED,[self::RULES_MIN,'min'=>8],[self::RULES_MAX,'max'=>15] ],
        ];
    }

    public function login()
    {
        echo 'applied đăng nhập';
    }
}
class LoginForm extends Models 
{
    protected const  STATUS_INACTIVE = 0;
    protected const  STATUS_ACTIVE = 1;
    protected const  STATUS_DELETE = 2;

    public string $email = '';
    public int $trangthai = self::STATUS_INACTIVE;
    public string $matkhau = '';

    public function rules(): array
    {
        return [
            'email' => [self::RULES_REQUIRED,self::RULES_EMAIL],
            // 'maKH' => [self::RULES_REQUIRED,[self::RULES_MIN,'min'=>8],[self::RULES_MAX,'max'=>15] ],
            'matkhau' => [self::RULES_REQUIRED,[self::RULES_MIN,'min'=>8],[self::RULES_MAX,'max'=>15] ],
        ];
    }

    public static function getTableName($tableName = 'taikhoan'): string
    {
        return $tableName;
    }

    public static function getAttributes(): array // dang sida 100% luôn ko co array_values, được nạp bằng FetchOject() stdClass, ko chỉ định class nào
    {
        $defaul = [
            'email',
            'matkhau',
        ];
        return $defaul;
    }

    public static function getPrimaryKey($primaryKey = 'id'): string
    {
        return $primaryKey;
    }

    public function labels(): array
    {
        return [
            'email' => "Email",
            'matkhau' => "Mật Khẩu",
        ];
    }

    public function login()
    {
        $user = User::findOne(['email' => $this->email]); 
        if(!$user)
        {
            $this->addErrorForNotRule('email','Email hoặc Tài Khoản này không tồn tại');
            return false;
        }
        if(!password_verify($this->matkhau,$user->matkhau)) // hiện tại đang dùng mã hóa 2y ,so sanh matkhau từ form (ở đây là method POST) với kết quả từ database
        {
            $this->addErrorForNotRule('matkhau','Mật Khẩu không đúng');
            return false;
        }
        // Utility::showObject($user);
        // exit;
        $ctl = new AdminLongController();
        return $ctl->login($user); // return true;
        
    }
}
class User extends UserModel // extends DbModel //extends Models
{
    protected const  STATUS_INACTIVE = 0;
    protected const  STATUS_ACTIVE = 1;
    protected const  STATUS_DELETE = 2;

    public string $ho = '';
    public string $ten = '';
    public string $email = '';
    public int $trangthai = self::STATUS_INACTIVE;
    public string $matkhau = '';
    public string $nhaplaimatkhau = '';

    public function rules(): array
    {
        return [
            'ho' => [self::RULES_REQUIRED],
            'ten' => [self::RULES_REQUIRED],
            'email' => [self::RULES_REQUIRED,self::RULES_EMAIL,[self::RULES_UNIQUE,'class' => self::class ]], //,'attr'=>'email'
            // 'maKH' => [self::RULES_REQUIRED,[self::RULES_MIN,'min'=>8],[self::RULES_MAX,'max'=>15] ],
            'matkhau' => [self::RULES_REQUIRED,[self::RULES_MIN,'min'=>8],[self::RULES_MAX,'max'=>15] ],
            'nhaplaimatkhau' => [self::RULES_REQUIRED,[self::RULES_MATCH,'match'=>'matkhau'] ],
        ];
    }

    public static function getTableName($tableName = 'taikhoan'): string
    {
        return $tableName;
    }

    

    public static function getAttributes(): array  // dang sida 100% luôn ko co array_values, được nạp bằng FetchOject() stdClass, ko chỉ định class nào
    {
        $defaul = [
            'ho',
            'ten',
            'email',
            'trangthai',
            'matkhau',
        ];
        return $defaul;
    }

    public static function getPrimaryKey($primaryKey = 'id'): string
    {
        return $primaryKey;
    }

    public function labels(): array
    {
        return [
            'ho' => "Họ",
            'ten' => "Tên",
            'email' => "Email",
            'matkhau' => "Mật Khẩu",
            'nhaplaimatkhau' => "Nhập Lại Mật Khẩu"
        ];
    }

    public function save() : bool // ban đầu nó là method register , đang dùng tính chất da hình của OOP là sử dụng override method
    {
        $this->trangthai = self::STATUS_INACTIVE;
        $this->matkhau = md5($this->matkhau);
        
        return parent::save(); //echo 'applied đăng ký';
        
    }

    public function getDisplayName(): string
    {
        return $this->ho . ' ' . $this->ten;
    }


    /* mới thêm vào ban ngoài MVC origin */
    
}