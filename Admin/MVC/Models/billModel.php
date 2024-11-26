<?php
require_once("model.php");

class BillModel extends Model
{
    public function __construct()
    {
        $this->table = 'Tede_Shop.bills';
        $this->contents = 'bill_id';
    }

    // Retrieve all bills
    public function getAll(): array
    {
        $query = "SELECT bills.bill_id, 
                         bills.bill_userEmail, 
                         user.user_full_name, 
                         bills.bill_price AS bill_product_price, 
                         bills.bill_priceDelivery AS delivery_price, 
                         bills.bill_totalPrice AS total_price, 
                         coupons.coupon_name, 
                         bills.bill_status, 
                         bills.bill_time
                  FROM $this->table
                  LEFT JOIN Tede_Shop.user ON bills.bill_userEmail = user.user_email
                  LEFT JOIN Tede_Shop.coupons ON bills.bill_coupon = coupons.coupon_id
                  /*WHERE bills.bill_id = ? AND bills.deleted = 0 */
                  WHERE bills.bill_status != 8
                  ORDER BY bills.bill_time DESC";

        return pdo_query($query);
    }

    // Retrieve details of a single bill
    public function details($id)
    {
        $query = "SELECT bills.bill_id, 
                     bills.bill_userEmail, 
                     user.user_full_name, 
                     bills.bill_price AS bill_product_price, 
                     bills.bill_priceDelivery AS delivery_price, 
                     bills.bill_totalPrice AS total_price, 
                     IFNULL(coupons.coupon_name, 'No Coupon') AS coupon_name,
                     bills.bill_status, 
                     bills.bill_time,
                     IFNULL(address.address_name, 'No Address Provided') AS address,
                     GROUP_CONCAT(DISTINCT products.product_name SEPARATOR ', ') AS products,
                     GROUP_CONCAT(DISTINCT bill_details.pro_count SEPARATOR ', ') AS quantities
              FROM $this->table AS bills
              LEFT JOIN Tede_Shop.user AS user ON bills.bill_userEmail = user.user_email
              LEFT JOIN Tede_Shop.bill_details AS bill_details ON bills.bill_id = bill_details.id_bill
              LEFT JOIN Tede_Shop.products AS products ON bill_details.pro_id = products.product_id
              LEFT JOIN Tede_Shop.coupons AS coupons ON bills.bill_coupon = coupons.coupon_id
              LEFT JOIN Tede_Shop.address AS address ON bills.bill_address = address.address_id
              WHERE bills.bill_id = ?
              GROUP BY bills.bill_id, user.user_full_name, coupons.coupon_name, address.address_name";

        return pdo_query_one($query, $id);
    }
    public function getArchivedBills()
    {
        $query = "SELECT bills.bill_id, 
                     bills.bill_userEmail, 
                     user.user_full_name, 
                     bills.bill_price AS bill_product_price, 
                     bills.bill_priceDelivery AS delivery_price, 
                     bills.bill_totalPrice AS total_price, 
                     bills.bill_status, 
                     bills.bill_time 
              FROM bills
              LEFT JOIN user ON bills.bill_userEmail = user.user_email
              WHERE bills.bill_status = 8
              ORDER BY bill_time DESC";
        return pdo_query($query);
    }
    public function softDelete($id)
    {
        $query = "UPDATE $this->table SET deleted = 1 WHERE bill_id = ?";
        pdo_execute($query, $id);
    }
    // Update the status of a bill
    public function updateStatus($id, $newStatus)
    {
        $query = "UPDATE $this->table SET bill_status = ? WHERE bill_id = ?";
        pdo_execute($query, $newStatus, $id);
    }
    public function updateStatus_ajax($id, $newStatus)
    {
        $sql = "UPDATE bills SET bill_status = :bill_status WHERE bill_id = :bill_id ";
        // pdo_execute($query, $newStatus, $id);
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":bill_status", $newStatus); 
        $stmt->bindValue(":bill_id", $id); 
        try {
            $conn->beginTransaction();
            $result = $stmt->execute();
            $conn->commit();
            return $result;
        } catch (PDOException $e) {
            $conn->rollBack();
            error_log("Transaction failed: " . $e->getMessage());
            return false;
        }
        finally {
            unset($conn);
        }
        
    }
    public function select_id_status_ajax($id){
        $sql = "SELECT (bill_id,bill_status) WHERE 
        bill_id = ?";
        return pdo_query_one($sql, $id);
    }
    public function getAll_by_id($id): array
    {
        $query = "SELECT bills.bill_id, 
                         bills.bill_userEmail, 
                         user.user_full_name, 
                         bills.bill_price AS bill_product_price, 
                         bills.bill_priceDelivery AS delivery_price, 
                         bills.bill_totalPrice AS total_price, 
                         coupons.coupon_name, 
                         bills.bill_status, 
                         bills.bill_time
                  FROM $this->table
                  LEFT JOIN Tede_Shop.user ON bills.bill_userEmail = user.user_email
                  LEFT JOIN Tede_Shop.coupons ON bills.bill_coupon = coupons.coupon_id
                  WHERE bills.bill_id = ? AND bills.bill_status != 8 
        ";
        return pdo_query_one($query,$id);
    }

}
?>