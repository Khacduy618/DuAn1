<?php
require_once("model.php");
class Cart extends Model
{
     private $conn;

    public function __construct() {
        $this->conn = pdo_get_connection();
    }

    public function addToCart($userEmail, $productId, $quantity)
   {
    // Kiểm tra xem người dùng đã có cart chưa
    $checkCartSql = "SELECT cart_id FROM cart WHERE cart_userEmail = ?";
    $cart = pdo_query_one($checkCartSql, $userEmail);

    if (!$cart) {
        $createCartSql = "INSERT INTO cart (cart_userEmail) VALUES (?)";
        pdo_execute($createCartSql, $userEmail);

        $cart = pdo_query_one($checkCartSql, $userEmail);
    }

    $cartId = $cart['cart_id'];

    // Kiểm tra sản phẩm
    $checkProductSql = "SELECT * FROM cart_item WHERE cart_id = ? AND pro_id = ?";
    $existingItem = pdo_query_one($checkProductSql, $cartId, $productId);

    if ($existingItem) {
        // Debug
        var_dump("Updating quantity:", $quantity, $cartId, $productId);

        $updateQuantitySql = "UPDATE cart_item SET quantity = quantity + ? WHERE cart_id = ? AND pro_id = ?";
        $updated = pdo_execute($updateQuantitySql, $quantity, $cartId, $productId);

        if (!$updated) {
            throw new Exception("Cập nhật không thành công!");
        }

        return $updated;
        } else {
            $insertProductSql = "INSERT INTO cart_item (cart_id, pro_id, quantity) VALUES (?, ?, ?)";
            $inserted = pdo_execute($insertProductSql, $cartId, $productId, $quantity);

            if (!$inserted) {
                throw new Exception("Thêm sản phẩm mới thất bại!");
            }

            return $inserted;
        }
    }

    public function getCartItems($userEmail) {
        $sql = "SELECT ci.*, p.product_name, p.product_price, p.product_img, p.product_discount 
                FROM cart_item ci
                JOIN cart c ON ci.cart_id = c.cart_id
                JOIN products p ON ci.pro_id = p.product_id
                WHERE c.cart_userEmail = ?";
        return pdo_query($sql, $userEmail);
    }

    public function updateQuantity($userEmail, $productId, $quantity)
    {
        $sql = "UPDATE cart_item 
                SET quantity = ? 
                WHERE cart_id = (SELECT cart_id FROM cart WHERE cart_userEmail = ?) 
                AND pro_id = ?";
         pdo_execute($sql, $quantity, $userEmail, $productId);
    }

    public function removeFromCart($userEmail, $productId)
    {
        $sql = "DELETE FROM cart_item WHERE cart_id = (SELECT cart_id FROM cart WHERE cart_userEmail = ?) AND pro_id = ?";
         pdo_execute($sql, $userEmail, $productId);
    }

    public function clearCart($userEmail)
    {
        $sql = "DELETE FROM cart_item WHERE cart_id = (SELECT cart_id FROM cart WHERE cart_userEmail = ?)";
         pdo_execute($sql, $userEmail);
    }
}