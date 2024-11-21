<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once('../../config/db.php');
include_once('../../model/question.php');

// Tạo kết nối đến cơ sở dữ liệu
$db = new db();
$connect = $db->connect();

// Tạo đối tượng Question
$question = new Question($connect);

// Lấy dữ liệu từ body request
$data = json_decode(file_get_contents("php://input"));

// Kiểm tra xem dữ liệu có tồn tại không
if (!empty($data->title) && !empty($data->cau_a) && !empty($data->cau_b) && !empty($data->cau_c) && !empty($data->cau_d) && !empty($data->cau_dung)) {
    // Gán dữ liệu cho các thuộc tính của đối tượng question
    $question->title = $data->title;
    $question->cau_a = $data->cau_a;
    $question->cau_b = $data->cau_b;
    $question->cau_c = $data->cau_c;
    $question->cau_d = $data->cau_d;
    $question->cau_dung = $data->cau_dung;

    // Gọi phương thức thêm câu hỏi vào cơ sở dữ liệu
    if ($question->create()) {
        echo json_encode([
            "message" => "Question created successfully."
        ]);
    } else {
        echo json_encode([
            "message" => "Failed to create question."
        ]);
    }
} else {
    echo json_encode([
        "message" => "Incomplete data. Please provide all required fields."
    ]);
}
?>
