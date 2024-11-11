<?php

class Load{
    public $load;
    public function __construct()
    {
        
    }
    public function callView($filename,$data = []){
        if(isset($data)){
            extract($data);
        }
        if(strpos($filename,'admin',0) !== false){
            require $filename.'.php';
        }else{
            require 'Views/'.$filename.'.php';
        }
        
    }
    
    public function callModel($filename){
        if (strpos($filename, 'oop') !== false) {
            $filename = str_replace('oop/', '', $filename);
            require 'Models/oop/' . $filename . '.php';
            return new $filename();
        } elseif (strpos($filename, 'dao') !== false) {
            require 'Models/dao/' . $filename . '.php';
        } else {
            throw new Exception("Invalid filename: $filename");
        }
    }
        
        
    
}