<?php
require_once("pdo.php");
class Privilege_act{
     public  function getPrivilegeAct($emailUser){
           $sql = "SELECT privilege.name , privilege.privilege_act FROM user_privilege INNER JOIN privilege on user_privilege.privilege_id = privilege.id WHERE user_privilege.user_email = ?";
           return pdo_query($sql , $emailUser);
     }
    }
?>