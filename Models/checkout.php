<?php
require_once("model.php");
require_once("pdo.php");
class Checkout extends Model
{
    private $conn;
    public function __construct() {
        $this->conn = pdo_get_connection();
    }
    public function getBillByUserEmail($bill_userEmail) {
        if (!$bill_userEmail) {
            throw new Exception("Email không hợp lệ");
        }
        
        $sql = "SELECT b.*, 
                       CASE 
                           WHEN b.bill_status IN (1,2,3) THEN 'Pending'
                           WHEN b.bill_status = 4 THEN 'Approved'
                           WHEN b.bill_status = 5 THEN 'Delivering'
                           WHEN b.bill_status = 6 THEN 'Delivered'
                           WHEN b.bill_status = 7 THEN 'Completed'
                           WHEN b.bill_status = 8 THEN 'Cancelled'
                       END as status_name
                FROM bills b 
                WHERE b.bill_userEmail = ?
                ORDER BY b.bill_time DESC";
        $result = pdo_query($sql, $bill_userEmail);
        
        if (empty($result)) {
            return []; // Trả về mảng rỗng thay vì ném exception
        }
        
        return $result;
    }
    public function getBillDetailsByIdBill($id_bill) {
        if (!$id_bill) {
            throw new Exception("ID hóa đơn không hợp lệ");
        }

        $sql = "SELECT bd.*, p.product_name, p.product_image, 
                       (bd.pro_price * bd.pro_count) as total_price
                FROM bill_details bd 
                LEFT JOIN products p ON bd.pro_id = p.product_id 
                WHERE bd.id_bill = ?";
        $result = pdo_query($sql, $id_bill);
        
        if (empty($result)) {
            return []; // Trả về mảng rỗng thay vì ném exception
        }
        
        return $result;
    }

    public function updateBillStatus($bill_userEmail, $status) {
        if (!$bill_userEmail) {
            throw new Exception("Email không hợp lệ");
        }

        if (!in_array($status, [1, 2, 3, 4, 5, 6, 7, 8])) { // Giả sử các trạng thái hợp lệ là 1-5
            throw new Exception("Trạng thái đơn hàng không hợp lệ");
        }

        $sql = "UPDATE bills SET bill_status = ? WHERE bill_userEmail = ?";
            $result = pdo_execute($sql, $status, $bill_userEmail);
        
        if (!$result) {
            throw new Exception("Không thể cập nhật trạng thái đơn hàng");
        }
        
        return true;
    }

    public function bill_insert_id($bill_var_id, $bill_userEmail, $bill_phone, $bill_address, 
                                 $bill_priceDelivery, $bill_price, $bill_totalPrice, 
                                 $bill_coupon, $bill_payment, $bill_status) 
    {
        // Kiểm tra dữ liệu đầu vào
        $sql = "INSERT INTO bills (bill_var_id, bill_userEmail, bill_phone, bill_address, 
                                 bill_priceDelivery, bill_price, bill_totalPrice, 
                                 bill_coupon, bill_payment, bill_status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                
        $result = pdo_execute_id($sql, 
            $bill_var_id, 
            $bill_userEmail, 
            $bill_phone, 
            $bill_address,
            $bill_priceDelivery, 
            $bill_price, 
            $bill_totalPrice,
            $bill_coupon, 
            $bill_payment, 
            $bill_status
        );

        if (!$result) {
            throw new Exception("Không thể tạo hóa đơn mới");
        }

        return $result;
    }

    public function insert_bill_detail($values_string) {
        if (empty($values_string)) {
            throw new Exception("Không có dữ liệu chi tiết đơn hàng");
        }

        try {
            // Bắt đầu transaction
            $this->conn->beginTransaction();

            // 1. Thêm chi tiết đơn hàng
            $sql = "INSERT INTO bill_details (id_bill, bill_id, pro_id, pro_price, pro_count) 
                    VALUES $values_string";
            pdo_execute($sql);

            // 2. Lấy thông tin pro_id và quantity từ values_string
            // Sửa lại regex để lấy chính xác pro_id và quantity
            preg_match_all('/\((\d+),\s*\'[^\']+\',\s*(\d+),\s*\d+,\s*(\d+)\)/', $values_string, $matches);
            
            // Debug để kiểm tra giá trị
            error_log("Values string: " . $values_string);
            error_log("Matches: " . print_r($matches, true));

            if (isset($matches[2]) && isset($matches[3])) {
                $pro_ids = $matches[2];    // Index 2 chứa pro_id
                $quantities = $matches[3];  // Index 3 chứa quantity

                // Debug thông tin sản phẩm và số lượng
                error_log("Pro IDs: " . print_r($pro_ids, true));
                error_log("Quantities: " . print_r($quantities, true));

                // 3. Cập nhật số lượng sản phẩm
                foreach ($pro_ids as $index => $pro_id) {
                    $quantity = $quantities[$index];
                    
                    // Kiểm tra số lượng hiện tại
                    $check_sql = "SELECT product_count FROM products WHERE product_id = ?";
                    $current_count = pdo_query_one($check_sql, $pro_id);
                    
                    error_log("Updating product ID: $pro_id, Quantity: $quantity, Current count: " . print_r($current_count, true));

                    if ($current_count && $current_count['product_count'] >= $quantity) {
                        $update_sql = "UPDATE products 
                                     SET product_count = product_count - ? 
                                     WHERE product_id = ?";
                        $update_result = pdo_execute($update_sql, $quantity, $pro_id);
                        
                        error_log("Update result for product $pro_id: " . ($update_result ? "success" : "failed"));
                    } else {
                        throw new Exception("Sản phẩm ID $pro_id không đủ số lượng trong kho");
                    }
                }
            } else {
                throw new Exception("Không thể phân tích dữ liệu sản phẩm");
            }

            // Commit transaction nếu mọi thứ OK
            $this->conn->commit();
            return true;

        } catch (Exception $e) {
            // Rollback nếu có lỗi
            $this->conn->rollBack();
            error_log("Error in insert_bill_detail: " . $e->getMessage());
            throw new Exception("Lỗi khi xử lý đơn hàng: " . $e->getMessage());
        }
    }

    // Thêm hàm kiểm tra số lượng sản phẩm trước khi đặt hàng
    public function checkProductQuantity($pro_id, $quantity) {
        $sql = "SELECT product_count FROM products WHERE product_id = ?";
        $result = pdo_query_one($sql, $pro_id);
        
        if (!$result) {
            throw new Exception("Không tìm thấy sản phẩm");
        }
        
        return $result['product_count'] >= $quantity;
    }
}