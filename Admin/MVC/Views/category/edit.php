<?php if (isset($_COOKIE['msg'])) { ?>
<div class="alert alert-success">
    <strong>Thông báo</strong> <?= $_COOKIE['msg'] ?>
</div>
<?php } ?>
<hr>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <form action="?mod=danhmuc&act=update" method="POST" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">Category Name</label>
            <input type="text" class="form-control" id="" placeholder="" name="category_name"
                value="<?= $data['category_name']?>" required>
        </div>
        <div class="form-group">
            <label for="">Image</label>
            <input type="file" class="form-control" id="" placeholder="" name="category_img" required>
        </div>
        <div class="form-group">
            <label for="">Description</label>
            <textarea class="form-control" id="" rows="3" name="category_desc"><?= $data['category_desc'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="cars">Parent Category</label>
            <select id="" name="parent_id" class="form-control">
                <option value="0">Root</option>
                <?php foreach ($data as $row) {?>
                <option <?= ($row['category_id'] == $data['category_id'])?'selected':''?>
                    value="<?= $row['category_id'] ?>"><?= $row['category_name'] ?></option>
                <?php }?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</table>