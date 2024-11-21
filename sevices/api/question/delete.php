<?php
    // Thiết lập các header
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    // Bao gồm tệp cấu hình và lớp model
    include_once('../../config/db.php');
    include_once('../../model/question.php');

    // Kết nối với cơ sở dữ liệu
    $db = new db();
    $connect = $db->connect();

    // Tạo một đối tượng Question
    $question = new Question($connect);

    // Lấy dữ liệu từ request body
    $data = json_decode(file_get_contents("php://input"));

    // Gán giá trị id_cauhoi từ dữ liệu nhận được
    $question->id_cauhoi = $data->id_cauhoi;

    // Thực hiện xóa và trả về kết quả
    if ($question->delete()) {
        echo json_encode(array('message' => 'Question Deleted'));
    } else {
        echo json_encode(array('message' => 'Question Not Deleted'));
    }
?>
