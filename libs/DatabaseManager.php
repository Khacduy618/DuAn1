<?php

class DatabaseManager extends PDO{
    public function __construct($connect, $user, $pass){
        parent::__construct($connect, $user, $pass); 
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Đảm bảo báo lỗi chính xác
    }

    public function select($sql, array $data = [], int $fetchStyle = PDO::FETCH_ASSOC){
        $statement = $this->prepare($sql); 
        foreach ($data as $key => $value) {
            $statement->bindParam($key, $value); 
        }
        $statement->execute(); 
        return $statement->fetchAll($fetchStyle);
    }
    public function select_settype($sql, array $data = [], int $fetchStyle = PDO::FETCH_ASSOC, $type = PDO::PARAM_INT){
        $statement = $this->prepare($sql); 
        foreach ($data as $key => $value) {
            $statement->bindParam($key, $value, $type); 
        }
        $statement->execute(); 
        return $statement->fetchAll($fetchStyle);
    }

    public function insert(string $table, array $data): bool {
        $keys = implode(",", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));

        $sql = "INSERT INTO $table ($keys) VALUES ($values)";
        $statement = $this->prepare($sql);

        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

        return $statement->execute();
    }

    public function update(string $table, array $data, string $cond): bool {
        $updateKeys = '';
        foreach ($data as $key => $value) {
            $updateKeys .= "$key = :$key,";
        }
        $updateKeys = rtrim($updateKeys, ',');

        $sql = "UPDATE $table SET $updateKeys WHERE $cond";
        $statement = $this->prepare($sql);

        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value); 
        }

        // Adding transaction management (commit and rollback)
        try {
            $this->beginTransaction();
            $result = $statement->execute();
            $this->commit();
            return $result;
        } catch (PDOException $e) {
            $this->rollBack();
            error_log("Transaction failed: " . $e->getMessage());
            return false;
        }
    }

    public function delete(string $table, string $cond, int $limit = 1): int {
        $sql = "DELETE FROM $table WHERE $cond LIMIT $limit";
        return $this->exec($sql);
    }

    public function affectedRows(string $sql, string $username, string $password): int {
        $statement = $this->prepare($sql);
        $statement->execute([$username, $password]);
        return $statement->rowCount();
    }

    public function selectUser(string $sql, string $username, string $password): array {
        $statement = $this->prepare($sql);
        $statement->execute([$username, $password]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Select an object from the database
     * @param string $sql SQL query
     * @param array $data Array of parameters
     * @param string $className Name of the class to instantiate
     * @return object|null Returns an object of $className or null
     */
    public function pdo_select_object(string $sql, array $data = [], string $className = 'stdClass') {
        try {
            $stmt = $this->prepare($sql);
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            if (!$stmt->execute()) {
                throw new Exception('Query execution failed.');
            }
            return $stmt->fetchObject($className);
        } catch (Exception $e) {
            error_log('Error in pdo_select_object: ' . $e->getMessage());
            return null; 
        }
    }

    //Bán Tự động
    public function pdo_insert($table, $data) {
        $keys = implode(',', array_keys($data));
        $placeholders = rtrim(str_repeat('?,', count($data)), ',');
        $sql = "INSERT INTO $table ($keys) VALUES ($placeholders)";
        
        $stmt = $this->prepare($sql);
        return $stmt->execute(array_values($data)); 
    }

    public function pdo_update($table, $cond, $data) {
        try {
            $this->beginTransaction(); 
            
            $setPart = implode(' = ?, ', array_keys($data)) . ' = ?';
            $sql = "UPDATE $table SET $setPart WHERE $cond";
            
            $stmt = $this->prepare($sql);
            $stmt->execute(array_values($data));
            
            $this->commit(); 
        } catch (PDOException $e) {
            $this->rollBack(); 
            error_log($e->getMessage());
            throw new Exception("Lỗi: không thể thực thi câu lệnh update.", 0, $e);
        }
    }

    public function pdo_delete($table, $cond) {
        if (is_array($cond)) {
            $conditions = array_map(fn($key) => "$key = ?", array_keys($cond));
            $whereClause = implode(' AND ', $conditions);
            $values = array_values($cond);
        } else {
            $whereClause = $cond;
            $values = [];
        }
        $sql = "DELETE FROM $table WHERE $whereClause";
        
        $stmt = $this->prepare($sql);
        return $stmt->execute($values);
    }

    public function pdo_select($sql, $data = [], $fetchStyle = PDO::FETCH_ASSOC) {
        $stmt = $this->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();
        return $stmt->fetchAll($fetchStyle);
    }

    public function pdo_select_one($sql, $data = [], $fetchStyle = PDO::FETCH_ASSOC) {
        $stmt = $this->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();
        return $stmt->fetch($fetchStyle);
    }

    public function pdo_select_columns($sql, $data = []) {
        $stmt = $this->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function pdo_query($sql) {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            $stmt = $this->prepare($sql);
            $stmt->execute($sql_args);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new PDOException("Có lỗi xảy ra khi thực thi câu lệnh SQL fetchAll");
        }
    }

    public function pdo_query_object($sql, $className = 'stdClass') {
        $sql_args = array_slice(func_get_args(), 2);
        try {
            $stmt = $this->prepare($sql);
            $stmt->execute($sql_args);
            return $stmt->fetchObject($className);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new PDOException("Có lỗi xảy ra khi thực thi câu lệnh SQL fetchObject");
        }
    }

    public function pdo_select_all(string $table, string $cond_orderby, $fetchStyle = PDO::FETCH_ASSOC) {
        $stmt = $this->prepare("SELECT * FROM {$table} ORDER BY {$cond_orderby}");
        $stmt->execute();
        return $stmt->fetchAll($fetchStyle);
    }
    

    public function pdo_select_all_object(string $table, string $cond_orderby, string $className = 'stdClass') {
        $stmt = $this->prepare("SELECT * FROM {$table} ORDER BY {$cond_orderby}");
        $stmt->execute();
        return $stmt->fetchObject($className);
    }

    public function pdo_insert_du_lieu_mau(string $table, string $attribude, $data) {
        $row = implode(',', array_map(fn($m) => "('$m')", array_values($data)));
        $sql = "INSERT INTO {$table}($attribude) VALUES $row";
        $stmt = $this->prepare($sql);
        return $stmt->execute();
    }
}
?>