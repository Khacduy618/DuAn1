<div class="container mt-3">
    <div class="form-container">
        <form action="?mod=authorization&act=save" method="POST">
            <div class="row mb-4 justify-content-between">
                <h1 class="col-6 text-start">Role for employee</h1>

            </div>

            <input type="hidden" name="user_email" value="<?=$_GET['id']?>">
            <!-- new table -->
            <table class="table">
                <thead class="card-header">
                    <tr>
                        <th class="col-2">Name</th>
                        <th class="col-2">View</th>
                        <th class="col-2">Add</th>
                        <th class="col-2">Edit</th>
                        <th class="col-2">Delete</th>

                        <th class="col-3"><button type="submit" class="btn btn-primary w-50">Submit</button></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($getPrivilegeGroup as $group){ $id_gr = $group['id']?>
                    <tr>
                        <td><?=$group['name']?></td>
                        <!-- Danh sách quyền (Xem, Tạo mới, Sửa, Xóa, Cấp quyền) -->
                        <?php 
                        $privileges = ['list', 'add', 'edit', 'delete', 'Cấp quyền'];
                          foreach ($privileges as $act_name) {
                        $foundPrivilege = false;
                          foreach($getPrivilege as $Privilege) {
                        if($Privilege['group_id'] == $id_gr && $Privilege['privilege_act'] == $act_name) {
                        $foundPrivilege = true;
                         ?>
                        <td>
                            <input type="checkbox" value="<?=$Privilege['id']?>"
                                <?php if(in_array($Privilege['id'], $PrivilegeCheckedContain)){?> checked="" <?php } ?>
                                id="privilege_<?=$Privilege['id']?>" name="privilege[]" class="form-check-input me-2">
                        </td>
                        <?php break; } } ?>
                        <?php if (!$foundPrivilege) { ?>
                        <!-- Nếu quyền không tồn tại -->
                        <td></td>
                        <?php } ?>
                        <?php } ?>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!-- new table -->
        </form>
    </div>
</div>