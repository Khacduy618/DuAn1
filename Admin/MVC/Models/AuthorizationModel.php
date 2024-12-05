<?php
class Authorization_model{
    public function getEmployees(){
         $sql = "SELECT user.* FROM user WHERE user_status = 1 AND user_role != 0";
         return pdo_query($sql);
         }
    public function getPrivilegeGroup(){
         $sql = "SELECT * FROM privilege_group ORDER BY position ASC";
         return pdo_query($sql);
         }
    public function getPrivilege(){
         $sql = "SELECT * FROM privilege ORDER BY position ASC";
         return pdo_query($sql);
         }
    public function savePrivilege($sql){ 
         return pdo_query($sql);
    }
    public function getPrivilegeChecked($user_email){
         $sql = "SELECT * FROM user_privilege WHERE user_email = ? ";
         return pdo_query($sql , $user_email);
    }
    public function deleteUserPrivilege($user_email){
         $sql = "DELETE  FROM user_privilege WHERE user_email = ? ";
         return pdo_query($sql , $user_email);
    }    
} 



?>