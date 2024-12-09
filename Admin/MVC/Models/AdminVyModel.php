<?php
require_once 'model.php';

class AdminVyModel
{
public function getAllUserWithAddress($offset, $limit, $searchQuery = '', $statusFilter = null)
{
    $params = [];
    $whereClause = [];
    
    if (!empty($searchQuery)) {
        $whereClause[] = "user_name LIKE ?";
        $params[] = "%$searchQuery%";
    }
    
    if ($statusFilter !== null) {
        $whereClause[] = "user_status = ?";
        $params[] = $statusFilter;
    }
    
    $where = !empty($whereClause) ? "WHERE " . implode(" AND ", $whereClause) : "";
    
    $query = "SELECT * FROM user $where LIMIT $offset, $limit";
    return pdo_query($query, ...$params);
}

public function getTotalUser($searchQuery = '', $statusFilter = null)
{
    $params = [];
    $whereClause = [];
    
    if (!empty($searchQuery)) {
        $whereClause[] = "user_name LIKE ?";
        $params[] = "%$searchQuery%";
    }
    
    if ($statusFilter !== null) {
        $whereClause[] = "user_status = ?";
        $params[] = $statusFilter;
    }
    
    $where = !empty($whereClause) ? "WHERE " . implode(" AND ", $whereClause) : "";
    
    $query = "SELECT COUNT(*) as total FROM user $where";
    return pdo_query_one($query, ...$params)['total'];
}

    public function getAllAddress()
    {
        $sql = "SELECT * FROM address";
        return pdo_query($sql);
    }
    public function getUserByEmail($user_email)
    {
        $sql = "SELECT * FROM user WHERE user_email = ?";
        return pdo_query_one($sql, $user_email);
    }

    public function addUser($user_name, $user_full_name, $user_email, $user_password, $user_phone, $user_images)
    {
        $user_images_path = !empty($user_images) ? "../uploaded/$user_images" : null;

        $sql = "INSERT INTO user (user_name, user_full_name, user_email, user_password, user_phone, user_images, user_role, user_status) 
                VALUES (?, ?, ?, ?, ?, ?, 0, 1)";
        pdo_execute($sql, $user_name, $user_full_name, $user_email, $user_password, $user_phone, $user_images_path);
    }

    public function updateUser($user_name, $user_email, $user_phone, $user_images, $user_role, $user_status)
    {
        $sql = "UPDATE user 
                SET user_name = ?, user_phone = ?, user_images = ?, user_role = ?, user_status = ? 
                WHERE user_email = ?";
        pdo_execute($sql, $user_name, $user_phone, $user_images, $user_role, $user_status, $user_email);
    }

    public function deleteUser($user_email)
    {
        $sql = "UPDATE user SET user_status = 0 WHERE user_email = ?";
        pdo_execute($sql, $user_email);
    }

public function getAddressByEmail($user_email)
{
    $sql = "SELECT * FROM address WHERE address_userEmail = ?";
    return pdo_query($sql, $user_email);
}


        public function deleteAddress($address_id)
    {
        $sql = "UPDATE address SET address_status = 1 WHERE address_id = ?";
        pdo_execute($sql, $address_id);
    }

public function addAddress($user_email, $address_name, $address_city, $address_street)
{
    $sql = "UPDATE address SET address_status = 1 WHERE address_userEmail = ?";
    pdo_execute($sql, $user_email);

    $sql = "INSERT INTO address (address_userEmail, address_name, address_city, address_street, address_status) 
            VALUES (?, ?, ?, ?, 0)";
    pdo_execute($sql, $user_email, $address_name, $address_city, $address_street);
}

public function updateAddress($address_id, $user_email, $address_name, $address_city, $address_street)
{
    if ($address_id) {
        $sql = "UPDATE address SET address_name = ?, address_city = ?, address_street = ? WHERE address_id = ?";
        pdo_execute($sql, $address_name, $address_city, $address_street, $address_id);
    } else {
        $sql = "INSERT INTO address (address_userEmail, address_name, address_city, address_street, address_status) 
                VALUES (?, ?, ?, ?, 0)";
        pdo_execute($sql, $user_email, $address_name, $address_city, $address_street);
    }
}
    
    

