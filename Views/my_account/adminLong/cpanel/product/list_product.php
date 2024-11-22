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
<h3 style="text-align: center">Liệt Kê Sản Phẩm</h3>
<table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Tên Sản Phẩm</th>
        <th>Hình ảnh Sản Phẩm</th>
        <th>Danh Mục Sản Phẩm</th>
        <th>Giá Sản Phẩm</th>
        <th>Giá Khuyến Mãi</th>
        <th>Số Lượng Sản Phẩm</th>
        <th>Ngày Tạo</th>
        <th>Lượt Xem</th>
        <th>Trạng Thái</th>
        <th>Quản Lý</th>
      </tr>
    </thead>
    <tbody>
        <?php
            $i = 0;
            foreach($product as $key => $pro){
                extract($pro);
                $i++;
                if($product_status >=0 ){
        ?>
        <tr>
            <td><?= $i ?></td>
            <td><?=$product_name?></td> 
            <td><img src="<?= BASE_URL ?>/uploaded/<?=$product_img ?>" height="100" width="100"></td> 
            <td><?= $product_cat ?></td> 
            <td><?php echo number_format($product_price,0,',','.').'đ'?></td>  <!-- vi ko dung thi số tiên ko thể nhìn được -->
            <td><?php echo number_format($product_price * (100 - $product_discount) / 100,0,',','.').'đ'?>(<?=$product_discount?>%)</td>  <!-- vi ko dung thi số tiên ko thể nhìn được -->
            <td><?php echo $product_count ?></td> 
            <td><?php echo $created_at ?></td> 
            <td><?php echo $view_count ?></td> 
            <td><?php echo $product_status == 1 ? 'Hiển Thị' : 'Ẩn' ?></td> 
            <td><a href="?act=adminLong&ctlr=AdminLongController&method=delete_product&param=<?=$product_id ?>">Xóa</a> 
            || <a href="?act=adminLong&ctlr=AdminLongController&method=edit_product&param=<?=$product_id ?>">Cập Nhập</a> </td>
        </tr>      
        <?php
                }
            }
        ?>
    </tbody>
  </table>
