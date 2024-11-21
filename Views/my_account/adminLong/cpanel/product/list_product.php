<?php
    if(!empty($_GET['msg'])){
        $msg = unserialize(urldecode($_GET['msg']));
        foreach($msg as $key => $value){
            echo '<span style="color:blue;font-weight:bold">'.$value.'</span>';
        }
    }
?>
<h3 style="text-align: center">Liệt Kê Sản Phẩm</h3>
<table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Tên Sản Phẩm</th>
        <th>Hình ảnh Sản Phẩm</th>
        <th>Danh Mục Sản Phẩm</th>
        <th>Giá Sản Phẩm</th>
        <th>Số Lượng Sản Phẩm</th>
        <th>Sản phẩm hot</th>
        <th>Quản Lý</th>
      </tr>
    </thead>
    <tbody>
        <?php
            $i = 0;
            foreach($product as $key => $pro){
                $i++;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $pro['title_product'] ?></td> 
            <td><img src="<?php echo BASE_URL ?>/public/upload/product/<?php echo $pro['image_product'] ?>" height="100" width="100"></td> 
            <td><?php echo $pro['title_category_product'] ?></td> 
            <td><?php echo number_format($pro['price_product'],0,',','.').'đ'?></td>  <!-- vi ko dung thi số tiên ko thể nhìn được -->
            <td><?php echo $pro['quantity_product'] ?></td> 
            <td><?php echo $pro['hot_product'] ?></td> 
            <td><a href="<?php echo BASE_URL ?>/Product/delete_product/<?php echo $pro['id_product'] ?>">Xóa</a> 
            || <a href="<?php echo BASE_URL ?>/Product/edit_product/<?php echo $pro['id_product'] ?>">Cập Nhập</a> </td>
        </tr>      
        <?php
        }
        ?>
    </tbody>
  </table>
