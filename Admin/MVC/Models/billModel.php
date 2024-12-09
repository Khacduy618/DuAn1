<?php
require_once("model.php");

class BillModel extends Model
{
    public function __construct()
    {
        $this->table = 'Tede_Shop.bills';
        $this->contents = 'bill_id';
    }

    public function getAll(): array
    {
        $query = "SELECT bills.bill_id, 
                         bills.bill_var_id,
                         bills.bill_userEmail,  
                         bills.bill_totalPrice AS total_price, 
                         bills.bill_status, 
                         bills.bill_time
                  FROM Tede_Shop.bills AS bills
                  LEFT JOIN Tede_Shop.user AS user ON bills.bill_userEmail = user.user_email
                  WHERE bills.bill_status != 8
                  ORDER BY bills.bill_time DESC";

        return pdo_query($query);
    }

    public function details($id)
    {
        $query = "SELECT b.bill_id, b.bill_var_id, b.bill_userEmail, u.user_name, u.user_phone ,
                     b.bill_totalPrice as total_price, b.bill_price, b.bill_priceDelivery, 
                     IFNULL(c.coupon_name, 'Không có') as coupon_name, b.bill_status, 
                     b.bill_time, b.bill_address,
                     a.*,
                     GROUP_CONCAT(p.product_name SEPARATOR ', ') as products, 
                     GROUP_CONCAT(bd.pro_count SEPARATOR ', ') as quantities, 
                     GROUP_CONCAT(bd.pro_price SEPARATOR ', ') as prices 
              FROM bills b 
              LEFT JOIN user u ON b.bill_userEmail = u.user_email 
              LEFT JOIN bill_details bd ON b.bill_id = bd.id_bill 
              LEFT JOIN products p ON bd.pro_id = p.product_id 
              LEFT JOIN coupons c ON b.bill_coupon = c.coupon_id 
              LEFT JOIN address a ON b.bill_address = a.address_id
              WHERE b.bill_id = ? 
              GROUP BY b.bill_id";

        return pdo_query_one($query, $id);
    }

    public function getArchivedBills()
    {
        $query = "SELECT bills.bill_id, 
                         bills.bill_var_id,
                         bills.bill_userEmail, 
                         bills.bill_totalPrice AS total_price, 
                         bills.bill_time
                  FROM Tede_Shop.bills AS bills
                  LEFT JOIN Tede_Shop.user AS user ON bills.bill_userEmail = user.user_email
                  WHERE bills.bill_status = 8
                  ORDER BY bills.bill_time DESC";
        return pdo_query($query);
    }

    public function softDelete($id)
    {
        $query = "UPDATE $this->table SET deleted = 1 WHERE bill_id = ?";
        pdo_execute($query, $id);
    }

    public function updateStatus($id, $newStatus)
    {
        $query = "UPDATE $this->table SET bill_status = ? WHERE bill_id = ?";
        pdo_execute($query, $newStatus, $id);
    }

    public function updateStatus_ajax($id, $newStatus)
    {
        $query = "UPDATE $this->table SET bill_status = $newStatus WHERE bill_id = ?";
        pdo_execute($query, $id);
    }
}
