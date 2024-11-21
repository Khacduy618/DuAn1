<?php
require_once("pdo.php");

class Model
{
   var $table;
   var $contents;

   function limit( $offset, $limit)
    {
        $sql = "SELECT * FROM $this->table ORDER BY $this->contents DESC LIMIT $offset, $limit";
        return pdo_query($sql); 
    }

   function list(){
       $sql = "SELECT * FROM $this->table ORDER BY $this->contents DESC";
       return pdo_query($sql);
   }
   function findBy($id){
       $sql = "SELECT * FROM $this->table WHERE $this->contents = ?";
       return pdo_query_one($sql,$id);
   }
   
   

}
?>