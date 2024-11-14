<?php
    if(!empty($_GET['msg'])){
        $msg = unserialize(urldecode($_GET['msg']));
        foreach($msg as $key => $value){
            echo '<span style="color:blue;font-weight:bold">'.$value.'</span>';
        }
    }
?>
<h3 style="text-align: center">Liệt Kê Bài Viết</h3>
<table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Tên Bài Viết</th>
        <th>Hình ảnh Bài Viết</th>
        <th>Danh Mục Bài Viết</th>
        <th>Quản Lý</th>
      </tr>
    </thead>
    <tbody>
        <?php
            $i = 0;
            foreach($post as $key => $pos){
                $i++;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $pos['title_post'] ?></td> 
            <td><img src="<?php echo BASE_URL ?>/public/upload/post/<?php echo $pos['image_post'] ?>" height="100" width="100"></td> 
            <td><?php echo $pos['title_category_post'] ?></td> 
            <td><a href="<?php echo BASE_URL ?>/Post/delete_post/<?php echo $pos['id_post'] ?>">Xóa</a> 
            || <a href="<?php echo BASE_URL ?>/Post/edit_post/<?php echo $pos['id_post'] ?>">Cập Nhập</a> </td>
        </tr>      
        <?php
        }
        ?>
    </tbody>
  </table>
