<?php
require_once("pdo.php");
class Model
{
    var $table;
    var $contents;

    function All()
    {
        $query = "select * from $this->table ORDER BY $this->contents DESC ";

        return pdo_query($query);
        
    }
    function find($id)
    {
        $query = "select * from $this->table where $this->contents =$id";
        return pdo_query_one($query, $id);
    }
    
    
  
}