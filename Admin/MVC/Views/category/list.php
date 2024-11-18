<?php if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) { ?>
<a href="?mod=danhmuc&act=add" type="button" class="btn btn-primary">Thêm mới</a>
<?php } ?>
<?php if (isset($_COOKIE['msg'])) { ?>
<div class="alert alert-success">
    <strong>Thông báo</strong> <?= $_COOKIE['msg'] ?>
</div>
<?php } ?>
<hr>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th scope="col">Category ID</th>
            <th scope="col">Category Name</th>
            <th scope="col">Category Description</th>
            <th scope="col">Category Image</th>
            <th scope="col">Category Parent</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row) { ?>
        <tr>
            <td><?= $row['category_id'] ?></td>
            <td><?= $row['category_name'] ?></td>
            <td><?= $row['category_description']?></td>
            <td><img src="../uploaded<?= $row['category_image']?>" alt="Category Image" width="100"></td>
            <td><?= $row['parent_id'] ?></td>

            <td>
                <a href="?mod=danhmuc&act=detail&id=<?= $row['category_id'] ?>" class="btn btn-success">Xem</a>
                <?php if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) { ?>
                <a href="?mod=danhmuc&act=edit&id=<?= $row['category_id'] ?>" class="btn btn-warning">Sửa</a>
                <a href="?mod=danhmuc&act=delete&id=<?= $row['category_id'] ?>"
                    onclick="return confirm('Bạn có thật sự muốn xóa ?');" type="button" class="btn btn-danger">Xóa</a>
                <?php }?>
            </td>
        </tr>
        <?php } ?>
</table>
<script>
$(document).ready(function() {
    $('#dataTable').DataTable();
});
</script>