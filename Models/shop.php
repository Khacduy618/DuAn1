<?php
require_once("model.php");

class Shop extends Model
{
    var $table = "products";
    var $contents = "product_id";

   function loadall_product($keyword="", $orderCondition="", $product_cat=0, $item_per_page="", $offset=""){
        $sql = "SELECT p.*, COALESCE(SUM(bd.pro_count), 0) as total_sold 
                FROM products p 
                JOIN bill_details bd ON p.product_id = bd.pro_id
                JOIN categories c ON c.category_id = p.product_cat
                WHERE 1";
        
        if($product_cat > 0){
            $sql .= " AND product_cat=".$product_cat;
        }

        if($keyword != ""){
            $sql .= " AND product_name LIKE '%".$keyword."%'";
        }
        
        $sql .= " GROUP BY p.product_id ";
        $sql .= $orderCondition;
        $sql .= " LIMIT ".$item_per_page." OFFSET ".$offset;

        return pdo_query($sql);
    }
    function keyword($a) {
        $a = "'%".$a."%'";
        $query = "SELECT * FROM products WHERE product_name LIKE $a LIMIT 0,12";
        return pdo_query($query, $a);
    }

    function product_price($a, $b) {
        if($a == 0) {
            $a = "30000";
        } else {
            $a = $a."000000";
        }
        $b = $b."000000";
        $query = "SELECT * FROM products WHERE product_price > $a AND product_price < $b LIMIT 0, 12";
        return pdo_query($query, $a, $b);
    }

    function products_topSell() {
        $query = "SELECT p.*, SUM(bd.pro_count) AS total_sold FROM products p JOIN bill_details bd ON p.product_id = bd.pro_id GROUP BY p.product_id ORDER BY total_sold DESC";
        return pdo_query($query);
    }

    function count_sp() {
        $query = "SELECT COUNT(product_id) AS sum FROM products";
        $result = pdo_query($query);  // Assuming pdo_query returns a result array
        return $result[0]['sum'] ?? 0;  // Make sure to return the actual count value
    }

    function getPaginationAndOrderData(): array
    {
        $orderCondition = "ORDER BY p.product_id DESC";
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
?>