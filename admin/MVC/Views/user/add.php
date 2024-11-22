<h1>THÊM NGƯỜI DÙNG</h1>
<form action="index.php?act=adduser" method="POST">
    <label for="user_images">Ảnh đại diện:</label><br>
    <input type="file" id="user_images" name="user_images"><br>
    <label>Email:</label><br>
    <input type="email" name="user_email" required><br>
    <label>Tên đăng nhập:</label><br>
    <input type="text" name="user_name" required><br>
    <label>Họ và tên:</label><br>
    <input type="text" name="user_full_name" required><br>
    <label>Mật khẩu:</label><br>
    <input type="password" name="user_password" required><br>
    <label>Điện thoại:</label><br>
    <input type="text" name="user_phone" required><br>
    <label>Quyền:</label><br>
    <select name="user_role">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select><br>
    <input type="submit" name="submit" value="Thêm Người Dùng">
</form>