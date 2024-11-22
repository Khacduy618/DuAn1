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
    function delete($id)
    {
        $query = "DELETE from $this->table where $this->contents=$id";
        
        pdo_execute($query);
        
        header('Location: ?mod=' . $this->table);
    }
    function store($data)
    {
        $f = "";
        $v = "";
        foreach ($data as $key => $value) {
            $f .= $key . ",";
            $v .= "'" . $value . "',";
        }
        $f = trim($f, ",");
        $v = trim($v, ",");
        $query = "INSERT INTO $this->table($f) VALUES ($v);";

        pdo_execute($query);

    }
  
}