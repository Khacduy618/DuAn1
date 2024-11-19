<?php
/**
 * khi muốn đổi thì thay cái param thứ 2 của các dòng vào _BASE_URL_ là được
 */
    define("BASE_URL","http://localhost/DuAn1/"); // này khi lên hosting
    define("BASE_URL_Long","http://localhost:8080/du-an-voi-team/DuAn19-11/DuAn1/"); // này khi trên máy Long
    define("BASE_URL_Duy","http://localhost/DuAn1/"); // này khi bên máy test của DUy


/**
 * Tạo 1 user defaul giả lập
*/
      // // Giả lập session admin đã đăng nhập
      // $_SESSION['isLogin'] = true;
      // $_SESSION['isLogin_Admin'] = true;
      // $_SESSION['username'] = 'rinio@gmail'; // Tên đăng nhập giả cho admin

      // // Các biến giả định cho $_GET để kiểm tra truy cập vào trang admin
      // $_GET['mod'] = 'admin';
      // $_GET['act'] = 'dashboard'; // Hoặc bất kỳ hành động nào mà bạn muốn thử nghiệm

      // // Kiểm tra session giả đã tạo
      // if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) {
      //    $mod = isset($_GET['mod']) ? $_GET['mod'] : "login";
      //    $act = isset($_GET['act']) ? $_GET['act'] : "admin";
         
      //    echo "Session giả cho admin đã được tạo thành công!";
      //    echo "<br>Mod: $mod";
      //    echo "<br>Act: $act";
      // } else {
      //    echo "Chưa có session cho admin hoặc quyền truy cập admin chưa được cấp.";
      // }