    public function deleteAddressByEmail($user_email)
    {
        $sql = "UPDATE address SET address_status = 1 WHERE address_userEmail = ?";
        pdo_execute($sql, $user_email);
    }

    public function handleImageUpload($user_images, $user_images_tmp)
    {
        $uploads_dir = '../uploaded';
        if (!file_exists($uploads_dir)) {
            mkdir($uploads_dir, 0777, true);
        }

        $user_images_path = "$uploads_dir/$user_images";
        if (move_uploaded_file($user_images_tmp, $user_images_path)) {
            return $user_images;
        } else {
            return '';
        }
    }

public function updateAddressStatus($address_id, $address_status)
{
    $sql = "SELECT address_userEmail FROM address WHERE address_id = ?";
    $user_email = pdo_query_one($sql, $address_id)['address_userEmail'];

    $sql = "UPDATE address SET address_status = 1 WHERE address_userEmail = ?";
    pdo_execute($sql, $user_email);

    if ($address_status == 0) { 
        $sql = "UPDATE address SET address_status = 0 WHERE address_id = ?";
        return pdo_execute($sql, $address_id);
    }

    return false;
}

public function getAllFavorites($offset, $limit, $searchQuery = '')
{
    $params = [];
    $whereClause = [];
    
    if (!empty($searchQuery)) {
        $whereClause[] = "(u.user_name LIKE ? OR p.product_name LIKE ?)";
        $params[] = "%$searchQuery%";
        $params[] = "%$searchQuery%";
    }
    
    $where = !empty($whereClause) ? "WHERE " . implode(" AND ", $whereClause) : "";
    
    $sql = "SELECT f.favorite_id, f.favorite_userEmail, f.favorite_proid,
                   u.user_name, p.product_name, 
                   CONCAT('../uploaded/', p.product_img) as product_img
            FROM favorites f
            LEFT JOIN user u ON f.favorite_userEmail = u.user_email
            LEFT JOIN products p ON f.favorite_proid = p.product_id
            $where
            ORDER BY f.favorite_id DESC 
            LIMIT $offset, $limit";
    return pdo_query($sql, ...$params);
}

public function getTotalFavorites($searchQuery = '')
{
    $params = [];
    $whereClause = [];
    
    if (!empty($searchQuery)) {
        $whereClause[] = "(u.user_name LIKE ? OR p.product_name LIKE ?)";
        $params[] = "%$searchQuery%";
        $params[] = "%$searchQuery%";
    }
    
    $where = !empty($whereClause) ? "WHERE " . implode(" AND ", $whereClause) : "";
    
    $sql = "SELECT COUNT(*) as total 
            FROM favorites f
            LEFT JOIN user u ON f.favorite_userEmail = u.user_email
            LEFT JOIN products p ON f.favorite_proid = p.product_id
            $where";
    return pdo_query_one($sql, ...$params)['total'];
}

public function getFavoritesByEmail($user_email)
{
    $sql = "SELECT f.favorite_id, f.favorite_userEmail, f.favorite_proid,
                   u.user_name, p.product_name, p.product_img 
            FROM favorites f
            LEFT JOIN user u ON f.favorite_userEmail = u.user_email
            LEFT JOIN products p ON f.favorite_proid = p.product_id
            WHERE f.favorite_userEmail = ?
            ORDER BY f.favorite_id DESC";
    return pdo_query($sql, $user_email);
}

public function deleteFavorite($favorite_id)
{
    $sql = "DELETE FROM favorites WHERE favorite_id = ?";
    return pdo_execute($sql, $favorite_id);
}

}