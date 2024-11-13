<?php
// require_once("pdo.php");

class Model
{
   var $table;
   var $contents;
   
   function list(){
       $sql = "SELECT * FROM $this->table ORDER BY $this->contents DESC";
       return pdo_query($sql);
   }
   function findBy($id){
       $sql = "SELECT * FROM $this->table WHERE $this->contents = $id";
       return pdo_query_one($sql,$id);
   }
   function delete($id){
       $sql = "DELETE FROM $this->table WHERE $this->contents = $id";
       return pdo_execute($sql,$id);
   }
   function create($data){
       $f = "";
       $v = "";
       foreach($data as $key => $value){
           $f.= $key.",";
           $v.= "'".$value."',";
       }
       $f = trim($f,",");
       $v = trim($v,",");
       $sql = "INSERT INTO $this->table($f) VALUES($v)";
       return pdo_execute($sql);
   }
   function update($data){
        $temp = $this->contents;
       $v = "";
       foreach($data as $key => $value){
           $v.= $key." = '". $value."',";
       }
       $v = trim($v,",");
       $sql = "UPDATE $this->table SET  $v   WHERE $temp = " . $data[$this->contents];
       return pdo_execute($sql, $data[$this->contents]);
   }
}
?>