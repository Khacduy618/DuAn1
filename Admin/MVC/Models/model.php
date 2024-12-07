<?php
require_once("pdo.php");
class Model
{
    var $table;
    var $status;
    var $contents;

    function All()
    {
        $query = "select * from $this->table WHERE $this->status = 1 ORDER BY $this->contents DESC ";

        return pdo_query($query);
        
    }
    function edit($id)
    {
        $query = "select * from $this->table where $this->contents = ?";
        return pdo_query_one($query, $id);
    }
    
    function delete($id){
        $query = "UPDATE $this->table SET $this->status = 0 WHERE $this->contents = ?";
         pdo_execute($query, $id);
    }
    
  
}