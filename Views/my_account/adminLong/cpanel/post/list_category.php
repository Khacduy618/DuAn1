<?php
    if(!empty($_GET['msg'])){
        $msg = unserialize(urldecode($_GET['msg']));
        foreach($msg as $key => $value){
            echo '<span style="color:blue;font-weight:bold">'.$value.'</span>';
        }
    }
?>
<h3 style="text-align: center">Liệt Kê Danh Mục Bài Viết</h3>
<table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Tên Danh Mục</th>
        <th>Mô Tả</th>
        <th>Quản Lý</th>
      </tr>
    </thead>
    <tbody>
        <?php
            $i = 0;
            foreach($category as $key => $cate){
                $i++;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $cate['title_category_post'] ?></td> 
            <td><?php echo $cate['desc_category_post'] ?></td>
            <td><a href="<?php echo BASE_URL ?>/Post/delete_category/<?php echo $cate['id_category_post'] ?>">Xóa</a> 
            || <a href="<?php echo BASE_URL ?>/Post/edit_category/<?php echo $cate['id_category_post'] ?>">Cập Nhập</a> </td>
        </tr>      
        <?php
        }
        ?>
    </tbody>
  </table>
