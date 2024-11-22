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
<h3 style="text-align: center">Thêm Danh Mục Sản Phẩm</h3>
<div class="col-md-12">
    <?php
    // var_dump($categorySelectBox);
    ?>
    <form action="?act=adminLong&ctlr=AdminLongController&method=insert_category" method="POST" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" vi khi phuong thuc gui file phai co cau lenh nay --> 
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="category_name">Tên Danh Mục:</label>
                    <input type="text" value="" name="category_name" class="form-control" required >
                </div>
                <div class="form-group">
                    <label for="category_img">Hình Ảnh Danh Mục:</label>
                    <input type="file" name="category_img" class="form-control" required >
                    <p><img src="<?php echo BASE_URL ?>/uploaded/user.png" height="100" width="100"></p>
                </div>
                
                
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="parent_id">Danh Mục Cha(Nếu có):</label>
                    <select name="parent_id" class="form-control">
                        <option selected value="0">Không có danh mục cha</option>
                        <?php
                        foreach($categorySelectBox as $key => $cate){ 
                            extract($cate);
                        ?>
                            <option  value="<?php echo $category_id ?>"><?php echo $category_name ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category_desc">Mô tả:</label>
                    <input type="text" value="" name="category_desc" class="form-control" required >
                </div>
                <div class="form-group">
                    <label for="internal_link">Đường Dẫn Nội Bộ:</label>
                    <input type="text" value="" name="internal_link" class="form-control" required >
                </div>
                
                
                <button type="submit" class="btn btn-dark">Thêm Danh Mục</button>
            </div>
        </div>
    
    
    </form>
</div>