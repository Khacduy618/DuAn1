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
        if(isset($_GET['mod'])){
            require_once dirname(__DIR__).'/Admin/MVC/Views/'.$filename.'.php';
        }
        else{
            require_once 'Views/my_account/adminLong/'.$filename.'.php';
        }
    }
    
    public function model($filename){
        if(isset($_GET['mod'])){
            require dirname(__DIR__).'/Admin/MVC/Models/'.$filename.'.php';
            return new $filename();
        }
        else{
            require 'Models/' . $filename . '.php';
            return new $filename();
        }
        
    }
        
        
    
}