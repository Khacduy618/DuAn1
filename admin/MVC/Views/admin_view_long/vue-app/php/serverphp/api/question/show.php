<?php
// Allow cross-origin requests and specify JSON content type
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Include database and question model files
include_once('../../config/db.php');
include_once('../../model/question.php');

// Initialize database and connect
$db = new db();
$connect = $db->connect(); // Fixed assignment operator

// Initialize Question object
$question = new Question($connect); // Fixed object creation syntax

// Retrieve 'id' from the GET parameter
$question->id_cauhoi = isset($_GET['id']) ? $_GET['id'] : die(json_encode(["message" => "No question ID provided."]));

// Fetch question details
$question->show();

// Prepare question item array
$question_item = [
    'id_question' => $question->id_cauhoi, // Fixed field reference
    'title' => $question->title,          // Fixed syntax and field name
    'cau_a' => $question->cau_a,          // Fixed field name
    'cau_b' => $question->cau_b,          // Fixed field name
    'cau_c' => $question->cau_c,          // Fixed field name
    'cau_d' => $question->cau_d,          // Fixed field name
    'cau_dung' => $question->cau_dung     // Fixed field name
];

// Output question details as JSON
echo json_encode($question_item, JSON_PRETTY_PRINT); //echo json_encode($question_item);

