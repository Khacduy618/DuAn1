<?php
    require_once 'model.php';

    class Category extends Model{
        public $table = 'categories';
        public $status = 'category_status';
        public $contents = 'category_id';

        public function __construct(){
            $this->table;
            $this->status;
            $this->contents;    
        }
        
        function list($keyword="", $status = "", $orderCondition="", $item_per_page="", $offset=""){
            $sql = "SELECT * FROM $this->table WHERE 1";
            if($keyword != ""){
                $sql .= " AND category_name LIKE '%".$keyword."%'";
            }
            if($status != ""){
                $sql .= " AND category_status = ".$status;
            }
            $sql .= $orderCondition;
            $sql .= " LIMIT ".$item_per_page." OFFSET ".$offset;
            return pdo_query($sql);
        }
        
        function list_parent(){
            $sql = "SELECT * FROM $this->table WHERE parent_id IS NULL";
            return pdo_query($sql);
        }

        function store($name, $desc, $parent_id, $status, $category_img) {
            try {
                $sql = "INSERT INTO $this->table (category_name, category_desc, parent_id, category_status, category_img) 
                        VALUES (?, ?, ?, ?, ?)";
                return pdo_execute($sql, $name, $desc, $parent_id, $status, $category_img);
            } catch (PDOException $e) {
                throw new Exception("Lỗi khi thêm danh mục: " . $e->getMessage());
            }
        }


        function update($id, $name, $desc, $parent_id, $status, $category_img) {
            try {
                // Debug information
                error_log("SQL Parameters: id=$id, name=$name, desc=$desc, parent_id=$parent_id, status=$status, img=$category_img");
                
                $sql = "UPDATE $this->table 
                        SET category_name = ?, 
                            category_desc = ?, 
                            parent_id = ?, 
                            category_status = ?, 
                            category_img = ? 
                        WHERE category_id = ?";
                
                $result = pdo_execute($sql, $name, $desc, $parent_id, $status, $category_img, $id);
                
                if (!$result) {
                    throw new Exception("Database update failed");
                }
                
                return true;
            } catch (PDOException $e) {
                error_log("SQL Error: " . $e->getMessage());
                throw new Exception("Database error: " . $e->getMessage());
            }
        }
        
        function count_category() {
            $query = "SELECT COUNT(category_id) AS sum FROM categories";
            $result = pdo_query($query);  // Assuming pdo_query returns a result array
            return $result[0]['sum'] ?? 0;  // Make sure to return the actual count value
        }

        function getPaginationAndOrderData()
        {
            $orderCondition = " ORDER BY category_id ASC";
            $itemPerPage = !empty($_GET['per_page']) ? $_GET['per_page'] : 14;
            $currentPage = !empty($_GET['page']) ? $_GET['page'] : 1;

            $orderField = $_GET['field'] ?? "";
            $orderSort = $_GET['sort'] ?? "";
            
            if (!empty($orderField) && !empty($orderSort)) {
                    $orderCondition = "ORDER BY c.`" . $orderField . "` " . $orderSort;
            }

            $offset = ($currentPage - 1) * $itemPerPage;
            $totalRecord = $this->count_category(); 
            $totalPages = ceil($totalRecord / $itemPerPage);

            return [
                'orderCondition' => $orderCondition,
                'itemPerPage' => $itemPerPage,
                'currentPage' => $currentPage,
                'offset' => $offset,
                'totalRecord' => $totalRecord,
                'totalPages' => $totalPages
            ];
        }
        function CategoryNotParent() {
            $sql= "SELECT category_name, category_id FROM categories WHERE parent_id IS NOT NULL";
            return pdo_query($sql);
        }
    }
?>