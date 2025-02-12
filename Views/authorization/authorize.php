<div class="container mt-3">
    <div class="form-container">
        <h1 class="mb-4 text-center">Phân Quyền Cho Thành Viên</h1>
        <form action="?mod=authorization&act=save" method="POST">
            <!-- Tạo hàng chứa hai cột -->
            <input type="hidden" name="user_email" value="<?=$_GET['id']?>">
            <div class="row">
                <?php foreach($getPrivilegeGroup as $group){ ?>
                <!-- Cột đầu tiên -->
                <div class="col-md-6 mb-4">
                    <label class="form-label fw-bold" for="exampleInputEmail1">
                        <?=$group['name']?>
                    </label>
                    <ul class="list-group">
                        <?php foreach($getPrivilege as $Privilege){ ?>

                        <?php if($Privilege['group_id'] == $group['id'] ){  ?>
                        <li class="list-group-item d-flex align-items-center">
                            <input type="checkbox" value="<?=$Privilege['id']?>" <?php if(in_array($Privilege['id']
                                , $PrivilegeCheckedContain)){?> checked="" <?php } ?>
                                id="privilege_<?=$Privilege['id']?>" name="privilege[]" class="form-check-input me-2">
                            <label for="privilege_<?=$Privilege['id']?>"
                                class="form-check-label"><?=$Privilege['act_name']?></label>
                        </li>
                        <?php  }?>
                        <?php  }?>
                    </ul>
                </div>
                <?php  }?>
                <!-- Nút submit nằm giữa -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-50">Submit</button>
                </div>
        </form>
    </div>
</div>