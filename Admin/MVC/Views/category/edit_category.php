<?php
    if(!empty($_GET['msg'])){
        $msg = unserialize(urldecode($_GET['msg']));
        foreach($msg as $key => $value){
            echo '<span style="color:blue;font-weight:bold">'.$value.'</span>';
        }
    }
    if(!empty($_SESSION['msg'])){
        echo '<span style="color:blue;font-weight:bold">'.$_SESSION['msg'].'</span>';
        unset($_SESSION['msg']);
    }
?>
<style>
    .form-group label{
        font-weight: bold;
    }
    .form-group{
        margin-bottom: 10px;
    }
</style>
<h3 style="text-align: center">Cập Nhập Danh Mục Sản Phẩm</h3>
<div class="col-md-12">
    <?php
    // var_dump($categorybyid);
    if (isset($categorybyid)) {
    
    foreach($categorybyid as $key => $cate){
        extract($cate);
    ?>
    <form action="?act=adminLong&ctlr=AdminLongController&method=update_category&param=<?=$category_id ?>" method="POST" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" vi khi phuong thuc gui file phai co cau lenh nay --> 
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="category_name">Tên Danh Mục:</label>
                    <input type="text" value="<?=$category_name ?>" name="category_name" class="form-control" required >
                </div>
                <div class="form-group">
                    <label for="category_img">Hình Ảnh:</label>
                    <input type="file" name="category_img" class="form-control" required >
                    <p><img src="<?php echo BASE_URL ?>/uploaded/<?=$category_img ?>" height="100" width="100"></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="parent_id">Danh Mục Cha(Nếu có):</label>
                    <select name="parent_id" class="form-control">
                        <option selected value="0">Không có danh mục cha</option>
                        <?php
                        foreach($categorySelectBox as $key => $cate){ 
                            
                        ?>
                            <option  value="<?php echo $cate['category_id'] ?>"><?php echo $cate['category_name'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category_desc">Mô Tả:</label>
                    <input type="text" value="<?=$category_desc?>" name="category_desc" class="form-control" required >
                </div>
                <div class="form-group">
                    <label for="internal_link">Đường Dẫn Nội Bộ:</label>
                    <input type="text" value="<?=$internal_link?>" name="internal_link" class="form-control" required >
                </div>

                <div class="form-group">
                    <label for="category_status">Trạng Thái:</label>
                    <select name="category_status" class="form-control">
                        <?php
                        if($category_status == 0){
                        ?>
                            <option value="0">Ẩn</option>
                            <option value="1">Hiện</option>
                            <!--<option value="0"><?php //echo $pro['hot_product'] ?></option>
                            <option value="1">Có</option>-->
                        
                        <?php
                        }else {
                        ?>
                            <option value="1">Hiện</option>
                            <option value="0">Ẩn</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-dark">Cập Nhật Danh Mục</button>
            </div>
        </div>
    
    
    </form>
    <?php
    }
    }else {
        echo '<p style="color:red;font-weight:bold">Không tìm thấy danh mục nào!</p>';
    }
    ?>
</div>