<?php
    if(!empty($_GET['msg'])){
        $msg = unserialize(urldecode($_GET['msg']));
        foreach($msg as $key => $value){
            echo '<span style="color:blue;font-weight:bold">'.$value.'</span>';
        }
    }
?>
<h3 style="text-align: center">Cập nhật Bài Viết</h3>
<div class="col-md-6">
    <?php
    foreach($postbyid as $key => $pos){
    ?>
    <form action="<?php echo BASE_URL ?>/Post/update_post/<?php echo $pos['id_post'] ?>" method="POST" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" vi khi phuong thuc gui file phai co cau lenh nay --> 
    <div class="form-group">
        <label for="email">Tên Bài Viết:</label>
        <input type="text" value="<?php echo $pos['title_post'] ?>" name="title_post" class="form-control" >
    </div>
    <div class="form-group">
        <label for="email">Hình Ảnh Sản Phẩm:</label>
        <input type="file" name="image_post" class="form-control" >
        <p><img src="<?php echo BASE_URL ?>/public/upload/post/<?php echo $pos['image_post'] ?>" height="100" width="100"></p>
    </div>
    <div class="form-group">
        <label for="pwd">Miêu Tả Bài Viết:</label>
        <textarea name="content_post" class="form-control" style="resize: none;" rows="10"><?php echo $pos['content_post'] ?></textarea>
    </div>
    <div class="form-group">
        <label for="email">Thuộc Danh Mục Bài Viết:</label>
        <select name="id_category_post" class="form-control">
            <?php
            foreach($category as $key => $cate){ 
            ?>
                <option <?php if($cate['id_category_post']==$pos['id_category_post']) {echo'selected';}  ?> value="<?php echo $cate['id_category_post'] ?>"><?php echo $cate['title_category_post'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-default">Cập Nhật Bài Viết</button>
    </form>
    <?php
    }
    ?>
</div>