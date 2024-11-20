<?php
// Lấy dữ liệu gửi từ client json

header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');


$email = "leduylong@gmail.com";
$password = "leduylong";
$data = json_decode(file_get_contents('php://input'), true);
if (is_array($data) && isset($data['username']) && isset($data['password'])) {
    if ($data['username'] === $email && $data['password'] === $password) {
        echo json_encode(['status' => 'success', 'message' => 'Đăng nhập thành công', 
                'token' => '1234567890abcdef'
            ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Sai tài khoản hoặc mật khẩu']);
    }
} else {
    echo json_encode(['status' => 'success', 'message' => 'Dữ liệu không hợp lệ', 
    'token' => '1234567890abcdef']);
}


// if (isset($_POST['email']) && isset($_POST['password'])) {
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     echo json_encode(['status' => 'success', 'message' => 'Đăng nhập thành công','data' => [
//         'token' => '1234567890abcdef'
//     ]]);
// } else {
//     echo json_encode(['status' => 'success', 'message' => 'Đăng nhập thành công','body' => [
//         'token' => '1234567890abcdef'
//     ]]);
// }


?>
