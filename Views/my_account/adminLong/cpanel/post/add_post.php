<?php
    if(!empty($_GET['msg'])){
        $msg = unserialize(urldecode($_GET['msg']));
        foreach($msg as $key => $value){
            echo '<span style="color:blue;font-weight:bold">'.$value.'</span>';
        }
    }
?>
<h3 style="text-align: center">Thêm Bài Viết</h3>
<div class="col-md-6">
    <form action="<?php echo BASE_URL ?>/Post/insert_post" method="POST" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" vi khi phuong thuc gui file phai co cau lenh nay --> 
    <div class="form-group">
        <label for="email">Tên Bài Viết:</label>
        <input type="text" name="title_post" class="form-control" >
    </div>
    <div class="form-group">
        <label for="email">Hình Ảnh Bài Viết:</label>
        <input type="file" name="image_post" class="form-control" >
    </div>
    <div class="form-group">
        <label for="pwd">Chi Tiết Bài Viết:</label>
        <textarea name="content_post" class="form-control" style="resize: none;" rows="10"></textarea>
    </div>
    <div class="form-group">
        <label for="email">Thuộc Danh Mục Bài Viết:</label>
        <select name="id_category_post" class="form-control">
            <?php
            foreach($category as $key => $cate){ 
            ?>
                <option value="<?php echo $cate['id_category_post'] ?>"><?php echo $cate['title_category_post'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-default">Thêm Bài Viết</button>
</form>
</div>