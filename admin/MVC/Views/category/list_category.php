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
<h3 style="text-align: center">Liệt Kê Danh Mục Sản Phẩm</h3>
<table class="table table-striped">
    <?php
        // var_dump($category);
    ?>
    <thead>
      <tr>
        <th>ID</th>
        <th>Tên Danh Mục</th>
        <th>Mô Tả</th>
        <th>Hình Ảnh</th>
        <th>Tên Danh Mục Cha</th>
        <th>Link Nội Bộ</th>
        <th>Trạng Thái</th>
        <th colspan="2">Quản Lý</th>
      </tr>
    </thead>
    <tbody>
        <?php
            $i = 0;
            foreach($category as $key => $cate){
                extract($cate);
                $i++;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $category_name ?></td> 
            <td><?php echo $category_desc ?></td>
            <td><img src="<?= BASE_URL ?>/uploaded/<?= $category_img ?>" height="100" width="100"></td>
            <td><?php echo $parent_id ?></td>
            <td><?php echo $internal_link ?></td>
            <td><?php echo $category_status ==1 ? "Hiển Thị" : "Ẩn" ?></td>
            <td><a href="?act=adminLong&ctlr=AdminLongController&method=delete_category&param=<?=$category_id ?>">Xóa</a> 
            <td><a href="?act=adminLong&ctlr=AdminLongController&method=edit_category&param=<?=$category_id ?>">Cập Nhập</a> 
        </tr>      
        <?php
        }
        ?>
    </tbody>
  </table>
