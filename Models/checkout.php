<?php
require_once("model.php");
class Checkout extends Model
{
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

        if (!in_array($status, [1, 2, 3, 4, 5])) { // Giả sử các trạng thái hợp lệ là 1-5
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
        var_dump($values_string);

        $sql = "INSERT INTO bill_details (id_bill, bill_id, pro_id, pro_price, pro_count) 
                VALUES $values_string" ;
        
        $result = pdo_execute($sql);
        
       
        
        return true;
    }
}