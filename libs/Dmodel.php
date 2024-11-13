<?php
class Dmodel{
    private $conn ;
    private $dbs = "mysql:host=s103d190-u2.interdata.vn;port=3306;dbname=Tede_Shop;charset=utf8";
    private $user = 'dichvun3';
    private $pass = '3VwORS+87-jl4d';
    protected function __construct(){
        try{
            $this->conn = new DatabaseManager($this->dbs,$this->user,$this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "ket noi ket bai!".$e->getMessage();
            die();
        }
        
    }
    protected function getConn(){return $this->conn;}
}
?>