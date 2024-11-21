<?php
// Thiết lập header để API hoạt động với CORS và JSON
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

// Bao gồm file cấu hình và model
include_once('../../config/db.php');
include_once('../../model/question.php');

// Kết nối cơ sở dữ liệu
$db = new db();
$connect = $db->connect();

// Tạo đối tượng Question
$question = new Question($connect);

// Lấy dữ liệu đầu vào từ JSON
$data = json_decode(file_get_contents("php://input"));

// Kiểm tra dữ liệu đầu vào
if (
    isset($data->id_cauhoi) &&
    isset($data->title) &&
    isset($data->cau_a) &&
    isset($data->cau_b) &&
    isset($data->cau_c) &&
    isset($data->cau_d) &&
    isset($data->cau_dung)
) {
    // Gán dữ liệu vào đối tượng
    $question->id_cauhoi = $data->id_cauhoi;
    $question->title = $data->title;
    $question->cau_a = $data->cau_a;
    $question->cau_b = $data->cau_b;
    $question->cau_c = $data->cau_c;
    $question->cau_d = $data->cau_d;
    $question->cau_dung = $data->cau_dung;

    // Thực hiện cập nhật
    if ($question->update()) {
        echo json_encode(array('message' => 'Question Updated'));
    } else {
        echo json_encode(array('message' => 'Question Not Updated'));
    }
} else {
    // Thông báo lỗi nếu thiếu dữ liệu
    echo json_encode(array('message' => 'Incomplete Data'));
}
