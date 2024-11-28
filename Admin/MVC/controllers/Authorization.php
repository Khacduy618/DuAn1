<?php
require_once __DIR__ . "/../Models/AuthorizationModel.php";
class Authorization_members{
    private $authorizagtion_model ;
    public function __construct(){
        $this->authorizagtion_model = new Authorization_model();
     }
     public function authorization_index(){ 
        $Employees = $this->authorizagtion_model->getEmployees();
        require_once __DIR__ . "/../Views/admin/index.php";
     }
     public function  authorize(){
        $getPrivilege = $this->authorizagtion_model->getPrivilege();
        $getPrivilegeGroup = $this->authorizagtion_model->getPrivilegeGroup();
        $getPrivilegeChecked = $this->authorizagtion_model->getPrivilegeChecked($_GET['id']);
        $PrivilegeCheckedContain = [];
        if(!empty($getPrivilegeChecked)){
          foreach($getPrivilegeChecked as $privilegeChecked){
            $PrivilegeCheckedContain[] = $privilegeChecked['privilege_id'];
         }
        }
        require_once __DIR__ . "/../Views/admin/index.php";
     }
     public function save(){
        unset($_SESSION['privilege']);
        $data = $_POST; 
        $insert_privilege = "";
        $this->authorizagtion_model->deleteUserPrivilege($data['user_email']); 
        foreach($data['privilege'] as $privilege_id){
                $insert_privilege .= "(NULL, '{$data['user_email']}', '{$privilege_id}', '1732610795', '1732610795'),";
        }
        $insert_privilege = rtrim($insert_privilege, ",");
        $sql = " INSERT INTO `user_privilege` (`id`, `user_email`, `privilege_id`, `created_time`, `last_updated`) VALUES".$insert_privilege ;
        $this->authorizagtion_model->savePrivilege($sql);
        header("Location: ?mod=authorization&act=authorize&id={$data['user_email']}"); 
     }
}
?>