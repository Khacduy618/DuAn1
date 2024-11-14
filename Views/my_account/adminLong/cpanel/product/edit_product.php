<?php
    if(!empty($_GET['msg'])){
        $msg = unserialize(urldecode($_GET['msg']));
        foreach($msg as $key => $value){
            echo '<span style="color:blue;font-weight:bold">'.$value.'</span>';
        }
    }
?>
<h3 style="text-align: center">Cập nhật Sản Phẩm</h3>
<div class="col-md-6">
    <?php
    foreach($productbyid as $key => $pro){
    ?>
    <form action="<?php echo BASE_URL ?>/Product/update_product/<?php echo $pro['id_product'] ?>" method="POST" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" vi khi phuong thuc gui file phai co cau lenh nay --> 
    <div class="form-group">
        <label for="email">Tên Sản Phẩm:</label>
        <input type="text" value="<?php echo $pro['title_product'] ?>" name="title_product" class="form-control" >
    </div>
    <div class="form-group">
        <label for="email">Hình Ảnh Sản Phẩm:</label>
        <input type="file" name="image_product" class="form-control" >
        <p><img src="<?php echo BASE_URL ?>/public/upload/product/<?php echo $pro['image_product'] ?>" height="100" width="100"></p>
    </div>
    <div class="form-group">
        <label for="email">Giá Sản Phẩm:</label>
        <input type="text" value="<?php echo $pro['price_product'] ?>" name="price_product" class="form-control" >
    </div>
    <div class="form-group">
        <label for="email">Số Lượng Sản Phẩm:</label>
        <input type="number" value="<?php echo $pro['quantity_product'] ?>" name="quantity_product" class="form-control" >
    </div>
    <div class="form-group">
        <label for="pwd">Miêu Tả Danh Mục:</label>
        <textarea name="desc_product" class="form-control" style="resize: none;" rows="5"><?php echo $pro['desc_product'] ?></textarea>
    </div>
    <div class="form-group">
        <label for="email">Thuộc Danh Mục Sản Phẩm hot:</label>
        <select name="hot_product" class="form-control">
            
            <?php
            if($pro['hot_product'] == 0){
            ?>
                <option value="0">Không</option>
                <option value="1">Có</option>
                <!--<option value="0"><?php //echo $pro['hot_product'] ?></option>
                <option value="1">Có</option>-->
            
            <?php
            }else {
            ?>
                <option value="1">Có</option>
                <option value="0">Không</option>
            <?php
            }
            ?>
            
            

        </select>
        </select>
    </div>
    <div class="form-group">
        <label for="email">Thuộc Danh Mục Sản Phẩm:</label>
        <select name="id_category_product" class="form-control">
            <?php
            foreach($category as $key => $cate){ 
            ?>
                <option <?php if($cate['id_category_product']==$pro['id_category_product']) {echo'selected';}  ?> value="<?php echo $cate['id_category_product'] ?>"><?php echo $cate['title_category_product'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-default">Cập Nhật Sản Phẩm</button>
    </form>
    <?php
    }
    ?>
</div>