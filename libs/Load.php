<?php

class Load{
    public $load;
    public function __construct()
    {
        
    }
    public function view($filename,$data = []){
        if(isset($data)){
            extract($data);
        }
        require 'Views/my_account/adminLong/'.$filename.'.php';
    }
    
    public function model($filename){
        require 'Models/' . $filename . '.php';
            return new $filename();
    }
        
        
    
}