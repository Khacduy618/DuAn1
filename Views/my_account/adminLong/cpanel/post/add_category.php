<?php
    if(!empty($_GET['msg'])){
        $msg = unserialize(urldecode($_GET['msg']));
        foreach($msg as $key => $value){
            echo '<span style="color:blue;font-weight:bold">'.$value.'</span>';
        }
    }
?>
<h3 style="text-align: center">Thêm Danh Mục Bài Viết</h3>
<div class="col-md-6">
    <form action="<?php echo BASE_URL ?>/Post/insert_category" method="POST">
    <div class="form-group">
        <label for="email">Tên Danh Mục:</label>
        <input type="text" name="title_category_post" class="form-control" >
    </div>
    <div class="form-group">
        <label for="pwd">Miêu Tả Danh Mục:</label>
        <input type="text" name="desc_category_post" class="form-control" >
    </div>
    <button type="submit" class="btn btn-default">Thêm Danh Mục</button>
</form>
</div>