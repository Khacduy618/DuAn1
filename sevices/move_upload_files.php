<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

if ($_FILES['file']) {
    $uploadDir = __DIR__.'/../uploads/';
    $fileName = basename($_FILES['file']['name']);
    $uploadFile = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
        $response = array(
            'success' => true,
            'filename' => $fileName,
            'url' => $uploadDir. $fileName
        );
        echo json_encode($response);
    } else {
        $response = array(
            'success' => false,
            'message' => 'File upload failed'
        );
        echo json_encode($response);
    }
} else {
    $response = array(
        'success' => false,
        'message' => 'No file received'
    );
    echo json_encode($response);
}
?>
