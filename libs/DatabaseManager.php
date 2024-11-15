<?php

class DatabaseManager extends PDO{
    public function __construct($connect, $user, $pass){
        parent::__construct($connect, $user, $pass); 
    }

    public function select($sql, array $data = [], int $fetchStyle = PDO::FETCH_ASSOC){
        $statement = $this->prepare($sql); 
        foreach ($data as $key => $value) {
            $statement->bindParam($key, $value); 
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
}
?>