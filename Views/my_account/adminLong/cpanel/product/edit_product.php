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
<h3 style="text-align: center">Cập nhật Sản Phẩm</h3>
<div class="col-md-12">
    <?php
    // var_dump($productbyid);
    foreach($productbyid as $key => $pro){
        extract($pro);
    ?>
    <form action="?act=adminLong&ctlr=AdminLongController&method=update_product&param=<?=$product_id ?>" method="POST" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" vi khi phuong thuc gui file phai co cau lenh nay --> 
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="product_name">Tên Sản Phẩm:</label>
                    <input type="text" value="<?=$product_name ?>" name="product_name" class="form-control" required >
                </div>
                <div class="form-group">
                    <label for="product_img_upload">Hình Ảnh Sản Phẩm:</label>
                    <input type="file" name="product_img_upload" class="form-control" required >
                    <p><img src="<?php echo BASE_URL ?>/uploaded/<?=$product_img ?>" height="100" width="100"></p>
                </div>
                <div class="form-group">
                    <label for="product_price">Giá Sản Phẩm:</label>
                    <input type="number" value="<?=$product_price ?>" name="product_price" class="form-control" required >
                </div>
                <div class="form-group">
                    <label for="view_count">Lượt xem:</label>
                    <input type="number" value="<?=$view_count ?>" name="view_count" class="form-control" required >
                </div>
                
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="product_discount">Giảm Giá (%):</label>
                    <input type="number" value="<?=$product_discount?>" name="product_discount" class="form-control" required >
                </div>
                <div class="form-group">
                    <label for="product_count">Số Lượng:</label>
                    <input type="number" value="<?=$product_count ?>" name="product_count" class="form-control" required >
                </div>
                
                <div class="form-group">
                    <label for="product_cat">Danh Mục Sản Phẩm:</label>
                    <select name="product_cat" class="form-control">
                        <?php
                        foreach($category as $key => $cate){ 
                            extract($cate);
                        ?>
                            <option <?php if($category_id==$product_cat) {echo'selected';}  ?> value="<?php echo $category_id ?>"><?php echo $category_name ?></option>
                            
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="product_count">Ngày Giờ Tự Động: </label><p>True</p>
                        </div>
                        <div class="col-md-6">
                            <label for="product_count">Ngày Giờ Tạo: </label><p><?=$created_at ?></p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="product_status">Trạng Thái:</label>
                    <select name="product_status" class="form-control">
                        <?php
                        if($product_status == 0){
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
                <button type="submit" class="btn btn-dark">Cập Nhật Sản Phẩm</button>
            </div>
        </div>
    
    
    </form>
    <?php
    }
    ?>
</div>