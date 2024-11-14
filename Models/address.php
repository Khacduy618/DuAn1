<?php
require_once("model.php");

class Address extends Model {
    private $conn;

    public function __construct() {
        $this->conn = pdo_get_connection();
    }

    function getOneAddress($userEmail) {
        $sql = "SELECT * FROM address WHERE address_userEmail = ?";
        return pdo_query_one($sql, $userEmail);
    }

    // Lấy danh sách tất cả các địa chỉ của một người dùng
    public function getAllAddresses($userEmail) {
        $sql = "SELECT * FROM address WHERE address_userEmail = ?";
        return pdo_query($sql, $userEmail);
    }

    // Thêm địa chỉ mới
    public function addAddress($userEmail, $name, $city, $street) {
        $sql = "INSERT INTO address (address_userEmail, address_name, address_city, address_street) VALUES (?, ?, ?, ?)";
        return pdo_execute($sql, $userEmail, $name, $city, $street);
    }

    // Sửa địa chỉ
    public function updateAddress($addressId, $name, $city, $street) {
        $sql = "UPDATE address SET address_name = ?, address_city = ?, address_street = ? WHERE address_id = ?";
        return pdo_execute($sql, $name, $city, $street, $addressId);
    }

    // Xóa địa chỉ
    public function deleteAddress($addressId) {
        $sql = "DELETE FROM address WHERE address_id = ?";
        return pdo_execute($sql, $addressId);
    }
}
?>