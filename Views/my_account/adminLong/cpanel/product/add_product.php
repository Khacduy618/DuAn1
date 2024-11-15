<?php
    if(!empty($_GET['msg'])){
        $msg = unserialize(urldecode($_GET['msg']));
        foreach($msg as $key => $value){
            echo '<span style="color:blue;font-weight:bold">'.$value.'</span>';
        }
    }
?>
<h3 style="text-align: center">Thêm Danh Mục Sản Phẩm</h3>
<div class="col-md-6">
    <form action="<?php echo BASE_URL ?>/Product/insert_product" method="POST" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" vi khi phuong thuc gui file phai co cau lenh nay --> 
    <div class="form-group">
        <label for="email">Tên Sản Phẩm:</label>
        <input type="text" name="title_product" class="form-control" >
    </div>
    <div class="form-group">
        <label for="email">Hình Ảnh Sản Phẩm:</label>
        <input type="file" name="image_product" class="form-control" >
    </div>
    <div class="form-group">
        <label for="email">Giá Sản Phẩm:</label>
        <input type="text" name="price_product" class="form-control" >
    </div>
    <div class="form-group">
        <label for="email">Số Lượng Sản Phẩm:</label>
        <input type="number" name="quantity_product" class="form-control" >
    </div>
    <div class="form-group">
        <label for="pwd">Miêu Tả Danh Mục:</label>
        <textarea name="desc_product" class="form-control" style="resize: none;" rows="5"></textarea>
    </div>
    <div class="form-group">
        <label for="email">Thuộc Danh Mục Sản Phẩm Hot:</label>
        <select name="hot_product" class="form-control">
            <option value="1">có</option>
            <option value="0">Không</option>
        </select>
    </div>
    <div class="form-group">
        <label for="email">Thuộc Danh Mục Sản Phẩm:</label>
        <select name="id_category_product" class="form-control">
            <?php
            foreach($category as $key => $cate){ 
            ?>
                <option value="<?php echo $cate['id_category_product'] ?>"><?php echo $cate['title_category_product'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-default">Thêm Sản Phẩm</button>
</form>
</div>