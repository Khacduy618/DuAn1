<?php 
   function pdo_get_connection()
   {
       $dburl = "mysql:host=s103d190-u2.interdata.vn;port=3306;dbname=Tede_Shop;charset=utf8";
       $username = 'dichvun3';
       $password = '3VwORS+87-jl4d'; 
       try {
           $conn = new PDO($dburl, $username, $password);
           $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           return $conn;
       } catch (PDOException $e) {
           echo 'Connection failed: ' . $e->getMessage();
           
        error_log('Database connection failed: ' . $e->getMessage());
        return null;
         
       }
   }  
   function pdo_query($sql, ...$args)
   {
       try {
           $conn = pdo_get_connection();
           $stmt = $conn->prepare($sql);
           $stmt->execute($args);
           return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: []; // Trả về mảng rỗng nếu không có kết quả
       } catch (PDOException $e) {
           error_log($e->getMessage()); // Ghi lại lỗi
           return []; // Trả về mảng rỗng trong trường hợp lỗi
       } finally {
           
    if ($conn !== null) {
        $conn = null; // Explicitly close the connection.
    }
    
       }
   }
   
   function pdo_query_one($sql, ...$args)
   {
       try {
           $conn = pdo_get_connection();
           $stmt = $conn->prepare($sql);
           $stmt->execute($args);
           return $stmt->fetch(PDO::FETCH_ASSOC) ?: null; // Trả về null nếu không có kết quả
       } catch (PDOException $e) {
           error_log($e->getMessage()); // Ghi lại lỗi
           
        error_log('Database connection failed: ' . $e->getMessage());
        return null;
         // Trả về null trong trường hợp lỗi
       } finally {
           
    if ($conn !== null) {
        $conn = null; // Explicitly close the connection.
    }
    
       }
   }
   
   function pdo_execute($sql, ...$args)
   {
       try {
           $conn = pdo_get_connection();
           $stmt = $conn->prepare($sql);
           $stmt->execute($args);
           return $stmt->rowCount(); // Trả về số hàng đã thay đổi
       } catch (PDOException $e) {
           error_log($e->getMessage()); // Ghi lại lỗi
           return 0; // Trả về 0 trong trường hợp lỗi
       } finally {
           
    if ($conn !== null) {
        $conn = null; // Explicitly close the connection.
    }
    
       }
   }