<?php
require("model.php");
class Product extends Model
{
    var $table = "products";
    var $status = "product_status";
    var $contents = "product_id";

    public function __construct(){
        $this->table;
        $this->status;
        $this->contents;
    }

    function list($keyword="", $orderCondition="", $product_cat=0, $status= "", $item_per_page="", $offset=""){
        $sql = "SELECT p.product_id, p.product_name, p.product_price, p.product_discount, p.product_count, p.product_cat, p.product_status, p.product_img, p.created_at, COALESCE(SUM(bd.pro_count), 0) as total_sold, c.category_name, c.category_id
                FROM products p 
                LEFT JOIN bill_details bd ON p.product_id = bd.pro_id
                LEFT JOIN categories c ON c.category_id = p.product_cat
                WHERE 1";
        
        if($product_cat > 0){
            $sql .= " AND product_cat=".$product_cat;
        }

        if($status !=""){
            $sql .= " AND product_status = ".$status;
        }

        if($keyword != ""){
            $sql .= " AND product_name LIKE '%".$keyword."%'";
        }
        
        $sql .= " GROUP BY p.product_id ";
        $sql .= $orderCondition;
        $sql .= " LIMIT ".$item_per_page." OFFSET ".$offset;

        return pdo_query($sql);
    }

    function getDetailById($id) {
        $sql = "SELECT p.screen_cam, p.os, p.gpu, p.cpu, p.pin, p.colors, p.sizes, p.ram, p.rom, p.bluetooth FROM products p WHERE product_id = ?";
        return pdo_query_one($sql, $id);
    }

    function store($name, $price, $discount, $count, $cat, $status, $product_img, $screen_cam, $os, $gpu, $cpu, $pin, $colors, $sizes, $ram, $rom, $bluetooth) {
        $sql = "INSERT INTO products (product_name, product_price, product_discount, product_count, product_cat, product_status, product_img, screen_cam, os, gpu, cpu, pin, colors, sizes, ram, rom, bluetooth) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
        return pdo_execute($sql, $name, $price, $discount, $count, $cat, $status, $product_img, $screen_cam, $os, $gpu, $cpu, $pin, $colors, $sizes, $ram, $rom, $bluetooth);
    }

    function update($id, $name, $price, $discount, $count, $cat, $status, $product_img, $screen_cam, $os, $gpu, $cpu, $pin, $colors, $sizes, $ram, $rom, $bluetooth) {
        $sql = "UPDATE products 
                SET product_name=?, 
                    product_price=?, 
                    product_discount=?, 
                    product_count=?, 
                    product_cat=?, 
                    product_status=?, 
                    product_img=?, 
                    screen_cam=?, 
                    os=?, 
                    gpu=?, 
                    cpu=?, 
                    pin=?, 
                    colors=?, 
                    sizes=?, 
                    ram=?, 
                    rom=?, 
                    bluetooth=? 
                WHERE product_id=?";
        return pdo_execute($sql, $name, $price, $discount, $count, $cat, $status, $product_img, $screen_cam, $os, $gpu, $cpu, $pin, $colors, $sizes, $ram, $rom, $bluetooth, $id);
    }


    
    function count_sp() {
        $query = "SELECT COUNT(product_id) AS sum FROM products";
        $result = pdo_query($query);  // Assuming pdo_query returns a result array
        return $result[0]['sum'] ?? 0;  // Make sure to return the actual count value
    }

    function getPaginationAndOrderData()
    {
        $orderCondition = "ORDER BY p.created_at DESC";
        $itemPerPage = !empty($_GET['per_page']) ? $_GET['per_page'] : 12;
        $currentPage = !empty($_GET['page']) ? $_GET['page'] : 1;

        $orderField = $_GET['field'] ?? "";
        $orderSort = $_GET['sort'] ?? "";
        
        if (!empty($orderField) && !empty($orderSort)) {
            if ($orderField === 'total_sold') {
                $orderCondition = "ORDER BY total_sold " . $orderSort;
            } else {
                $orderCondition = "ORDER BY p.`" . $orderField . "` " . $orderSort;
            }
        }

        $offset = ($currentPage - 1) * $itemPerPage;
        $totalRecord = $this->count_sp(); 
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

}