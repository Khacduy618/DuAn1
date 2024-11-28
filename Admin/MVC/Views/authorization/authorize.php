<div class="container mt-3">
    <div class="form-container">
        <form action="?mod=authorization&act=save" method="POST">
            <div class="row mb-4 justify-content-between"> 
                <h1 class="col-6 text-start">Role for employee</h1>
                <div class="col-4 text-end">
                    <button type="submit" class="btn btn-primary w-50">Submit</button>
                </div>
            </div>
            
            <input type="hidden" name="user_email" value="<?=$_GET['id']?>">
            
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <?php foreach($getPrivilegeGroup as $group){ ?>
                                <th class="text-center"><?=$group['name']?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php foreach($getPrivilegeGroup as $group){ ?>
                                <td>
                                    <ul class="list-group list-group-flush">
                                        <?php foreach($getPrivilege as $Privilege){ ?>
                                            <?php if($Privilege['group_id'] == $group['id'] ){  ?>
                                                <li class="list-group-item border-0 d-flex align-items-center">
                                                    <input type="checkbox" 
                                                           value="<?=$Privilege['id']?>" 
                                                           <?php if(in_array($Privilege['id'], $PrivilegeCheckedContain)){?> 
                                                               checked="" 
                                                           <?php } ?>
                                                           id="privilege_<?=$Privilege['id']?>" 
                                                           name="privilege[]" 
                                                           class="form-check-input me-2">
                                                    <label for="privilege_<?=$Privilege['id']?>" 
                                                           class="form-check-label">
                                                        <?=$Privilege['act_name']?>
                                                    </label>
                                                </li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>