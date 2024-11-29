<?php
    require_once 'model.php';

    class Category extends Model{
        private $table;
        private $contents;

        public function __construct(){
            $this->table = 'category';
            $this->contents = 'category_id';    
        }
        public function update_category($id, $name, $desc, $img, $parent_id, $level, $internal_link, $status) {
            // Xử lý upload ảnh
            $image_update = "";
            if(!empty($img['name'])) {
                $target_dir = "../../uploads/";
                $target_file = $target_dir . basename($img["name"]);
                if(move_uploaded_file($img["tmp_name"], $target_file)) {
                    $image_update = ", category_img = '" . $img['name'] . "'";
                }
            }

            // Tạo câu SQL động dựa trên việc có upload ảnh hay không
            $sql = "UPDATE $this->table SET 
                    category_name = ?, 
                    category_desc = ?,
                    parent_id = ?,
                    level = ?,
                    internal_link = ?,
                    category_status = ?
                    $image_update
                    WHERE $this->contents = ?";
                    
            return pdo_execute($sql, 
                $name, 
                $desc, 
                $parent_id, 
                $level, 
                $internal_link, 
                $status, 
                $id
            );
        }
        
    }
?>